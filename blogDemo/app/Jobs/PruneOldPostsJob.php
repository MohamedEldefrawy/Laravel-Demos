<?php

namespace App\Jobs;

use App\Models\Post;
use App\Workers\PostsWorkers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $post;
    public $tries = 2;

    /**
     * Create a new job instance.
     * @
     * @return void
     */
    public function __construct(Collection $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $postWorker = new PostsWorkers();
        $postWorker->setPosts($this->post);
        $postWorker->pruneDeletedPosts();
    }
}
