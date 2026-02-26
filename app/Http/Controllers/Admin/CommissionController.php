<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralEarning;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferralEarning::with(['user', 'referrer']);
        
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        
        $commissions = $query->latest()->paginate(20);
        $totalCommissions = ReferralEarning::sum('amount');
        $level1Total = ReferralEarning::where('level', 1)->sum('amount');
        $level2Total = ReferralEarning::where('level', 2)->sum('amount');
        $level3Total = ReferralEarning::where('level', 3)->sum('amount');
        
        return view('admin.commissions.index', compact('commissions', 'totalCommissions', 'level1Total', 'level2Total', 'level3Total'));
    }
}
