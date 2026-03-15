<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'photo_url',
        'contacts',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function options(): HasOne
    {
        return $this->hasOne(CarOption::class);
    }
}
