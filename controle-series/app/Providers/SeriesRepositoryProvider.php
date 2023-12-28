<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
     ];

    // public function register(): void
    // {
    //     //ligar um interface a uma implementação
    //     $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    // }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
