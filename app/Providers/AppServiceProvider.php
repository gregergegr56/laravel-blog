<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Listeners\LogPostCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        // Слушатель LogPostCreated Laravel находит автоматически (app/Listeners)
        // Event::listen(PostCreated::class, LogPostCreated::class);
    }
}
