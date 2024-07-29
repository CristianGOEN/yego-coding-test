<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use DateTime;
use Yego\Shared\Domain\Utils;
use Yego\Shared\Domain\Vehicles\VehicleId;

final class Vehicle
{
    public function __construct(
        private VehicleId $id,
        private VehicleName $name,
        private VehicleCoordinates $coordinates,
        private VehicleBattery $battery,
        private VehicleType $type,
        private ?DateTime $createdOn,
        private ?DateTime $updatedOn
    )
    {
        if (!$createdOn) {
            $this->createdOn = Utils::formatDate(new DateTime('now'));
        }

        if (!$updatedOn) {
            $this->updatedOn = Utils::formatDate(new DateTime('now'));
        }
    }

    public static function create(
        VehicleId $id,
        VehicleName $name,
        VehicleCoordinates $coordinates,
        VehicleBattery $battery,
        VehicleType $type,
        ?DateTime $createdOn,
        ?DateTime $updatedOn
    ): self
    {
        return new self($id, $name, $coordinates, $battery, $type, $createdOn, $updatedOn);
    }

    public function id(): VehicleId
    {
        return $this->id;
    }

    public function name(): VehicleName
    {
        return $this->name;
    }

    public function coordinates(): VehicleCoordinates
    {
        return $this->coordinates;
    }

    public function battery(): VehicleBattery
    {
        return $this->battery;
    }

    public function type(): VehicleType
    {
        return $this->type;
    }

    public function createdOn(): DateTime
    {
        return $this->createdOn;
    }

    public function updatedOn(): DateTime
    {
        return $this->updatedOn;
    }

    public function update(
        VehicleName $name,
        VehicleCoordinates $coordinates,
        VehicleBattery $battery,
        VehicleType $type
    ): void
    {
        $this->name = $name;
        $this->coordinates = $coordinates;
        $this->battery = $battery;
        $this->type = $type;
        $this->updatedOn = Utils::formatDate(new DateTime('now'));
    }
}
