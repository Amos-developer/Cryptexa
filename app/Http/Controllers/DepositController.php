<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function showQrCode()
    {
        return view('qr-code');
    }
}
