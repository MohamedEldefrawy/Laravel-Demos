<?php

namespace App\Providers;

use App\Repositories\IPostRepository;
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
        //
        $this->app->bind(IPostRepository::class, PostRepository::class);
    }
}
