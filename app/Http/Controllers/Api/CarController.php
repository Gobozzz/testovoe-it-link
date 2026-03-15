<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Car\CarCreateRequest;
use App\Http\Resources\Api\Car\CarResource;
use App\Http\Resources\Api\Car\DetailCarResource;
use App\Repositories\Car\CarRepositoryContract;
use App\Services\Car\CarServiceContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarController extends Controller
{
    public function __construct(
        private readonly CarServiceContract $carService,
        private readonly CarRepositoryContract $carRepository,
    ) {}

    public function create(CarCreateRequest $request): CarResource
    {
        $car = $this->carService->create($request->getDTO());

        return new CarResource($car);
    }

    public function getById(int $id): DetailCarResource
    {
        return new DetailCarResource($this->carRepository->findOrFail($id));
    }

    public function getList(): AnonymousResourceCollection
    {
        return CarResource::collection($this->carRepository->paginate());
    }
}
