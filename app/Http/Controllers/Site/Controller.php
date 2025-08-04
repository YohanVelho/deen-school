<?php

namespace App\Http\Controllers\Site;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\SeoModel;
use App\Models\GeneralModel;
use App\Models\LanguageModel;
use App\Models\Trail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $vm = [];

    function __construct(Request $request)
    {
        
        if(session()->has('language')){
            App::setLocale(session('language'));
        }
        // TRANSLATE
        $languages = LanguageModel::where('active', 1)->orderBy('position')->get()->toArray();
        $this->vm['languages'] = $languages;

        // BASE INFO
        $this->vm['general'] = GeneralModel::first()->toArray();

        $url = request()->path();
        if ($url == null){
            $url = '/';
        }
        $seo = SeoModel::where('link', $url)->first();
        $this->vm['seo'] = $seo ? $seo->toArray() : [];

        $this->vm['trails'] = Trail::orderBy("sort")->with('courses')->get()->toArray();

    }
}
