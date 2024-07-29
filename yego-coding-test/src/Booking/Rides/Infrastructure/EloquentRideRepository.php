<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Infrastructure;

use Yego\Booking\Rides\Domain\Ride;
use Yego\Booking\Rides\Domain\RideRepository;

final class EloquentRideRepository implements RideRepository
{
    public function save(Ride $ride): void
    {
        $model = new EloquentRideModel();

        $model->id = $ride->id()->value();
        $model->vehicle_id = $ride->vehicleId()->value();
        $model->date = $ride->date();

        $model->save();
    }
}
