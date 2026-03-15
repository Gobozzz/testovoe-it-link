<?php

declare(strict_types=1);

namespace App\Repositories\CarOption;

use App\DTO\Car\CarOptionDTO;
use App\Models\CarOption;

final class CarOptionEloquentRepository implements CarOptionRepositoryContract
{
    public function create(int $carId, CarOptionDTO $data): CarOption
    {
        return CarOption::query()->create([
            'car_id' => $carId,
            'brand' => $data->brand,
            'model' => $data->model,
            'year' => $data->year,
            'body' => $data->body,
            'mileage' => $data->mileage,
        ]);
    }
}
