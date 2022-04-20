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
        Comment::create([
            'comment' => $comment["comment"],
            'user_Id' => $comment["userId"],
            'commentable_id' => request()->route()->id
        ]);
        return new PostViewResponse([], request()->route()->id);
    }

    public function delete(): PostViewResponse
    {
        $commentId = request()->route()->id;
        $selectedComment = Comment::withTrashed()->findOrFail($commentId);
        $selectedComment->delete();
        $selectedComment->save();
        return new PostViewResponse([], $selectedComment->commentable_id);
    }

    public function rollback(): PostViewResponse
    {
        $commentId = request()->route()->id;
        $selectedComment = Comment::withTrashed()->findOrFail($commentId);
        $selectedComment->restore();
        return new PostViewResponse([], $selectedComment->commentable_id);
    }

    public function update()
    {
        $commentId = request()->route()->id;
        $formData = request()->all();
        $selectedComment = Comment::withTrashed()->findOrFail($commentId);
        $selectedComment->update([
            'user_Id' => $formData["userId"],
            'comment' => $formData["comment"]
        ]);
        return new PostViewResponse([], $selectedComment->commentable_id);
    }

}
