<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Application\Create;

use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleRepository;

final class VehicleCreator
{
    public function __construct(private VehicleRepository $repository)
    {
    }

    public function __invoke(Vehicle $vehicle): void
    {
        $this->repository->save($vehicle);
    }
}
