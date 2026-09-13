<?php

namespace App\Providers;

use App\Repositories\Eloquent\PaymentRepository ;
use App\Repositories\Interfaces\PaymentRepositoryInterface ;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // For Tailwind CSS (Laravel's default, no changes needed)
    Paginator::useTailwind();

    // For Bootstrap 5
    Paginator::useBootstrapFive();

    // For Bootstrap 4
    Paginator::useBootstrapFour();
    }
}
