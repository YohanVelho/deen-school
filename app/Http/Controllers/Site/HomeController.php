<?php

namespace App\Http\Controllers\Site;

use App\Models\Trail;
use App\Models\TranslateModel;

class HomeController extends Controller
{

    public function index()
    {
        return view("site.home", $this->vm);
    }
}
