<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }
    public function addEvent()
    {
        return view('dashboard.addEvent');
    }
    public function saveEvent(Request $request)
    {
//        dd($request->all());
        /**
         * "title" => "aaaa"
         * "tags" => "bbbbb"
         * "slug" => "ccccc"
         * "language" => "dddd"
         * "image_url" => "eeee"
         * "short_description" => "fffff"
         * "content" => "gggg"
         */
        Blog::create([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content'),
            'short_description' => $request->get('short_description'),
            'image_url' => $request->get('image_url'),
            'language' => $request->get('language'),
            'tags' => $request->get('tags'),
        ]);

        return Redirect::back();
    }
}
