<?php

namespace App\Repositories;

use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class PostRepository implements IPostRepository
{

    public function create($newPost)
    {
        return Post::create($newPost);
    }

    public function all(): LengthAwarePaginator
    {
        dispatch(new PruneOldPostsJob(Post::withTrashed()->get()));

        return Post::withTrashed()->with('comments')
            ->paginate(10);
    }

    public function findById($postId)
    {
        return Post::withTrashed()->with('comments')->find($postId);
    }

    public function findByUsername($userName)
    {
        return Post::withTrashed()->with('comments')->with('users')->where('name', $userName);

    }

    public function update($newPost): array
    {
        $post = Post::find($newPost["id"]);

        if ($post == null) {
            return ["message" => "couldn't find Post",
                "status" => false];
        }

        $post->update([
            'title' => $newPost["title"],
            'description' => $newPost['description'],
            'userId' => $newPost["title"],
        ]);

        return ["message" => "Post has been updated",
            "status" => true];
    }

    public function delete($postId): array
    {
        $selectedPost = $this->findById($postId);

        if ($selectedPost == null) {
            return ["message" => "couldn't find Post",
                "status" => false];
        }

        $selectedPost->forceDelete();

        return ["message" => "Post has been deleted",
            "status" => true];
    }

}
