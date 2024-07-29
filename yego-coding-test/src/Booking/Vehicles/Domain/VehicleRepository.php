<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use Yego\Shared\Domain\Vehicles\VehicleId;

interface VehicleRepository
{
    public function save(Vehicle $vehicle): void;

    public function search(VehicleId $id): ?Vehicle;

    public function update(Vehicle $vehicle): void;
}
