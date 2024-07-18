<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Course;
use App\Models\CourseCategory;

class CourseService
{
    public static function updateTree(int $courseId): void
    {
        $course = Course::where('id', $courseId)->first();
        $courseCategories = CourseCategory::where('course_id', $courseId)->orderBy('sort', 'asc')->get();
        $result = [];

        foreach ($courseCategories as $courseCategory){
            foreach ($courseCategory->blogs() as $blog){
                $currentBlog = $blog->blog();
                $result[$currentBlog->language][$courseCategory->id][$currentBlog->id] = [
                    'course_slug' => $course->slug,
                    'category_slug' => $courseCategory->slug,
                    'blog_slug' => $currentBlog->slug,
                    'title' => $currentBlog->title,
                    'category_title' => $courseCategory->name,
                ];
            }
        }

        $course->tree = $result;
        $course->save();
    }

    public static function navigationTree(int $lessonId, array|string|null $tree = null, ?int $courseId = null): array
    {
        if($courseId !== null){
            $course = Course::where('id', $courseId)->first();
            $tree = $course->tree;
        }

        if(is_string($tree)){
            $tree = json_decode($tree, true);
        }

        $foundedCurrentLesson = false;
        $previousBlog = null;
        $nextBlog = null;
        $finish = false;

        $tree = $tree[env('LANGUAGE')];

        foreach ($tree as $category){
            foreach ($category as $blogId => $data){
                if($foundedCurrentLesson){
                    $nextBlog = $data;
                    $finish = true;
                    break;
                }


                if($blogId == $lessonId){
                    $foundedCurrentLesson = true;
                }else{
                    $previousBlog = $data;
                }
            }

            if($finish){
                break;
            }
        }

        return [
            'previous' => $previousBlog,
            'next' => $nextBlog
        ];
    }
}
