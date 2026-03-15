<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Car;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailCarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'photo_url' => $this->photo_url,
            'contacts' => $this->contacts,
            'options' => new CarOptionResource($this->options),
        ];
    }
}
