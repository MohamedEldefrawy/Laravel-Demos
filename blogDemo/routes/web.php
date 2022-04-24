<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('social-auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('social-auth/{provider}/callback', [SocialLoginController::class, 'providerCallback']);

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/edit', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/check_slug}', [PostController::class, 'checkSlug'])->name('posts.checkSlug');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
    Route::post('/posts/retrieve/{id}', [PostController::class, 'rollback'])->name('posts.retrieve');
    Route::post('/comments/{id}', [CommentController::class, 'create'])->name('comment.create');
    Route::delete('/comments/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
    Route::post('/comments/retrieve/{id}', [CommentController::class, 'rollback'])->name('comment.retrieve');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comment.update');
});

Auth::routes();
