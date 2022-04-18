<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function create(): RedirectResponse
    {
        $comment = request()->all();
        $selectedPost = Post::where('id', $comment["commentable_id"])->first();
        $users = User::all();
        Comment::create([
            'comment' => $comment["comment"],
            'user_Id' => $comment["userId"],
            'commentable_id' => $comment["commentable_id"]
        ]);
        return to_route('posts.show', ["post" => $selectedPost, 'users' => $users]);
    }

    public function delete(): RedirectResponse
    {
        $commentId = request()->route()->id;
        $postId = request()->all()["postId"];
        $selectedPost = Post::where('id', $postId)->first();
        $users = User::all();
        $selectedComment = Comment::where('id', $commentId)->first();
        $selectedComment->delete();
        $selectedComment->save();
        return to_route('posts.show', ["post" => $selectedPost, 'users' => $users]);
    }

    public function rollback(): RedirectResponse
    {
        $commentId = request()->route()->id;
        $postId = request()->all()["postId"];
        $selectedPost = Comment::where('id', $postId)->first();
        $users = User::all();
        Comment::where('id', $commentId)->restore();
        return to_route('posts.show', ["post" => $selectedPost, 'users' => $users]);
    }

}
