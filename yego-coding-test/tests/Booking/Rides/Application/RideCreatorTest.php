<?php

declare(strict_types=1);

namespace Tests\Booking\Rides\Application;

use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Tests\TestCase;
use Yego\Booking\Rides\Application\Create\RideCreator;
use Yego\Booking\Rides\Domain\RideRepository;
use Yego\Booking\Shared\Application\Create\CreateVehicleRequest;
use Yego\Booking\Vehicles\Application\Create\VehicleCreator;
use Yego\Booking\Vehicles\Application\Find\VehicleFinder;
use Yego\Booking\Vehicles\Application\Update\VehicleUpdater;
use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleBattery;
use Yego\Booking\Vehicles\Domain\VehicleCoordinates;
use Yego\Booking\Vehicles\Domain\VehicleName;
use Yego\Booking\Vehicles\Domain\VehicleRepository;
use Yego\Booking\Vehicles\Domain\VehicleType;
use Yego\Shared\Domain\Vehicles\VehicleId;

class RideCreatorTest extends TestCase
{
    private RideCreator $creator;
    private VehicleFinder $vehicleFinder;
    private VehicleCreator $vehicleCreator;
    private VehicleUpdater $vehicleUpdater;
    private VehicleRepository $vehicleRepository;
    private RideRepository $rideRepository;

    #[Test]
    public function ensureRideIsStored(): void
    {
        $createVehicleRequest = new CreateVehicleRequest(
            '456',
            'JohnDoe',
            41.406192,
            2.135312,
            10,
            0
        );

        $vehicleFromCache = Vehicle::create(
            new VehicleId('456'),
            new VehicleName('JohnDoe'),
            new VehicleCoordinates(41.391077, 2.163365),
            new VehicleBattery(80),
            new VehicleType(0)
        );

        $this->vehicleFinder->method('__invoke')->willReturn($vehicleFromCache);
        $this->vehicleCreator->expects(self::never())->method('__invoke');
        $this->vehicleUpdater->expects(self::once())->method('__invoke');
        $this->rideRepository->expects(self::once())->method('save');

        $this->creator->__invoke($createVehicleRequest);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->vehicleFinder = $this->createMock(VehicleFinder::class);
        $this->vehicleCreator = $this->createMock(VehicleCreator::class);
        $this->vehicleUpdater = $this->createMock(VehicleUpdater::class);
        $this->vehicleRepository =  $this->createMock(VehicleRepository::class);
        $this->rideRepository =  $this->createMock(RideRepository::class);

        $this->creator = new RideCreator(
            $this->vehicleRepository,
            $this->rideRepository,
        );

        $reflection = new ReflectionClass($this->creator);

        $propertyFinder = $reflection->getProperty('vehicleFinder');
        $propertyFinder->setAccessible(true);
        $propertyFinder->setValue($this->creator, $this->vehicleFinder);

        $propertyCreator = $reflection->getProperty('vehicleCreator');
        $propertyCreator->setAccessible(true);
        $propertyCreator->setValue($this->creator, $this->vehicleCreator);

        $propertyUpdater = $reflection->getProperty('vehicleUpdater');
        $propertyUpdater->setAccessible(true);
        $propertyUpdater->setValue($this->creator, $this->vehicleUpdater);
    }
}
