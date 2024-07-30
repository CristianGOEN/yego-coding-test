<?php

declare(strict_types=1);

namespace Tests\Booking\Rides\Domain;

use DateTime;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Yego\Booking\Rides\Domain\Ride;
use Yego\Booking\Rides\Domain\RideId;
use Yego\Shared\Domain\Vehicles\VehicleId;

class RideTest extends TestCase
{
    #[Test]
    public function ensureRideCanBeCreated(): void
    {
        $ride = Ride::create(
            new VehicleId('456'),
        );

        $this->assertInstanceOf(Ride::class, $ride);
        $this->assertIsString($ride->id()->value());
        RideId::ensureIsValidUuid($ride->id()->value());
        $this->assertInstanceOf(DateTime::class, $ride->date());
    }
}
