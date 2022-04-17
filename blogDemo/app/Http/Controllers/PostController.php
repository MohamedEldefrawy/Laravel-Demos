<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class PostController extends Controller
{

    public function index(): Factory|View|Application
    {
        $posts = Post::where('isDeleted', false)->get();
        return view('posts.index', ["posts" => $posts]);
    }

    public function create(): Factory|View|Application
    {
        $users = User::all();
        return view('posts.create', ["users" => $users]);
    }

    public function store(): RedirectResponse
    {
        $formData = request()->all();
        Post::create([
            'title' => $formData['title'],
            'user_id' => $formData['name'],
            'description' => $formData['description'],
            'email' => $formData['email'],
        ]);
        return to_route('posts.index');
    }

    public function edit($postId): Factory|View|Application
    {
        $post = Post::where('id', $postId)->where('isDeleted', false)->first();
        $users = User::all();
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function show($postId): Factory|View|Application
    {
        $post = Post::where('id', $postId)->first();
        return view('posts.show', ["post" => $post]);
    }

    public function update(): RedirectResponse
    {
        $newData = request()->all();
        $post = Post::find($newData["post"]);
        $post->title = $newData["title"];
        $post->description = $newData["description"];
        $post->user_id = $newData["userId"];
        $post->save();
        return to_route('posts.index');
    }

    public function delete(): RedirectResponse
    {
        $selectedPost = request()->all();
        dd($selectedPost);
        return to_route('posts.index');
    }
}
