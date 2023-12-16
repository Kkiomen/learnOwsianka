<?php

namespace App\Http\Controllers;

use App\Models\SocialPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SocialPostController extends Controller
{
    public function list()
    {
        $socialPosts = SocialPost::orderBy('date_post','asc')->paginate(15);

        return view('dashboard.socialPost.list', [
            'socialPosts' => $socialPosts,
        ]);
    }


    public function add(Request $request)
    {
        SocialPost::create([
            'title' => $request->get('title'),
            'date_post' => $request->get('date'),
        ]);

        return Redirect::back();
    }

    public function remove(Request $request, $id)
    {
        SocialPost::where('id', $id)->delete();

        return Redirect::back();
    }

    public function view(Request $request, $id)
    {
        $socialPost = SocialPost::where('id', $id)->first();

        if(!$socialPost) {
            return Redirect::back();
        }

        return view('dashboard.socialPost.view', [
            'socialPost' => $socialPost,
        ]);
    }
}
