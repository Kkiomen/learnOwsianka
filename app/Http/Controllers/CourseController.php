<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseCategoryLesson;
use App\Service\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function list(Request $request)
    {
        $courses = Course::orderBy('id', 'desc')->paginate(15);

        return view('dashboard.courses.list', [
            'courses' => $courses,
        ]);
    }

    public function add(Request $request)
    {
        Course::create([
            'name' => $request->get('name'),
            'language' => $request->get('language'),
            'slug' => $request->get('slug'),
            'description' => '',
            'image' => '',
        ]);

        return Redirect::back();
    }

    public function view(Request $request, Course $course)
    {
        return view('dashboard.courses.view', [
            'course' => $course,
        ]);
    }

    public function edit(Request $request, Course $course)
    {
        if ($request->hasFile('file-upload')) {
            $file = $request->file('file-upload');

            $fileName = str_replace([' ', ';', '"', '(', ')'], '_', strtolower($request->get('image_alt')));

            $filename = 'course_' . $fileName . '.' . $file->getClientOriginalExtension();
            $file->storeAs('image-uploads', $filename, 'public');

            $course->update([
                'image' => $filename,
                'image_alt' => $request->get('image_alt') ?? '',
            ]);
        } else {
            $course->update([
                'image' => $request->get('image') ?? '',
                'image_alt' => $request->get('image_alt') ?? '',
            ]);
        }

        $course->update([
            'name' => $request->get('name'),
            'language' => $request->get('language'),
            'description' => $request->get('description'),
            'sort' => $request->get('sort'),
            'activated' => $request->get('activated'),
            'slug' => $request->get('slug'),
        ]);

        CourseService::updateTree($course->id);

        return Redirect::back();
    }

    public function categoryAdd(Request $request, Course $course)
    {
        CourseCategory::create([
            'course_id' => $course->id,
            'name' => $request->get('name'),
            'language' => $request->get('language'),
            'sort' => $request->get('sort'),
            'slug' => $request->get('slug'),
        ]);

        CourseService::updateTree($course->id);

        return Redirect::back();
    }

    public function categoryEdit(Request $request, Course $course, CourseCategory $category)
    {
        $category->update([
            'name' => $request->get('name'),
            'language' => $request->get('language'),
            'sort' => $request->get('sort'),
            'slug' => $request->get('slug'),
        ]);

        CourseService::updateTree($course->id);

        return Redirect::back();
    }

    public function categoryAddBlog(Request $request, Course $course, CourseCategory $category)
    {
        $excludedBlogIds = CourseCategoryLesson::pluck('blog_id');
        $blogs = Blog::where('type', 'course')->whereNotIn('id', $excludedBlogIds)->get();

        return view('dashboard.courses.addBlog', [
            'course' => $course,
            'category' => $category,
            'blogs' => $blogs
        ]);
    }

    public function categoryAddBlogPost(Request $request, Course $course, CourseCategory $category, Blog $blog)
    {
        CourseCategoryLesson::create([
            'sort' => $request->get('sort'),
            'course_category_id' => $category->id,
            'blog_id' => $blog->id,
        ]);

        CourseService::updateTree($course->id);

        return Redirect::route('course.view', ['course' => $course->id]);
    }

    public function categoryUpdateBlogPost(Request $request, Course $course, CourseCategory $category, CourseCategoryLesson $categoryLessons)
    {
        $categoryLessons->update([
            'sort' => $request->get('sort'),
        ]);

        CourseService::updateTree($course->id);

        return Redirect::route('course.view', ['course' => $course->id]);
    }

}
