<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Infrastructure;

use Yego\Booking\Rides\Domain\Ride;
use Yego\Booking\Rides\Domain\RideRepository;
use Yego\Booking\Vehicles\Infrastructure\EloquentVehicleModel;

final class EloquentRideRepository implements RideRepository
{
    public function save(Ride $ride): void
    {
        $model = new EloquentVehicleModel();

        $model->id = $ride->id()->value();
        $model->vehicleId = $ride->vehicleId()->value();
        $model->date = $ride->rideDate();

        $model->save();
    }
}
