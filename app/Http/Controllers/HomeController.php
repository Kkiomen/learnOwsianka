<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Service\CourseService;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {
        return view('pages.index');
    }

    public function blog()
    {
        $posts = Blog::orderBy('created_at','desc')->where('language', env('LANGUAGE'))->where('type', 'article')->where('activated', true)->paginate(15);
        return view('pages.blog_new', [
            'posts' => $posts,
            'tag' => null
        ]);
    }

    public function course(string $courseSlag)
    {
        $course = Course::where('slug', $courseSlag)->first();

        if(!$course){
            abort(404);
        }

        return view('pages.course', [
            'course' => $course,
            'tag' => null
        ]);
    }


    public function blogListTag($tag)
    {
        $posts = Blog::where('tags', 'LIKE', '%'. strtolower($tag) .'%')->orderBy('created_at','desc')->where('language', env('LANGUAGE'))->where('type', 'article')->where('activated', true)->paginate(15);
        return view('pages.blog', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }

    public function blogPost($slug)
    {
        $post = Blog::where('slug', $slug)->first();
        $proposedArticle = Blog::orderBy('created_at','desc')->where('language', env('LANGUAGE'))->where('type', 'article')->where('activated', true)->where('id', '!=', $post->id)->inRandomOrder()->take(5)->get();

        if(!$post || $post->type !== 'article'){
            abort(404);
        }

        return view('pages.blog_post_new', [
            'post' => $post,
            'tags' => is_string($post->tags) ? explode(',', $post->tags) : [],
            'tagsHeader' => is_string($post->tags) ? array_slice(explode(',', $post->tags), 0, 3) : [],
            'url' => asset('/article/' . $post->slug),
            'proposedArticle' => $proposedArticle,
            'course' => null
        ]);
    }

    public function coursePost(string $courseSlag, string $categorySlug, string $lessonSlug)
    {
        $post = Blog::where('slug', $lessonSlug)->first();

        if(!$post || $post->type !== 'course'){
            abort(404);
        }

        $courseCategory = $post?->courseCategory();
        $course = $courseCategory?->getCourse();
        if(empty($course) || empty($courseCategory)){
            abort(404);
        }

        return view('pages.blog_post_new', [
            'post' => $post,
            'course' => $course,
            'tags' => is_string($post->tags) ? explode(',', $post->tags) : [],
            'tagsHeader' => is_string($post->tags) ? array_slice(explode(',', $post->tags), 0, 3) : [],
            'url' => asset('/course/' . $course->slug . '/' . $courseCategory->slug . '/' . $post->slug),
            'navigationTree' => CourseService::navigationTree($post->id, $course->tree)
        ]);
    }
}
