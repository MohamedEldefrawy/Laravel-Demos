<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Collection;

class PostsWorkers
{
    private Collection $posts;

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @param Collection $posts
     */
    public function setPosts(Collection $posts): void
    {
        $this->posts = $posts;
    }


    function pruneDeletedPosts(): void
    {
        foreach ($this->posts as $post) {
            if ($post->trashed())
                $post->forceDelete();
        }
    }
}
