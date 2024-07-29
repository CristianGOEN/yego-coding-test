<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Domain;

use DateTime;
use Yego\Shared\Domain\Utils;
use Yego\Shared\Domain\Vehicles\VehicleId;

final class Ride
{
    private DateTime $rideDate;
    private RideId $id;

    public function __construct(private VehicleId $vehicleId)
    {
        $this->id = new RideId();
        $this->rideDate = Utils::formatDate(new DateTime('now'));
    }

    public static function create(VehicleId $id): self
    {
        return new self($id);
    }

    public function id(): RideId
    {
        return $this->id;
    }

    public function vehicleId(): VehicleId
    {
        return $this->vehicleId;
    }

    public function rideDate(): DateTime
    {
        return $this->rideDate;
    }
}
