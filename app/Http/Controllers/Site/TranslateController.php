<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

class TranslateController extends Controller
{

    public function index(Request $request)
    {
        $lang = $request->route('language');
        session(['language' => $lang]);
        return redirect()->back();
    }
}
