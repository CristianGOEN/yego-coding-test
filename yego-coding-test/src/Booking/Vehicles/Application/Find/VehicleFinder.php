<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Application\Find;

use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleRepository;
use Yego\Shared\Domain\Vehicles\VehicleId;

final class VehicleFinder
{
    public function __construct(private VehicleRepository $repository)
    {
    }

    public function __invoke(VehicleId $id): ?Vehicle
    {
        return $this->repository->search($id);
    }
}
