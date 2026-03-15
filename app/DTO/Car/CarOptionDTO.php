<?php

declare(strict_types=1);

namespace App\DTO\Car;

final readonly class CarOptionDTO
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
