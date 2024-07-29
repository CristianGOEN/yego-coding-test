<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Application\Create;

use Yego\Booking\Rides\Domain\Ride;
use Yego\Booking\Rides\Domain\RideRepository;
use Yego\Booking\Shared\Application\Create\CreateVehicleRequest;
use Yego\Booking\Vehicles\Application\Create\VehicleCreator;
use Yego\Booking\Vehicles\Application\Find\VehicleFinder;
use Yego\Booking\Vehicles\Application\Update\VehicleUpdater;
use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleRepository;

final class RideCreator
{
    private VehicleFinder $vehicleFinder;
    private VehicleCreator $vehicleCreator;
    private VehicleUpdater $vehicleUpdater;

    public function __construct(VehicleRepository $vehicleRepository, private RideRepository $rideRepository)
    {
        $this->vehicleFinder = new VehicleFinder($vehicleRepository);
        $this->vehicleCreator = new VehicleCreator($vehicleRepository);
        $this->vehicleUpdater = new VehicleUpdater($vehicleRepository);
    }

    public function __invoke(CreateVehicleRequest $request): void
    {
        $vehicleFromApi = Vehicle::createFromRequest($request);
        $vehicleFromCache = $this->vehicleFinder->__invoke($vehicleFromApi->id());
        if (!$vehicleFromCache) {
            $this->vehicleCreator->__invoke($vehicleFromApi);

            return;
        }

        $rideHaveBeenBooked = $this->ensureRideHaveBeenBooked($vehicleFromApi, $vehicleFromCache);
        if (!$rideHaveBeenBooked) {

            return;
        }

        $ride = Ride::create(
            $vehicleFromApi->id()
        );

        $this->vehicleUpdater->__invoke($vehicleFromApi);
        $this->rideRepository->save($ride);
    }

    private function ensureRideHaveBeenBooked(Vehicle $vehicleFromApi, Vehicle $vehicleFromCache): bool
    {
        if (!$vehicleFromCache->coordinates()->hasMoved($vehicleFromApi->coordinates())) {
            return false;
        }


        if (!$vehicleFromCache->battery()->hasDecreased($vehicleFromApi->battery())) {
            return false;
        }

        return true;
    }
}
