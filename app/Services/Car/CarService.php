<?php

declare(strict_types=1);

namespace App\Services\Car;

use App\DTO\Car\CarCreateDTO;
use App\Models\Car;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\CarOption\CarOptionRepositoryContract;
use Illuminate\Support\Facades\DB;

final class CarService implements CarServiceContract
{
    public function __construct(
        private readonly CarRepositoryContract       $carRepository,
        private readonly CarOptionRepositoryContract $carOptionRepository,
    )
    {

    }

    public function create(CarCreateDTO $data): Car
    {
        return DB::transaction(function () use ($data) {
            $car = $this->carRepository->create($data);
            if ($data->option) {
                $this->carOptionRepository->create($car->getKey(), $data->option);
            }

            return $car;
        });
    }
}
