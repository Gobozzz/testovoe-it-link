<?php

declare(strict_types=1);

namespace App\Repositories\Car;

use App\DTO\Car\CarCreateDTO;
use App\Models\Car;
use Illuminate\Pagination\LengthAwarePaginator;

final class CarEloquentRepository implements CarRepositoryContract
{
    public function findOrFail(int $id): Car
    {
        return Car::query()->findOrFail($id);
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Car::query()->paginate($perPage);
    }

    public function create(CarCreateDTO $data): Car
    {
        return Car::query()->create([
            'title' => $data->title,
            'description' => $data->description,
            'price' => $data->price,
            'photo_url' => $data->photoUrl,
            'contacts' => $data->contacts,
        ]);
    }
}
