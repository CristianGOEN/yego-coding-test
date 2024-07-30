<?php

declare(strict_types=1);

namespace Tests\Booking\Vehicles\Domain;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Yego\Booking\Shared\Application\Create\CreateVehicleRequest;
use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleBattery;
use Yego\Booking\Vehicles\Domain\VehicleBatteryIsInvalid;
use Yego\Booking\Vehicles\Domain\VehicleCoordinates;
use Yego\Booking\Vehicles\Domain\VehicleName;
use Yego\Booking\Vehicles\Domain\VehicleType;
use Yego\Booking\Vehicles\Domain\VehicleTypeIsInvalid;
use Yego\Shared\Domain\Exception\CoordinatesAreInvalid;
use Yego\Shared\Domain\Exception\LengthIsInvalid;
use Yego\Shared\Domain\Vehicles\VehicleId;

class VehicleTest extends TestCase
{
    #[Test]
    public function ensureVehicleCanBeCreated(): void
    {
        $vehicle = Vehicle::create(
            new VehicleId('456'),
            new VehicleName('JohnDoe'),
            new VehicleCoordinates(41.391077, 2.163365),
            new VehicleBattery(10),
            new VehicleType(0)
        );

        $this->assertInstanceOf(Vehicle::class, $vehicle);
    }

    #[Test]
    public function ensureVehicleCanBeCreatedFromRequest(): void
    {
        $createVehicleRequest = new CreateVehicleRequest(
            '456',
            'JohnDoe',
            41.406192,
            2.135312,
            80,
            0
        );

        $vehicle = Vehicle::createFromRequest($createVehicleRequest);

        $this->assertInstanceOf(Vehicle::class, $vehicle);
    }

    #[Test]
    public function ensureVehicleCanBeCreatedFromArray(): void
    {
        $vehicleArray = [
            'id' => '465',
            'name' => 'JohnDoe',
            'latitude' => 41.406192,
            'longitude' => 2.135312,
            'battery' => 80,
            'type' => 0
        ];

        $vehicle = Vehicle::createFromArray($vehicleArray);

        $this->assertInstanceOf(Vehicle::class, $vehicle);
    }

    #[Test]
    public function ensureVehicleNameIsInferiorThan255characters(): void
    {
        $this->expectException(LengthIsInvalid::class);

        new VehicleName('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris rhoncus erat a metus rhoncus congue. Quisque lobortis diam urna, ut consectetur leo mattis non. Vivamus placerat tortor eu scelerisque vehicula. Curabitur varius, enim eu commodo placerat, mi nulla hendrerit lacus, quis efficitur turpis massa maximus eros. Duis mauris enim, faucibus at maximus eget, vestibulum ac dui');
    }

    public static function vehicleCoordinateProvider(): array
    {
        return [
            [-90.391077, 2.163365],
            [90.391077, 2.163365],
            [41.391077, -180.163365],
            [41.391077, 180.163365],
        ];
    }

    #[Test]
    #[DataProvider('vehicleCoordinateProvider')]
    public function ensureVehicleCoordinatesAreInsideAValidRange(float $lat, float $lng): void
    {
        $this->expectException(CoordinatesAreInvalid::class);

        new VehicleCoordinates($lat, $lng);
    }

    public static function vehicleCoordinateMovingProvider(): array
    {
        return [
            [
                new VehicleCoordinates(41.391077, 2.163365),
                new VehicleCoordinates(41.402252, 2.206082),
                true
            ],
            [
                new VehicleCoordinates(41.390015, 2.200438),
                new VehicleCoordinates(41.39005, 2.200432),
                false
            ],
        ];
    }

    #[Test]
    #[DataProvider('vehicleCoordinateMovingProvider')]
    public function ensureVehicleHasMovedAtLeast60Meters(
        VehicleCoordinates $vehicleCoordinates1,
        VehicleCoordinates $vehicleCoordinates2,
        bool $expected
    ): void
    {
        $hasMoved = $vehicleCoordinates1->hasMoved($vehicleCoordinates2);

        $this->assertEquals($expected, $hasMoved);
    }

    public static function vehicleBatteryInRangeProvider(): array
    {
        return [
            [-1, true],
            [101, true],
            [10, false],
        ];
    }

    #[Test]
    #[DataProvider('vehicleBatteryInRangeProvider')]
    public function ensureBatteryIsInRange(int $battery, bool $shouldThrowException): void
    {
        if ($shouldThrowException) {
            $this->expectException(VehicleBatteryIsInvalid::class);

            new VehicleBattery($battery);
        } else {
            $this->expectNotToPerformAssertions();

            new VehicleBattery($battery);
        }
    }

    public static function vehicleBatteryProvider(): array
    {
        return [
            [10, 5, true],
            [10, 100, false],
        ];
    }

    #[Test]
    #[DataProvider('vehicleBatteryProvider')]
    public function ensureBatteryHasDecreased(int $battery1, int $battery2, bool $expected): void
    {
        $vehicleBattery1 = new VehicleBattery($battery1);
        $vehicleBattery2 = new VehicleBattery($battery2);

        $hasDecreased = $vehicleBattery1->hasDecreased($vehicleBattery2);

        $this->assertEquals($expected, $hasDecreased);
    }

    public static function vehicleTypeProvider(): array
    {
        return [
            [0, false],
            [1, true],
            [2, true],
        ];
    }

    #[Test]
    #[DataProvider('vehicleTypeProvider')]
    public function ensureTypeIsValid(int $type, bool $shouldThrowException): void
    {
        if ($shouldThrowException) {
            $this->expectException(VehicleTypeIsInvalid::class);

            new VehicleType($type);
        } else {
            $this->expectNotToPerformAssertions();

            new VehicleType($type);
        }
    }
}
