<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalPinController extends Controller
{
    /**
     * Show set withdrawal PIN page (when user hasn't set PIN yet)
     */
    public function showSet()
    {
        $user = auth()->user();

        // If user already has a PIN, redirect to change page
        if ($user->withdrawal_pin) {
            return redirect()->route('withdrawal-pin.change');
        }

        return view('withdrawal-pin.set');
    }

    /**
     * Store new withdrawal PIN
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pin' => 'required|numeric|digits:4',
            'pin_confirmation' => 'required|numeric|digits:4|same:pin',
        ], [
            'pin.required' => 'PIN is required',
            'pin.numeric' => 'PIN must contain only numbers',
            'pin.digits' => 'PIN must be exactly 4 digits',
            'pin_confirmation.required' => 'PIN confirmation is required',
            'pin_confirmation.digits' => 'PIN confirmation must be exactly 4 digits',
            'pin_confirmation.same' => 'PINs do not match',
        ]);

        auth()->user()->update([
            'withdrawal_pin' => bcrypt($validated['pin']),
        ]);

        return redirect()->route('account.settings')
            ->with('success', 'Withdrawal PIN set successfully.');
    }

    /**
     * Show change withdrawal PIN page (when user already has PIN)
     */
    public function showChange()
    {
        $user = auth()->user();

        // If user hasn't set a PIN, redirect to set page
        if (!$user->withdrawal_pin) {
            return redirect()->route('withdrawal-pin.set');
        }

        return view('withdrawal-pin.change');
    }

    /**
     * Update withdrawal PIN
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_pin' => 'required|numeric|digits:4',
            'new_pin' => 'required|numeric|digits:4',
            'new_pin_confirmation' => 'required|numeric|digits:4|same:new_pin',
        ], [
            'current_pin.required' => 'Current PIN is required',
            'current_pin.numeric' => 'PIN must contain only numbers',
            'current_pin.digits' => 'PIN must be exactly 4 digits',
            'new_pin.required' => 'New PIN is required',
            'new_pin.numeric' => 'PIN must contain only numbers',
            'new_pin.digits' => 'PIN must be exactly 4 digits',
            'new_pin_confirmation.required' => 'PIN confirmation is required',
            'new_pin_confirmation.digits' => 'PIN confirmation must be exactly 4 digits',
            'new_pin_confirmation.same' => 'PINs do not match',
        ]);

        $user = auth()->user();

        // Verify current PIN
        if (!password_verify($validated['current_pin'], $user->withdrawal_pin)) {
            return back()->withErrors(['current_pin' => 'Current PIN is incorrect.']);
        }

        // Check if new PIN is different from current PIN
        if ($validated['current_pin'] === $validated['new_pin']) {
            return back()->withErrors(['new_pin' => 'New PIN must be different from current PIN.']);
        }

        // Update PIN
        $user->update([
            'withdrawal_pin' => bcrypt($validated['new_pin']),
        ]);

        return redirect()->route('account.settings')
            ->with('success', 'Withdrawal PIN changed successfully.');
    }
}
