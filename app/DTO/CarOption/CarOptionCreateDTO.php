<?php

declare(strict_types=1);

namespace App\DTO\CarOption;

final readonly class CarOptionCreateDTO
{
    public function __construct(
        public string $brand,
        public string $model,
        public int    $year,
        public string $body,
        public int    $mileage,
    )
    {

    }
}
