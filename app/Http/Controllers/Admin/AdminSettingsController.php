<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_email' => 'nullable|email',
            'referral_commission_level1' => 'nullable|numeric|min:0|max:100',
            'referral_commission_level2' => 'nullable|numeric|min:0|max:100',
            'referral_commission_level3' => 'nullable|numeric|min:0|max:100',
            'min_deposit' => 'nullable|numeric|min:0',
            'min_withdrawal' => 'nullable|numeric|min:0',
        ]);

        // Store settings in .env or database
        // For now, just return success
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
}
