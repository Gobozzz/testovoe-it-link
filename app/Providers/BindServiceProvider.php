<?php

namespace App\Providers;

use App\Repositories\Car\CarEloquentRepository;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\CarOption\CarOptionEloquentRepository;
use App\Repositories\CarOption\CarOptionRepositoryContract;
use App\Services\Car\CarService;
use App\Services\Car\CarServiceContract;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // repo
        $this->app->bind(CarRepositoryContract::class, CarEloquentRepository::class);
        $this->app->bind(CarOptionRepositoryContract::class, CarOptionEloquentRepository::class);

        // services
        $this->app->bind(CarServiceContract::class, CarService::class);
    }

    public function boot(): void
    {
        //
    }
}
