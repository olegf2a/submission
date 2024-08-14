<?php

namespace App\Providers;

use App\Repositories\SubmissionRepository;
use App\Repositories\SubmissionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubmissionRepositoryInterface::class, SubmissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
