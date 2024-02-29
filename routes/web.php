<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/counter', \App\Livewire\Counter::class)->name('architectureNavigation');
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/article/{slug}', [\App\Http\Controllers\HomeController::class, 'blogPost'])->name('blogPost');
Route::get('/blog', [\App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/blog/tag/{tag}', [\App\Http\Controllers\HomeController::class, 'blogListTag'])->name('blogListTag');
Route::get('/test', [\App\Http\Controllers\TestController::class, 'test'])->name('test');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('/dashboard/event/add', [\App\Http\Controllers\CalendarController::class, 'addEvent'])->name('addEvent');
    Route::post('/dashboard/event/save', [\App\Http\Controllers\CalendarController::class, 'saveEvent'])->name('saveEvent');



    Route::get('/dashboard/social-post/list', [\App\Http\Controllers\SocialPostController::class, 'list'])->name('socialPost.list');
    Route::get('/dashboard/social-post/list-edit/{id}', [\App\Http\Controllers\SocialPostController::class, 'listEdit'])->name('socialPost.listEdit');
    Route::get('/dashboard/social-post/generate/title', [\App\Http\Controllers\SocialPostController::class, 'generateTitle'])->name('socialPost.generateTitle');
    Route::get('/dashboard/social-post/generate/update-sitemap', [\App\Http\Controllers\SocialPostController::class, 'updateSitemap'])->name('socialPost.updateSitemap');
    Route::get('/dashboard/social-post/remove/{id}', [\App\Http\Controllers\SocialPostController::class, 'remove'])->name('socialPost.remove');
    Route::get('/dashboard/social-post/remove/blog/{id}', [\App\Http\Controllers\SocialPostController::class, 'deleteBlog'])->name('socialPost.deleteBlog');
    Route::get('/dashboard/social-post/view/{id}/article', [\App\Http\Controllers\SocialPostController::class, 'view'])->name('socialPost.view.article');
    Route::get('/dashboard/social-post/view/{id}/posts', [\App\Http\Controllers\SocialPostController::class, 'viewPosts'])->name('socialPost.view.posts');
    Route::get('/dashboard/social-post/view/{id}/blog/generate', [\App\Http\Controllers\SocialPostController::class, 'generateAllContent'])->name('socialPost.content-blog.generate');
    Route::get('/dashboard/social-post/view/{id}/blog/generate-prototype', [\App\Http\Controllers\SocialPostController::class, 'generateContentPrototype'])->name('socialPost.content-blog.generate.prototype');
    Route::get('/dashboard/social-post/viewGenerate/blog/generate-english_post/{blog}', [\App\Http\Controllers\SocialPostController::class, 'generateEnglishPost'])->name('socialPost.content-blog.generate.english');
    Route::get('/dashboard/social-post/view/{id}/create/article/{language}', [\App\Http\Controllers\SocialPostController::class, 'createArticle'])->name('socialPost.createArticle');
    Route::get('/dashboard/social-post/view/{id}/generate/article/{language}', [\App\Http\Controllers\SocialPostController::class, 'generateArticle'])->name('socialPost.generateArticle');
    Route::get('/dashboard/social-post/view/blog-content/{id}/generate/update-data/{blog}', [\App\Http\Controllers\SocialPostController::class, 'updateData'])->name('socialPost.updateDataApi');
    Route::get('/dashboard/social-post/view/generate/blog/{blogId}/article/add/{type}/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'generateArticleAddContent'])->name('socialPost.generateArticleAddContent');
    Route::get('/dashboard/social-post/view/remove/blog-content/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'removeBlogContent'])->name('socialPost.removeBlogContent');
    Route::post('/dashboard/social-post/view/update/blog-content/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'updateBlogContent'])->name('socialPost.updateBlogContent');
    Route::get('/dashboard/social-post/view/update/blog-content/{contentId}/design', [\App\Http\Controllers\SocialPostController::class, 'updateDesignBlogContent'])->name('socialPost.updateDesignBlogContent');
    Route::get('/dashboard/social-post/view/update/blog-content/{contentId}/generate', [\App\Http\Controllers\SocialPostController::class, 'generateBlogContent'])->name('socialPost.generateBlogContent');
    Route::post('/dashboard/social-post/add', [\App\Http\Controllers\SocialPostController::class, 'add'])->name('socialPost.add');
    Route::post('/dashboard/social-post/edit/{socialPost}', [\App\Http\Controllers\SocialPostController::class, 'edit'])->name('socialPost.edit');

    Route::get('/dashboard/posts/generate/{socialPostId}', [\App\Http\Controllers\PostController::class, 'generateForSocialPost'])->name('generateForSocialPost.generate');
    Route::get('/dashboard/posts/generate/post/{postId}', [\App\Http\Controllers\PostController::class, 'regenerateForSocialPost'])->name('regenerateForSocialPost.generate');
    Route::post('/dashboard/posts/generate/image/post/{socialPost}/{language}', [\App\Http\Controllers\PostController::class, 'saveImageForSocialPost'])->name('saveImageForSocialPost.generate');
    Route::get('/dashboard/posts/generate/image/send/{socialPost}', [\App\Http\Controllers\PostController::class, 'sendSocialPost'])->name('sendSocialPost.socialMedia');

    Route::get('/dashboard/courses/list', [\App\Http\Controllers\CourseController::class, 'list'])->name('course.list');
    Route::post('/dashboard/courses/add', [\App\Http\Controllers\CourseController::class, 'add'])->name('course.add');
    Route::get('/dashboard/courses/view/{course}', [\App\Http\Controllers\CourseController::class, 'view'])->name('course.view');
    Route::post('/dashboard/courses/edit/{course}', [\App\Http\Controllers\CourseController::class, 'edit'])->name('course.edit');
    Route::post('/dashboard/courses/category/{course}/add', [\App\Http\Controllers\CourseController::class, 'categoryAdd'])->name('course.category.add');
    Route::post('/dashboard/courses/category/{course}/edit/{category}', [\App\Http\Controllers\CourseController::class, 'categoryEdit'])->name('course.category.edit');
    Route::get('/dashboard/courses/category/{course}/add-blog/{category}', [\App\Http\Controllers\CourseController::class, 'categoryAddBlog'])->name('course.category.add-blog');
    Route::post('/dashboard/courses/category/{course}/add-blog/{category}/blog/{blog}', [\App\Http\Controllers\CourseController::class, 'categoryAddBlogPost'])->name('course.category.add.blog.new');
    Route::post('/dashboard/courses/category/{course}/add-blog/{category}/update/{categoryLessons}', [\App\Http\Controllers\CourseController::class, 'categoryUpdateBlogPost'])->name('course.category.update');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
