<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\SetsLocale;

class ChooseCryptocurrency extends Controller
{
    use SetsLocale;
    
    public function chooseCryptocurrency()
    {
        $this->setLocale();
        return view('select-network');
    }
}
