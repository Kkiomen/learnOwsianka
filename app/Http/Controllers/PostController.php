<?php

namespace App\Http\Controllers;

use App\Enum\SocialType;
use App\Models\Blog;
use App\Models\Post;
use App\Models\SocialPost;
use App\Service\GeneratorArticleService;
use Gumlet\ImageResize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const SOCIAL_TYPES = [
        SocialType::FACEBOOK,
        SocialType::INSTAGRAM,
        SocialType::LINKEDIN,
        SocialType::TWITTER
    ];

    const LANGUAGES = [
        'pl', 'en'
    ];

    public function __construct(
        private GeneratorArticleService $generatorArticleService
    ) {
    }

    public function generateForSocialPost(Request $request, int $socialPostId)
    {

        $socialPost = SocialPost::where('id', $socialPostId)->first();

        if ($socialPost) {

            foreach (self::SOCIAL_TYPES as $socialType) {

               foreach (self::LANGUAGES as $language){
                   if (Post::where('social_post_id', $socialPost->id)->where('language', $language)->where('social_type',
                       $socialType->value)->exists()) {
                       continue;
                   }

                   foreach (Blog::where('social_post_id', $socialPost->id)->where('language', $language)->get() as $blog) {

                       $post = new Post();
                       $postContent = $this->generatorArticleService->generatePostToSocialMediaByBlogArticle($blog,
                           $socialType);

                       $post->social_post_id = $socialPostId;
                       $post->social_type = $socialType->value;
                       $post->text = $postContent;
                       $post->language = $blog->language;
                       $post->sended = false;

                       $post->save();
                   }
               }


            }


        }

        return Redirect::back();
    }

    public function regenerateForSocialPost(Request $request, int $postId)
    {

        $post = Post::where('id', $postId)->first();
        $socialPost = SocialPost::where('id', $post->social_post_id)->first();

        $blog = Blog::where('social_post_id', $socialPost->id)->where('language', $post->language)->first();


        $postContent = $this->generatorArticleService->generatePostToSocialMediaByBlogArticle($blog,
            SocialType::tryFrom($post->social_type));
        $post->text = $postContent;
        $post->save();

        return Redirect::back();
    }

    public function saveImageForSocialPost(Request $request, SocialPost $socialPost, string $language)
    {

        $sizes = [
            SocialType::FACEBOOK->value => [
                'width' => 1080,
                'height' => 1080
            ],
            SocialType::INSTAGRAM->value => [
                'width' => 1080,
                'height' => 1080
            ],
            SocialType::TWITTER->value => [
                'width' => 1000,
                'height' => 500
            ],
            SocialType::LINKEDIN->value => [
                'width' => 1200,
                'height' => 627
            ],
            'article' => [
                'width' => 1080,
                'height' => 1080
            ]
        ];


        if ($request->hasFile('file-upload')) {
            $file = $request->file('file-upload');
            $fileName = rand(1, 9999999) . $file->getClientOriginalName() . $file->getClientOriginalExtension();
            $path = $file->storeAs('folder/docelowy', $fileName, 'public');
            dd($path);
            $disk = Storage::build([
                'driver' => 'local',
                'root' => storage_path('app/public'),
            ]);
            $disk->put($fileName, $file, 'public');

            foreach (Post::where('social_post_id', $socialPost->id)->where('language', $language)->get() as $post) {
                $post->image = $fileName;
                $post->save();
            }

            $blogs = Blog::where('social_post_id', $socialPost->id)->where('language', $language)->get();
            foreach ($blogs as $blog) {
                $blog->image_url = $fileName;
                $blog->save();
            }

        }

        if ($request->hasFile('file-uploade')) {
            $file = $request->file('file-uploade');
            $fileName = rand(1, 9999999) . $file->getClientOriginalName();
            $file->storeAs('image/', $fileName, 'public');

            foreach (Post::where('social_post_id', $socialPost->id)->where('language', $language)->get() as $post) {
                $post->image = $fileName;
                $post->save();
            }

            $blogs = Blog::where('social_post_id', $socialPost->id)->where('language', $language)->get();
            foreach ($blogs as $blog) {
                $blog->image_url = $fileName;
                $blog->save();
            }

        }

        return Redirect::back();
    }

    public function sendSocialPost(Request $request, SocialPost $socialPost)
    {
        $posts = Post::where('social_post_id', $socialPost->id)->get();

        $payload = [];

        foreach ($posts as $post) {
            $payload[$post->social_type][$post->language] = [
                'image' => 'https://i.imgur.com/PGlploS.png' ?? asset('storage/uploads/' . $post->social_type . '/' . $post->image),
                'language' => $post->language,
                'content' => $post->text
            ];
        }

        $webhook = 'https://hook.eu1.make.com/d295mnhzphpuh38a2e2a0xpu9jowhe7u';

        $response = Http::post($webhook, $payload);

        dd($payload);
    }
}
