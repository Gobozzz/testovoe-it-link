<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Car;

use App\DTO\Car\CarCreateDTO;
use App\DTO\Car\CarOptionDTO;
use Illuminate\Foundation\Http\FormRequest;

class CarCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:1', 'max:99999999'],
            'photo_url' => ['required', 'url', 'max:255'],
            'contacts' => ['required', 'string', 'max:255'],
            'options' => ['nullable', 'array'],
            'options.brand' => ['required_with:options', 'string', 'max:60'],
            'options.model' => ['required_with:options', 'string', 'max:60'],
            'options.year' => ['required_with:options', 'integer', 'min:1888', 'max:'.now()->format('Y')],
            'options.body' => ['required_with:options', 'string', 'max:255'],
            'options.mileage' => ['required_with:options', 'integer', 'min:0', 'max:15000000'],
        ];
    }

    public function getDTO(): CarCreateDTO
    {
        $optionsCarDTO = null;
        $optionsRequest = $this->input('options', null);

        if ($optionsRequest !== null && ! empty($optionsRequest)) {
            $optionsCarDTO = new CarOptionDTO(
                brand: $this->input('options.brand'),
                model: $this->input('options.model'),
                year: $this->input('options.year'),
                body: $this->input('options.body'),
                mileage: $this->input('options.mileage'),
            );
        }

        return new CarCreateDTO(
            title: $this->input('title'),
            description: $this->input('description'),
            price: $this->input('price'),
            photoUrl: $this->input('photo_url'),
            contacts: $this->input('contacts'),
            option: $optionsCarDTO,
        );
    }
}
