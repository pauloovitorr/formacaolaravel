<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{

    // 1° Forma -> Por atributo, com isso posso ir migrando vários serviços aos poucos
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];


    // 2° Forma -> Por atributo
    /**
     * Register services. Responsável por ligar uma interface a uma classse concreta
     */
    // public function register(): void
    // {
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
