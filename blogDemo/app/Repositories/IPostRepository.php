<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IPostRepository
{
    public function create($newPost);

    public function all(): LengthAwarePaginator;

    public function findById($postId);

    public function findByUsername($userName);

    public function update($newPost): array;

    public function delete($postId): array;
}
