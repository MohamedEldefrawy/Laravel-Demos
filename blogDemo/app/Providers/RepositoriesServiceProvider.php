<?php

namespace App\Providers;

use App\Contracts\IBaseRepository;
use App\Contracts\IPostRepository;
use App\Repositories\BaseRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
    }
}
