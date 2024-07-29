<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Infrastructure;

use Illuminate\Support\Facades\Cache;
use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleRepository;
use Yego\Shared\Domain\Vehicles\VehicleId;

final class CacheVehicleRepository implements VehicleRepository
{
    public function save(Vehicle $vehicle): void
    {
        Cache::put($vehicle->id()->value(), $vehicle->toArray());
    }

    public function search(VehicleId $id): ?Vehicle
    {
        $request = Cache::get((string)$id);
        if (!$request) {
            return null;
        }

        return Vehicle::createFromArray($request);
    }

    public function update(Vehicle $vehicle): void
    {
        Cache::put($vehicle->id()->value(), $vehicle->toArray());
    }
}
