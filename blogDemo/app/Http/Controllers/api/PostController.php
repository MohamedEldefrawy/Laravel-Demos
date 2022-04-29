<?php

namespace App\Http\Controllers\api;

use App\Contracts\IPostRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\GetAllPostResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use function PHPUnit\Framework\isNull;

class PostController extends Controller
{


    private IPostRepository $postRepository;

    public function __construct(IPostRepository $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postRepository->all(10);
        return GetAllPostResource::Collection($posts);
    }

    public function show()
    {
        $postId = request()->route()->id;
        $selectedPost = $this->postRepository->findById($postId);
        if ($selectedPost == null)
            return new GeneralResource(["message" => "couldn't find Post",
                "status" => false]);

        return new PostResource($selectedPost);
    }

    public function store(CreatePostRequest $request): PostResource
    {
        $body = request()->all();
        $newPost = [
            'title' => $body['title'],
            'user_id' => $body['user_id'],
            'description' => $body['description'],
            'email' => $body['email'],
        ];

        $result = $this->postRepository->create($newPost);

        return new PostResource($result);
    }

    public function delete()
    {
        $postId = request()->route()->id;
        $result = $this->postRepository->delete($postId);

        if ($result > 0) {
            return new GeneralResource(["status" => true,
                "message" => "post has been deleted"]);
        }

        return new GeneralResource(["status" => false,
            "message" => "failed to delete post"]);
    }

    public function update(CreatePostRequest $request): GeneralResource
    {
        $postId = request()->route()->id;
        $request->validated();
        $newData = request()->all();

        $newPost = [
            'id' => $postId,
            'title' => $newData["title"],
            'description' => $newData['description'],
            'userId' => $newData["userId"]
        ];

        $updatedPost = $this->postRepository->update($postId, $newPost);

        if ($updatedPost) {
            return new GeneralResource(["status" => true,
                "message" => "post has been updated"]);
        }

        return new GeneralResource(["status" => false,
            "message" => "failed to update post"]);
    }
}
