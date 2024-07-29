<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use RuntimeException;
use Yego\Shared\Domain\DomainError;

final class VehicleTypeIsInvalid extends DomainError
{
    public function errorCode(): string
    {
        return 'battery_is_invalid';
    }

    protected function errorMessage(): string
    {
        return 'Battery is out of the range';
    }
}
