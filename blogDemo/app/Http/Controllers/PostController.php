<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    public function index()
    {

        $posts = $this->getPosts();
        return view('posts.index', ["posts" => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

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

    /**
     * @return array[]
     */
    public function getPosts(): array
    {
        return [
            ["id" => 1, "Title" => "Learn PHP", "Name" => "Mohamed", "Created At" => "15-4-2022", "Description" => "nice", "Email" => "mohamed@gmail.com"],
            ["id" => 2, "Title" => "Learn JAVA", "Name" => "Ahmed", "Created At" => "10-4-2022", "Description" => "nice", "Email" => "ahmed@gmail.com"],
            ["id" => 3, "Title" => "Learn C#", "Name" => "Ali", "Created At" => "12-4-2022", "Description" => "nice", "Email" => "ali@gmail.com"],
            ["id" => 4, "Title" => "Learn NodeJs", "Name" => "omar", "Created At" => "12-3-2021", "Description" => "nice", "Email" => "omar@gmail.com"],
        ];
    }

}
