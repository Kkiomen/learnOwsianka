<?php

namespace App\Http\Controllers;

use App\Api\MyVpsApplication\Dto\ChatGptCollectionDto;
use App\Api\MyVpsApplication\Dto\ChatGptCollectionRequestDto;
use App\Api\MyVpsApplication\Dto\ChatGptCollectionRequestModelDto;
use App\Api\MyVpsApplication\GeneratorChatGptCollection;
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
        private GeneratorArticleService $generatorArticleService,
        private GeneratorChatGptCollection $generatorChatGptCollection
    ) {
    }

    public function list()
    {
        $socialPosts = SocialPost::orderBy('date_post', 'desc')->paginate(15);

        return view('dashboard.socialPost.list', [
            'socialPosts' => $socialPosts,
        ]);
    }

    public function listEdit(SocialPost $id)
    {
        $socialPosts = SocialPost::orderBy('date_post', 'desc')->paginate(15);

        return view('dashboard.socialPost.list_edit', [
            'socialPosts' => $socialPosts,
            'socialPost' => $id
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

    public function edit(Request $request, SocialPost $socialPost)
    {
        $socialPost->update([
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
        if (!$socialPost) {
            return Redirect::back();
        }

        $posts = Post::where('social_post_id', $id)->orderBy('language', 'desc')->get();

        return view('dashboard.socialPost.view', [
            'socialPost' => $socialPost,
            'posts' => $posts
        ]);
    }

    public function viewPosts(Request $request, $id)
    {
        $socialPost = SocialPost::where('id', $id)->first();
        if (!$socialPost) {
            return Redirect::back();
        }

        $posts = Post::where('social_post_id', $id)->orderBy('language', 'desc')->get();

        return view('dashboard.socialPost.view_posts', [
            'socialPost' => $socialPost,
            'posts' => $posts
        ]);
    }

    public function createArticle(Request $request, int $id, string $language)
    {
        $socialPost = SocialPost::where('id', $id)->first();

        if ($socialPost) {
            $this->generatorArticleService->generate($socialPost->id, $language, false);
        }

        return Redirect::back();
    }

    public function generateAllContent(Request $request, int $id)
    {
        $socialPost = SocialPost::where('id', $id)->first();

        if ($socialPost) {
            $this->generatorArticleService->generateAllContent($socialPost->id);
        }

        return Redirect::back();
    }

    public function generateArticle(Request $request, int $id, string $language)
    {
        $socialPost = SocialPost::where('id', $id)->first();

        if ($socialPost) {
            $this->generatorArticleService->generate($socialPost->id, $language);
        }

        return Redirect::back();
    }

    public function generateArticleAddContent(Request $request, int $blogId, string $type, int $contentId)
    {
        $blog = Blog::where('id', $blogId)->first();
        if (!$blog) {
            return Redirect::back();
        }

        $currentContent = null;

        if ($contentId === 0) {
            BlogContent::create([
                'blog_id' => $blog->id,
                'header' => null,
                'content' => null,
                'image_url' => null,
                'type' => $type,
                'sequence' => 1,
            ]);

            return Redirect::back();
        }


        foreach ($blog->contents as $content) {
            if ($content->id === $contentId) {
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

            if ($currentContent !== null && $content->sequence > $currentContent->sequence) {
                $i = $content->sequence;
                $content->update([
                    'sequence' => ++$i,
                ]);
            }
        }

        return Redirect::back();
    }

    public function generateContentPrototype(Request $request, Blog $id)
    {
        $this->generatorArticleService->generatePrototype($id);

        return Redirect::back();
    }

    public function removeBlogContent(Request $request, int $contentId)
    {
        $contentToDelete = BlogContent::where('id', $contentId)->first();
        if (!$contentToDelete) {
            return Redirect::back();
        }

        $blog = Blog::where('id', $contentToDelete->blog_id)->first();
        if (!$blog) {
            return Redirect::back();
        }

        foreach ($blog->contents as $content) {
            if ($content->sequence > $contentToDelete->sequence) {
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
        if (!$contentToUpdate) {
            return Redirect::back();
        }

        if ($request->hasFile('file-upload')) {
            $file = $request->file('file-upload');
            $fileName = $file->getClientOriginalName();

            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('image-uploads', $fileName, 'public');

            $contentToUpdate->update([
                'image_url' => $filename,
            ]);

            if ($request->get('image_alt') !== null) {
                $contentToUpdate->update([
                    'image_alt' => $request->get('image_alt')
                ]);
            }

        } else {
            $contentToUpdate->update([
                'header' => $request->get('header'),
                'content' => $request->get('content'),
            ]);
        }


        if ($request->get('image_alt') !== null) {
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

        if (!$contentToUpdate || !$blog) {
            return Redirect::back();
        }

        $this->generatorArticleService->generateContentForBlog($contentId);

        return Redirect::back();
    }

    public function updateDesignBlogContent(Request $request, int $contentId)
    {

        $contentToUpdate = BlogContent::where('id', $contentId)->first();
        $blog = Blog::where('id', $contentToUpdate->blog_id)->first();

        if (!$contentToUpdate || !$blog) {
            return Redirect::back();
        }

        $params = new ChatGptCollectionRequestDto();
        $params->setIdExternal($contentToUpdate->blog_id);
        $params->setTemperature('0.7');
        $params->setType('ARTICLE');
        $params->setModel(ChatGptCollectionRequestModelDto::GPT_4);
        $collection = [];

        $collection[] = $this->generatorArticleService->generateDecorationContentForBlog($contentId);
        $params->setCollection($collection);

        $this->generatorChatGptCollection->generateContentByCollection($params);

        return Redirect::back();
    }

    public function deleteBlog(Request $request, int $id)
    {
        $blog = Blog::where('id', $id)->first();
        if (!$blog) {
            return Redirect::back();
        }

        BlogContent::where('blog_id', $blog->id)->delete();
        $blog->delete();

        return Redirect::back();
    }

    public function generateTitle(Request $request)
    {
        $title = $this->generatorArticleService->generateTitle();

        return Redirect::back();
    }

    public function updateData(Request $request, int $id, Blog $blog)
    {
        $generatedData = $this->generatorChatGptCollection->getGeneratedContentByIdExternal($blog->id);

        $actualGeneratedData = [];

        foreach ($generatedData['collections'] as $collection) {
            if (key_exists($collection['id_external'], $actualGeneratedData) || $collection['status_generate'] !== 3) {
                continue;
            }

            $actualGeneratedData[$collection['id_external']] = [
                'id' => $collection['id'],
                'created_at' => $collection['created_at'],
                'updated_at' => $collection['updated_at'],
                'prompt' => $collection['prompt'],
                'system' => $collection['system'],
                'sort' => $collection['sort'],
                'generated_content' => $collection['generated_content']
            ];

        }

        foreach ($blog->contents as $content) {
            if (!key_exists($content->id, $actualGeneratedData)) {
                continue;
            }

            $generatedContent = $actualGeneratedData[$content->id];

            if ($content->generatedData != $generatedContent['updated_at']) {
                $content->update([
                    'generatedData' => $generatedContent['updated_at'],
                    'content' => $generatedContent['generated_content'],
                    'status_generated' => 3
                ]);
            }
        }


        return Redirect::back();
    }

    public function generateEnglishPost(Request $request, Blog $blog)
    {
        $blogPolish = Blog::where('social_post_id', $blog->social_post_id)->where('language', 'pl')->first();

        $params = new ChatGptCollectionRequestDto();
        $params->setIdExternal($blog->id);
        $params->setTemperature('1');
        $params->setType('ARTICLE');
        $params->setModel(ChatGptCollectionRequestModelDto::GPT_4);
        $collection = [];
        $WEBHOOK = 'https://oatllo.pl/api/callback/generate/data/';

        foreach ($blogPolish->contents as $content) {
            $blogContent = BlogContent::create([
                'blog_id' => $blog->id,
                'header' => null,
                'content' => $content->content,
                'image_url' => null,
                'type' => BlogContentType::TEXT->value,
                'sequence' => $content->sequence,
                'status_generated' => 1
            ]);


            $collectionParams = new ChatGptCollectionDto();
            $collectionParams->setIdExternal($blogContent->id);
            $collectionParams->setSort($content->sequence);
            $collectionParams->setPrompt($content->content);
            $collectionParams->setWebhook($WEBHOOK . $blogContent->id);
            $collectionParams->setWebhookType('ARTICLE_CONTENT');
            $collectionParams->setSystem('Przetłumacz treść na język angielski. Nie usuwaj formatowania HTML. Zależy mi aby przetłumaczyć tylko treść na język angielski');

            $collection[] = $collectionParams;
        }

        $params->setCollection($collection);
        $this->generatorChatGptCollection->generateContentByCollection($params);

        return Redirect::back();
    }
}
