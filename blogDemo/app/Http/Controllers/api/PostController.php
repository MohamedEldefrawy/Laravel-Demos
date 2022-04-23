<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\JsonResource;
use App\Http\Resources\GetAllPostResource;
use App\Http\Resources\PostResource;
use App\Jobs\PruneOldPostsJob;
use App\Models\BooleanResponse;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::withTrashed()->with('comments')
            ->paginate(10);
        $this->dispatch(new PruneOldPostsJob(Post::withTrashed()->get()));
        return GetAllPostResource::Collection($posts);
    }

    public function show(): PostResource
    {
        $postId = request()->route()->id;
        return new PostResource(Post::withTrashed()->with('comments')->find($postId));
    }

    public function store(CreatePostRequest $request): PostResource
    {
        $body = request()->all();

        return new PostResource(Post::create([
            'title' => $body['title'],
            'user_id' => $body['user_id'],
            'description' => $body['description'],
            'email' => $body['email'],
        ]));
    }

    public function delete()
    {
        $postId = request()->route()->id;
        $post = Post::withTrashed()->find($postId);
        if ($post == null) {
            $response = new BooleanResponse();
            $response->message = "couldn't find Post";
            $response->status = false;
            return new JsonResource($response);
        }
        $result = $post->forceDelete();
        if ($result == 1) {
            $response = new BooleanResponse();
            $response->message = "Post has been deleted";
            $response->status = true;
            return new JsonResource($response);
        }
    }

    public function update(CreatePostRequest $request): JsonResource
    {
        $postId = request()->route()->id;
        $newData = request()->all();
        $post = Post::find($postId);
        if ($post == null) {
            $response = new BooleanResponse();
            $response->message = "couldn't find Post";
            $response->status = false;
            return new JsonResource($response);
        }
        $post->title = $newData["title"];
        $post->description = $newData["description"];
        $post->user_id = $newData["userId"];
        $result = $post->save();
        $response = new BooleanResponse();
        $response->message = "Post has been updated";
        $response->status = true;
        return new JsonResource($response);

    }
}
