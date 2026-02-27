<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalMethodController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'network' => 'required|string|in:usdtbsc,usdcbsc,usdttrc20,bnbbsc',
            'address' => 'required|string',
        ]);

        $network = $request->network;
        $address = $request->address;

        // Network-specific validation
        if (in_array($network, ['usdtbsc', 'usdcbsc', 'bnbbsc'])) {
            // BEP20/BSC addresses start with 0x and are 42 characters
            if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $address)) {
                return back()->withErrors(['address' => __('Invalid BEP20/BSC address format. Must start with 0x and be 42 characters.')])->withInput();
            }
        } elseif ($network === 'usdttrc20') {
            // TRC20 addresses start with T and are 34 characters
            if (!preg_match('/^T[a-zA-Z0-9]{33}$/', $address)) {
                return back()->withErrors(['address' => __('Invalid TRC20 address format. Must start with T and be 34 characters.')])->withInput();
            }
        }

        $user = auth()->user();
        
        // Check if address is same as current
        if ($user->withdrawal_address === $address && $user->withdrawal_network === $network) {
            return back()->withErrors(['address' => __('New address must be different from current address.')])->withInput();
        }
        
        // Store withdrawal method
        $user->update([
            'withdrawal_network' => $network,
            'withdrawal_address' => $address,
        ]);

        return redirect()->route('account.settings')->with('success', __('Withdrawal address saved successfully!'));
    }
}
