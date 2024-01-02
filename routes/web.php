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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('/dashboard/event/add', [\App\Http\Controllers\CalendarController::class, 'addEvent'])->name('addEvent');
    Route::post('/dashboard/event/save', [\App\Http\Controllers\CalendarController::class, 'saveEvent'])->name('saveEvent');



    Route::get('/dashboard/social-post/list', [\App\Http\Controllers\SocialPostController::class, 'list'])->name('socialPost.list');
    Route::get('/dashboard/social-post/remove/{id}', [\App\Http\Controllers\SocialPostController::class, 'remove'])->name('socialPost.remove');
    Route::get('/dashboard/social-post/remove/blog/{id}', [\App\Http\Controllers\SocialPostController::class, 'deleteBlog'])->name('socialPost.deleteBlog');
    Route::get('/dashboard/social-post/view/{id}', [\App\Http\Controllers\SocialPostController::class, 'view'])->name('socialPost.view');
    Route::get('/dashboard/social-post/view/{id}/generate/article/{language}', [\App\Http\Controllers\SocialPostController::class, 'generateArticle'])->name('socialPost.generateArticle');
    Route::get('/dashboard/social-post/view/generate/blog/{blogId}/article/add/{type}/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'generateArticleAddContent'])->name('socialPost.generateArticleAddContent');
    Route::get('/dashboard/social-post/view/remove/blog-content/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'removeBlogContent'])->name('socialPost.removeBlogContent');
    Route::post('/dashboard/social-post/view/update/blog-content/{contentId}', [\App\Http\Controllers\SocialPostController::class, 'updateBlogContent'])->name('socialPost.updateBlogContent');
    Route::get('/dashboard/social-post/view/update/blog-content/{contentId}/design', [\App\Http\Controllers\SocialPostController::class, 'updateDesignBlogContent'])->name('socialPost.updateDesignBlogContent');
    Route::get('/dashboard/social-post/view/update/blog-content/{contentId}/generate', [\App\Http\Controllers\SocialPostController::class, 'generateBlogContent'])->name('socialPost.generateBlogContent');
    Route::post('/dashboard/social-post/add', [\App\Http\Controllers\SocialPostController::class, 'add'])->name('socialPost.add');

    Route::get('/dashboard/posts/generate/{socialPostId}', [\App\Http\Controllers\PostController::class, 'generateForSocialPost'])->name('generateForSocialPost.generate');
    Route::get('/dashboard/posts/generate/post/{postId}', [\App\Http\Controllers\PostController::class, 'regenerateForSocialPost'])->name('regenerateForSocialPost.generate');
    Route::post('/dashboard/posts/generate/image/post/{socialPost}/{language}', [\App\Http\Controllers\PostController::class, 'saveImageForSocialPost'])->name('saveImageForSocialPost.generate');
    Route::get('/dashboard/posts/generate/image/send/{socialPost}', [\App\Http\Controllers\PostController::class, 'sendSocialPost'])->name('sendSocialPost.socialMedia');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
