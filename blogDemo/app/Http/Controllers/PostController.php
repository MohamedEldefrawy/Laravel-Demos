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
        $posts = $this->getPosts();

        return view('posts.edit', ['post' => $posts[$postId - 1]]);
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
//
//    /**
//     * @return array[]
//     */
//    public function getPosts(): array
//    {
//        return [
//            ["id" => 1, "Title" => "Learn PHP", "Name" => "Mohamed", "Created At" => "15-4-2022", "Description" => "nice", "Email" => "mohamed@gmail.com"],
//            ["id" => 2, "Title" => "Learn JAVA", "Name" => "Ahmed", "Created At" => "10-4-2022", "Description" => "nice", "Email" => "ahmed@gmail.com"],
//            ["id" => 3, "Title" => "Learn C#", "Name" => "Ali", "Created At" => "12-4-2022", "Description" => "nice", "Email" => "ali@gmail.com"],
//            ["id" => 4, "Title" => "Learn NodeJs", "Name" => "omar", "Created At" => "12-3-2021", "Description" => "nice", "Email" => "omar@gmail.com"],
//        ];
//    }

}
