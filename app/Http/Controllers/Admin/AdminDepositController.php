<?php

namespace App\Http\Controllers\Admin;
use App\Models\Deposit;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.deposits.index', compact('deposits'));
    }
}
