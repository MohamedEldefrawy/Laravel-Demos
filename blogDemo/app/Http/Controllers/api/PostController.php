<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        $posts = Post::withTrashed()
            ->paginate(10);
        $this->dispatch(new PruneOldPostsJob(Post::withTrashed()->get()));
        return $posts;
    }

    public function show(): Builder|array|Collection|Model|\Illuminate\Database\Query\Builder
    {
        $postId = request()->route()->id;
        return Post::withTrashed()->find($postId) == null ? ["success" => false, "message" => "post not found"] : Post::withTrashed()->find($postId);
    }

    public function store(CreatePostRequest $request)
    {
        $body = request()->all();

        return Post::create([
            'title' => $body['title'],
            'user_id' => $body['user_id'],
            'description' => $body['description'],
            'email' => $body['email'],
        ]);
    }

    public function delete()
    {
        $postId = request()->route()->id;
        $post = Post::withTrashed()->find($postId);
        if ($post == null) {
            return ["success" => false, "method" => "couldn't find Post"];
        }
        $result = $post->forceDelete();
        if ($result == 1)
            return ["success" => true, "method" => "Post has been deleted"];
    }

    public function update(CreatePostRequest $request): array
    {
        $postId = request()->route()->id;
        $newData = request()->all();
        $post = Post::find($postId);
        if ($post == null) {
            return ["success" => false, "method" => "couldn't find Post"];
        }
        $post->title = $newData["title"];
        $post->description = $newData["description"];
        $post->user_id = $newData["userId"];
        $result = $post->save();
        return ["success" => true, "method" => "Post has been updated"];
    }
}
