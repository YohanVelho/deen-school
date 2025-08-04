<?php

namespace App\Http\Controllers\Site;

use App\Models\Course;

class CourseController extends Controller
{

    public function show($slug)
    {
        $this->vm['course'] = Course::with(['playlist' => function($q){
            $q->with("lessons");
        }])->where('slug', $slug)->first()->toArray();
        return view("site.course", $this->vm);
    }
}
