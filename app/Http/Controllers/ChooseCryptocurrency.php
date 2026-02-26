<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChooseCryptocurrency extends Controller
{
    public function chooseCryptocurrency()
    {
        // Logic to display the cryptocurrency selection page
        return view('select-network');
    }
}
