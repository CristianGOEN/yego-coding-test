<?php

declare(strict_types=1);

namespace Yego\Booking\Shared\Application\Create;

final class CreateVehicleRequest
{
    public function __construct(
        private string $id,
        private string $name,
        private float $latitude,
        private float $longitude,
        private int $battery,
        private int $type
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function battery(): int
    {
        return $this->battery;
    }

    public function type(): int
    {
        return $this->type;
    }
}
