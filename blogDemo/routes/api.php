<?php

use App\Http\Controllers\api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('posts/{id}', [PostController::class, 'show'])->name('api.posts.show');
Route::post('posts', [PostController::class, 'store'])->name('api.posts.store');
Route::delete('posts/{id}', [PostController::class, 'delete'])->name('api.posts.delete');
Route::put('posts/{id}', [PostController::class, 'update'])->name('api.posts.update');

