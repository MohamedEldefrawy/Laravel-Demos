<?php

namespace App\Repositories;

use App\Contracts\IPostRepository;
use App\Models\Post;


class PostRepository extends BaseRepository implements IPostRepository
{

    private Post $model;

    public function __construct(Post $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
