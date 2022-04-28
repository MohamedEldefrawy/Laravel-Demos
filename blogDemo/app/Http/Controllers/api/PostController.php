<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\GeneralResource;
use App\Http\Resources\GetAllPostResource;
use App\Http\Resources\PostResource;
use App\Repositories\IPostRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use function PHPUnit\Framework\isNull;

class PostController extends Controller
{


    private PostRepository $postRepository;

    public function __construct(IPostRepository $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postRepository->all();
        return GetAllPostResource::Collection($posts);
    }

    public function show(): PostResource|GeneralResource
    {
        $postId = request()->route()->id;
        $selectedPost = $this->postRepository->findById($postId);
        if (isNull($selectedPost))

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

    public function delete(): GeneralResource
    {
        $postId = request()->route()->id;
        $result = $this->postRepository->delete($postId);
        return new GeneralResource($result);
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

        $updatedPost = $this->postRepository->update($newPost);
        return new GeneralResource($updatedPost);
    }
}
