<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\BaseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
