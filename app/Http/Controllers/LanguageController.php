<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $request->validate([
            'language' => 'required|in:en,es,fr,de,zh,ja,ko,pt,ru,ar,hi,it,nl,tr,pl,vi,th,id,ms,sv'
        ]);

        $language = $request->input('language');
        
        Session::put('locale', $language);
        
        if (auth()->check()) {
            auth()->user()->update(['language' => $language]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Language changed successfully',
            'language' => $language
        ]);
    }
}
