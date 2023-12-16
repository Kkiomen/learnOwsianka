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
Route::get('/blog/{slug}', [\App\Http\Controllers\HomeController::class, 'blogPost'])->name('blogPost');
Route::get('/blog', [\App\Http\Controllers\HomeController::class, 'blog'])->name('blog');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('/dashboard/event/add', [\App\Http\Controllers\CalendarController::class, 'addEvent'])->name('addEvent');
    Route::post('/dashboard/event/save', [\App\Http\Controllers\CalendarController::class, 'saveEvent'])->name('saveEvent');



    Route::get('/dashboard/social-post/list', [\App\Http\Controllers\SocialPostController::class, 'list'])->name('socialPost.list');
    Route::get('/dashboard/social-post/remove/{id}', [\App\Http\Controllers\SocialPostController::class, 'remove'])->name('socialPost.remove');
    Route::get('/dashboard/social-post/view/{id}', [\App\Http\Controllers\SocialPostController::class, 'view'])->name('socialPost.view');
    Route::post('/dashboard/social-post/add', [\App\Http\Controllers\SocialPostController::class, 'add'])->name('socialPost.add');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
