<?php

declare(strict_types=1);

namespace App\DTO\Car;

final readonly class CarCreateDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public float  $price,
        public string $photoUrl,
        public string $contacts,
    )
    {

    }
}
