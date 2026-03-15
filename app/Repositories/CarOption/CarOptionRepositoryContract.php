<?php

declare(strict_types=1);

namespace App\Repositories\CarOption;

use App\DTO\CarOption\CarOptionCreateDTO;
use App\Models\CarOption;

interface CarOptionRepositoryContract
{
    public function create(int $carId, CarOptionCreateDTO $data): CarOption;
}
