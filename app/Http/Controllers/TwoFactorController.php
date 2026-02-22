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
     * Decode base32 string
     */
    private function base32Decode($input)
    {
        $baseMap = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $input = strtoupper($input);
        $bits = '';

        for ($i = 0; $i < strlen($input); $i++) {
            $idx = strpos($baseMap, $input[$i]);
            if ($idx === false) {
                continue;
            }
            $bits .= str_pad(decbin($idx), 5, '0', STR_PAD_LEFT);
        }

        $ret = '';
        for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
            $ret .= chr(bindec(substr($bits, $i, 8)));
        }
        return $ret;
    }

    /**
     * Verify TOTP code according to RFC 6238
     */
    private function verifyCode($code, $secret)
    {
        $secret = preg_replace('/[^A-Z2-7]/', '', strtoupper($secret));
        $key = $this->base32Decode($secret);

        if (strlen($key) < 8) {
            return false;
        }

        // Time counter - check current and adjacent time windows
        $timeCounter = intdiv(time(), 30);

        for ($i = -1; $i <= 1; $i++) {
            $timestamp = $timeCounter + $i;

            // Pack timestamp as 64-bit big-endian
            $binary = '';
            for ($j = 7; $j >= 0; $j--) {
                $binary .= chr(($timestamp >> ($j * 8)) & 0xff);
            }

            // Calculate HMAC-SHA1
            $hmac = hash_hmac('sha1', $binary, $key, true);

            // Extract offset from last 4 bits of HMAC
            $offset = ord(substr($hmac, -1)) & 0x0f;

            // Extract 4 bytes and convert to 32-bit value
            $value = 0;
            for ($j = 0; $j < 4; $j++) {
                $value = ($value << 8) | ord(substr($hmac, $offset + $j, 1));
            }

            // Mask MSB and modulo 1000000
            $token = ($value & 0x7fffffff) % 1000000;
            $totp = str_pad($token, 6, '0', STR_PAD_LEFT);

            if ($totp === $code) {
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
