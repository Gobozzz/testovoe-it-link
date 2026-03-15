<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Car;

use App\DTO\Car\CarCreateDTO;
use App\DTO\Car\CarOptionDTO;
use App\Models\Car;
use App\Models\CarOption;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\CarOption\CarOptionRepositoryContract;
use App\Services\Car\CarService;
use Illuminate\Support\Facades\DB;
use Mockery;
use PHPUnit\Framework\TestCase;

class CarCreateTest extends TestCase
{
    private CarRepositoryContract $carRepository;

    private CarOptionRepositoryContract $carOptionRepository;

    private CarService $carService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carRepository = Mockery::mock(CarRepositoryContract::class);
        $this->carOptionRepository = Mockery::mock(CarOptionRepositoryContract::class);

        $this->carService = new CarService($this->carRepository, $this->carOptionRepository);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    public function test_success_create_with_options(): void
    {
        $idCreatedCar = 1;

        $expectedCarOptionDTO = new CarOptionDTO(
            brand: 'Car option brand',
            model: 'Car option model',
            year: 2026,
            body: 'Car option body',
            mileage: 1000,
        );

        $expectedCarCreateDTO = new CarCreateDTO(
            title: 'Car title',
            description: 'Car description',
            price: 50000,
            photoUrl: 'https://example.com/photo.jpg',
            contacts: '+77777777777',
            option: $expectedCarOptionDTO,
        );

        $createdCar = Mockery::mock(Car::class);
        $createdCar->shouldReceive('getKey')->andReturn($idCreatedCar);

        $this->carRepository
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CarCreateDTO $dto) use ($expectedCarCreateDTO) {
                return $this->carCreateDTOsIsEqual($dto, $expectedCarCreateDTO);
            }))
            ->andReturn($createdCar);

        $this->carOptionRepository
            ->shouldReceive('create')
            ->once()
            ->with($idCreatedCar, Mockery::on(function (CarOptionDTO $dto) use ($expectedCarOptionDTO) {
                return $this->carOptionDTOsIsEqual($dto, $expectedCarOptionDTO);
            }))
            ->andReturn(new CarOption);

        DB::shouldReceive('transaction')
            ->once()
            ->with(Mockery::on(function ($callback) {
                $callback();

                return true;
            }))
            ->andReturn(new Car);

        $this->carService->create($expectedCarCreateDTO);

        $this->addToAssertionCount(1);
    }

    public function test_success_create_without_options(): void
    {
        $idCreatedCar = 1;

        $expectedCarCreateDTO = new CarCreateDTO(
            title: 'Car title',
            description: 'Car description',
            price: 50000,
            photoUrl: 'https://example.com/photo.jpg',
            contacts: '+77777777777',
            option: null,
        );

        $createdCar = Mockery::mock(Car::class);
        $createdCar->shouldReceive('getKey')->andReturn($idCreatedCar);

        $this->carRepository
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CarCreateDTO $dto) use ($expectedCarCreateDTO) {
                return $this->carCreateDTOsIsEqual($dto, $expectedCarCreateDTO);
            }))
            ->andReturn($createdCar);

        DB::shouldReceive('transaction')
            ->once()
            ->with(Mockery::on(function ($callback) {
                $callback();

                return true;
            }))
            ->andReturn(new Car);

        $this->carService->create($expectedCarCreateDTO);

        $this->addToAssertionCount(1);
    }

    private function carCreateDTOsIsEqual(CarCreateDTO $createdDTO, CarCreateDTO $receivedDTO): bool
    {
        $isCarEqual = $createdDTO->title === $receivedDTO->title &&
            $createdDTO->description === $receivedDTO->description &&
            $createdDTO->price === $receivedDTO->price &&
            $createdDTO->photoUrl === $receivedDTO->photoUrl &&
            $createdDTO->contacts === $receivedDTO->contacts;

        $isOptionsEqual = false;
        if ($createdDTO->option === null && $receivedDTO->option === null) {
            $isOptionsEqual = true;
        } elseif ($this->carOptionDTOsIsEqual($createdDTO->option, $receivedDTO->option)) {
            $isOptionsEqual = true;
        }

        return $isCarEqual && $isOptionsEqual;
    }

    private function carOptionDTOsIsEqual(CarOptionDTO $createdDTO, CarOptionDTO $receivedDTO): bool
    {
        if (
            $createdDTO->brand === $receivedDTO->brand &&
            $createdDTO->model === $receivedDTO->model &&
            $createdDTO->year === $receivedDTO->year &&
            $createdDTO->body === $receivedDTO->body &&
            $createdDTO->mileage === $receivedDTO->mileage
        ) {
            return true;
        }

        return false;
    }
}
