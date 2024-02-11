<?php

namespace App\Providers;

use App\GenerateDescription\Adapters\ProductUrlFetcher\ProductUrlFetcher;
use App\GenerateDescription\Adapters\ProductUrlFetcher\SerperApiProductUrlFetcher\SerperApiProductUrlFetcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductUrlFetcher::class, SerperApiProductUrlFetcher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
