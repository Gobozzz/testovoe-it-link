<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarOption extends Model
{
    /** @use HasFactory<\Database\Factories\CarOptionFactory> */
    use HasFactory;

    protected $fillable = [
        "car_id",
        "brand",
        "model",
        "year",
        "body",
        "mileage",
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

}
