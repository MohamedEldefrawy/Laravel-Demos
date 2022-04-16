<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    public function index()
    {
        $posts = [
            ["id" => 1, "Title" => "Learn PHP", "Posted by" => "Mohamed", "Created at" => "15-4-2022"],
            ["id" => 2, "Title" => "Learn JAVA", "Posted by" => "Ahmed", "Created at" => "10-4-2022"],
            ["id" => 3, "Title" => "Learn C#", "Posted by" => "Ali", "Created at" => "12-4-2022"],
            ["id" => 4, "Title" => "Learn NodeJs", "Posted by" => "Ahmed", "Created at" => "12-3-2021"],
        ];
        return view('posts.index', ["posts" => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

    }

    public function edit()
    {
        return view('posts.edit');
    }

    public function show($postId)
    {
        $posts = [
            ["id" => 1, "Title" => "Learn PHP", "Name" => "Mohamed", "Created At" => "15-4-2022", "Description" => "nice", "Email" => "mohamed@gmail.com"],
            ["id" => 2, "Title" => "Learn JAVA", "Name" => "Ahmed", "Created At" => "10-4-2022", "Description" => "nice", "Email" => "ahmed@gmail.com"],
            ["id" => 3, "Title" => "Learn C#", "Name" => "Ali", "Created At" => "12-4-2022", "Description" => "nice", "Email" => "ali@gmail.com"],
            ["id" => 4, "Title" => "Learn NodeJs", "Name" => "omar", "Created At" => "12-3-2021", "Description" => "nice", "Email" => "omar@gmail.com"],
        ];

        // Eloquent get by ID
        return view('posts.show', ["post" => $posts[$postId - 1]]);
    }

}
