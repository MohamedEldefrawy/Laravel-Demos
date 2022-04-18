<?php

namespace App\Http\Controllers;

use App\Http\Responses\PostViewResponse;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function create(): PostViewResponse
    {
        $comment = request()->all();
        $selectedPost = Post::where('id', $comment["commentable_id"])->first();
        $users = User::all();
        Comment::create([
            'comment' => $comment["comment"],
            'user_Id' => $comment["userId"],
            'commentable_id' => $comment["commentable_id"]
        ]);
        return new PostViewResponse([], $comment["commentable_id"]);
    }

    public function delete(): PostViewResponse
    {
        $commentId = request()->route()->id;
        $postId = request()->all()["postId"];
        $selectedPost = Post::where('id', $postId)->first();
        $users = User::all();
        $selectedComment = Comment::where('id', $commentId)->first();
        $selectedComment->delete();
        $selectedComment->save();
        return new PostViewResponse([], $postId);

    }

    public function rollback(): PostViewResponse
    {
        $commentId = request()->route()->id;
        $postId = request()->all()["postId"];
        $selectedPost = Comment::where('id', $postId)->first();
        $users = User::all();
        Comment::where('id', $commentId)->restore();
        return new PostViewResponse([], $postId);
    }

}
