<?php

use App\Http\Controllers\api\PostController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {

        return $request->user();
    });
    Route::get('posts', [PostController::class, 'index'])->name('api.posts.index');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('api.posts.show');
    Route::post('posts', [PostController::class, 'store'])->name('api.posts.store');
    Route::delete('posts/{id}', [PostController::class, 'delete'])->name('api.posts.delete');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('api.posts.update');
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->email)->plainTextToken;
});
