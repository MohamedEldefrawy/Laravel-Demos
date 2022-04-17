<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PostController extends Controller
{

    public function index(): Factory|View|Application
    {
        $posts = Post::all();
        return view('posts.index', ["posts" => $posts]);
    }

    public function create()
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

    public function edit($postId)
    {
        $post = Post::where('id', $postId)->first();
//        dd($post->user_id);
        $users = User::all();
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function show($postId)
    {
        $posts = $this->getPosts();

        return view('posts.show', ["post" => $posts[$postId - 1]]);
    }

    public function update()
    {
        $posts = $this->getPosts();
        return view('posts.index', ["posts" => $posts]);
    }

}
