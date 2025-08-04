<?php

namespace App\Http\Controllers\Site;

use App\Models\Lesson;

class LessonController extends Controller
{

    public function show($slug)
    {
        $this->vm['lesson'] = Lesson::where('slug', $slug)->first()->toArray();
        return view("site.lesson", $this->vm);
    }
}
