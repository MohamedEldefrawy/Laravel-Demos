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
}
