<?php

declare(strict_types=1);

namespace App\Repositories\Car;

use App\DTO\Car\CarCreateDTO;
use App\Models\Car;
use Illuminate\Pagination\LengthAwarePaginator;

interface CarRepositoryContract
{
    public function findOrFail(int $id): Car;

    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(CarCreateDTO $data): Car;
}
