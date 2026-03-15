<?php

declare(strict_types=1);

namespace App\Services\Car;

use App\DTO\Car\CarCreateDTO;
use App\Models\Car;

interface CarServiceContract
{
    public function create(CarCreateDTO $data): Car;
}
