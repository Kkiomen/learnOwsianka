<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        return view('pages.index');
    }

    public function blog()
    {
        $posts = Blog::orderBy('created_at','desc')->where('language', env('LANGUAGE'))->paginate(15);
        return view('pages.blog', [
            'posts' => $posts,
        ]);
    }

    public function blogPost($slug)
    {
        $post = Blog::where('slug', $slug)->where('language', env('LANGUAGE'))->first();

        if(!$post){
            abort(404);
        }

        return view('pages.blog_post', [
            'post' => $post,
        ]);
    }
}
