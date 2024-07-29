<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Domain;

use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Shared\Domain\Vehicles\VehicleId;

interface RideRepository
{
    public function save(Ride $ride): void;
}
