<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorController extends Controller
{
    /**
     * Show 2FA login verification page
     */
    public function showLoginVerification()
    {
        if (!session()->has('2fa_pending_user_id')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        return view('two-factor.login-verify');
    }

    /**
     * Verify 2FA code during login
     */
    public function verifyLogin(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        $userId = $request->session()->get('2fa_pending_user_id');
        $remember = $request->session()->get('2fa_pending_remember', false);

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please login again'
            ], 401);
        }

        $user = User::find($userId);

        if (!$user || !$user->two_factor_enabled) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid session'
            ], 401);
        }

        // Verify the code
        if (!$this->verifyCode($request->code, $user->two_factor_secret)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid authentication code'
            ], 422);
        }

        // Login the user
        Auth::login($user, $remember);
        $request->session()->forget(['2fa_pending_user_id', '2fa_pending_remember']);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => $user->role === 'admin' ? '/admin/dashboard' : '/'
        ]);
    }

    /**
     * Show 2FA setup page
     */
    public function show()
    {
        $user = Auth::user();
        return view('two-factor.setup', ['user' => $user]);
    }

    /**
     * Generate new 2FA secret
     */
    public function generateSecret(Request $request)
    {
        $secret = $this->generateRandomSecret();

        // Store temporarily in session for verification
        $request->session()->put('pending_2fa_secret', $secret);

        return response()->json([
            'secret' => $secret,
            'qr_code' => $this->getQrCode($secret)
        ]);
    }

    /**
     * Verify and enable 2FA
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        $secret = $request->session()->get('pending_2fa_secret');

        if (!$secret) {
            return response()->json([
                'success' => false,
                'message' => 'Please generate a secret first'
            ], 400);
        }

        // Verify the code
        if (!$this->verifyCode($request->code, $secret)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid authentication code'
            ], 422);
        }

        // Generate recovery codes
        $recoveryCodes = $this->generateRecoveryCodes();

        // Save to user
        $user = Auth::user();
        $user->update([
            'two_factor_secret' => $secret,
            'two_factor_recovery_codes' => json_encode($recoveryCodes),
            'two_factor_enabled' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        // Clear session
        $request->session()->forget('pending_2fa_secret');

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication enabled successfully',
            'recovery_codes' => $recoveryCodes
        ]);
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
            'code' => 'required|digits:6'
        ]);

        $user = Auth::user();

        // Verify 2FA code before disabling
        if (!$this->verifyCode($request->code, $user->two_factor_secret)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid authentication code'
            ], 422);
        }

        // Disable 2FA
        $user->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_enabled' => false,
            'two_factor_confirmed_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Two-factor authentication disabled'
        ]);
    }

    /**
     * Generate random secret
     */
    private function generateRandomSecret()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $randomSecret = '';
        for ($i = 0; $i < 32; $i++) {
            $randomSecret .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $randomSecret;
    }

    /**
     * Generate recovery codes
     */
    private function generateRecoveryCodes($count = 8)
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $codes[] = strtoupper(bin2hex(random_bytes(4))) . '-' . strtoupper(bin2hex(random_bytes(4)));
        }
        return $codes;
    }

    /**
     * Verify TOTP code
     */
    private function verifyCode($code, $secret)
    {
        // Base32 decode
        $secret = str_replace(' ', '', $secret);
        $secret = preg_replace('/[^A-Z2-7]/', '', $secret);

        if (strlen($secret) === 0) {
            return false;
        }

        $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $bits = '';

        for ($i = 0; $i < strlen($secret); $i++) {
            $val = strpos($base32chars, $secret[$i]);
            if ($val === false) {
                return false;
            }
            $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
        }

        if (strlen($bits) % 8 != 0) {
            return false;
        }

        $byteSecret = '';
        for ($i = 0; $i < strlen($bits); $i += 8) {
            $byteSecret .= chr(bindec(substr($bits, $i, 8)));
        }

        // Verify TOTP
        $timeCounter = intdiv(time(), 30);

        // Check current and previous time windows for tolerance
        for ($i = -1; $i <= 1; $i++) {
            $hmac = hash_hmac('sha1', pack('N*', $timeCounter + $i), $byteSecret, true);
            $offset = ord($hmac[19]) & 0xf;
            $totp = (unpack('N', substr($hmac, $offset, 4))[1] & 0x7fffffff) % 1000000;

            if ($totp == (int)$code) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get QR code for secret
     */
    private function getQrCode($secret)
    {
        $user = Auth::user();
        $accountName = urlencode($user->email);
        $issuer = urlencode('Cryptexa');
        $label = $accountName . ' (' . $issuer . ')';
        $provisioningUri = "otpauth://totp/$label?secret=$secret&issuer=$issuer";

        // Use QR code API
        return 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($provisioningUri);
    }
}
