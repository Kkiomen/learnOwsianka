<?php

namespace App\Http\Controllers;

use App\Enum\BlogContentType;
use App\Models\Blog;
use App\Models\BlogContent;
use App\Models\Post;
use App\Models\SocialPost;
use App\Service\GeneratorArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SocialPostController extends Controller
{


    public function __construct(
        private GeneratorArticleService $generatorArticleService
    ){}

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

        $posts = Post::where('social_post_id', $id)->orderBy('language', 'desc')->get();

        return view('dashboard.socialPost.view', [
            'socialPost' => $socialPost,
            'posts' => $posts
        ]);
    }

    public function generateArticle(Request $request,int $id, string $language)
    {
        $socialPost = SocialPost::where('id', $id)->first();

        if($socialPost) {
            $this->generatorArticleService->generate($socialPost->id, $language);
        }

        return Redirect::back();
    }

    public function generateArticleAddContent(Request $request, int $blogId, string $type, int $contentId)
    {
        $blog = Blog::where('id', $blogId)->first();
        if(!$blog) {
            return Redirect::back();
        }

        $currentContent = null;

        foreach ($blog->contents as $content) {
            if($content->id === $contentId) {
                $currentContent = $content;
                $i = $content->sequence;

                BlogContent::create([
                    'blog_id' => $blog->id,
                    'header' => null,
                    'content' => null,
                    'image_url' => null,
                    'type' => $type,
                    'sequence' => ++$i,
                ]);
            }

            if($currentContent !== null && $content->sequence > $currentContent->sequence) {
                $i = $content->sequence;
                $content->update([
                    'sequence' => ++$i,
                ]);
            }
        }

        return Redirect::back();
    }

    public function removeBlogContent(Request $request, int $contentId)
    {
        $contentToDelete = BlogContent::where('id', $contentId)->first();
        if(!$contentToDelete) {
            return Redirect::back();
        }

        $blog = Blog::where('id', $contentToDelete->blog_id)->first();
        if(!$blog) {
            return Redirect::back();
        }

        foreach ($blog->contents as $content) {
            if($content->sequence > $contentToDelete->sequence) {
                $i = $content->sequence;
                $content->update([
                    'sequence' => --$i,
                ]);
            }
        }

        $contentToDelete->delete();

        return Redirect::back();
    }

    public function updateBlogContent(Request $request, int $contentId)
    {

        $contentToUpdate = BlogContent::where('id', $contentId)->first();
        if(!$contentToUpdate) {
            return Redirect::back();
        }

        if($request->hasFile('file-upload')){
            $file = $request->file('file-upload');
            $fileName = $file->getClientOriginalName();

            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');

            $contentToUpdate->update([
                'image_url' => $filename,
            ]);

            if($request->get('image_alt') !== null){
                $contentToUpdate->update([
                    'image_alt' => $request->get('image_alt')
                ]);
            }

        }else{
            $contentToUpdate->update([
                'header' => $request->get('header'),
                'content' => $request->get('content'),
            ]);
        }


        if($request->get('image_alt') !== null){
            $contentToUpdate->update([
                'image_alt' => $request->get('image_alt')
            ]);
        }

        return Redirect::back();
    }


    public function generateBlogContent(Request $request, int $contentId)
    {

        $contentToUpdate = BlogContent::where('id', $contentId)->first();
        $blog = Blog::where('id', $contentToUpdate->blog_id)->first();

        if(!$contentToUpdate || !$blog) {
            return Redirect::back();
        }

        $this->generatorArticleService->generateContentForBlog($contentId);

        return Redirect::back();
    }

    public function updateDesignBlogContent(Request $request, int $contentId)
    {

        $contentToUpdate = BlogContent::where('id', $contentId)->first();
        $blog = Blog::where('id', $contentToUpdate->blog_id)->first();

        if(!$contentToUpdate || !$blog) {
            return Redirect::back();
        }

        $this->generatorArticleService->generateDecorationContentForBlog($contentId);

        return Redirect::back();
    }

    public function deleteBlog(Request $request, int $id)
    {
        $blog = Blog::where('id', $id)->first();
        if(!$blog) {
            return Redirect::back();
        }

        BlogContent::where('blog_id', $blog->id)->delete();
        $blog->delete();

        return Redirect::back();
    }


}
