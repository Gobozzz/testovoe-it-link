<?php

namespace App\Providers;

use App\Repositories\Car\CarEloquentRepository;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\CarOption\CarOptionEloquentRepository;
use App\Repositories\CarOption\CarOptionRepositoryContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CarRepositoryContract::class, CarEloquentRepository::class);
        $this->app->bind(CarOptionRepositoryContract::class, CarOptionEloquentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
