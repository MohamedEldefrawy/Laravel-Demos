<?php

namespace App\Http\Responses;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class PostCreateView implements Responsable
{
    public array $props;
    private $postId;

    public function __construct(array $data = [], $postId)
    {
        $this->postId = $postId;
        $this->props = array_merge($this->getDefaultProps(), $data);
    }

    public function toResponse($request): View|Factory|Response|Application
    {
        return view('posts.show', $this->props);
    }

    private function getDefaultProps(): array
    {
        $post = Post::where('id', $this->postId)->first();
        $users = User::all();
        return
            ["post" => $post, 'users' => $users];
    }
}
