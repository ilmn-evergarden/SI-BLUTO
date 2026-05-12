<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\News;
use App\Policies\GalleryPolicy;
use App\Policies\NewsPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive(); // atau useBootstrapFour()

    }

    protected $policies = [
        News::class => NewsPolicy::class,
        Gallery::class => GalleryPolicy::class,
    ];
}
