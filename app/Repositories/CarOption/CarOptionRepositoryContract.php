<?php

declare(strict_types=1);

namespace App\Repositories\CarOption;

use App\DTO\Car\CarOptionDTO;
use App\Models\CarOption;

interface CarOptionRepositoryContract
{
    public function create(int $carId, CarOptionDTO $data): CarOption;
}
