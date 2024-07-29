<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Domain;

use Yego\Shared\Domain\ValueObject\UuidValueObject;

final class RideId extends UuidValueObject
{
    public function __construct()
    {
        parent::__construct(RideId::random()->value());
    }
}
