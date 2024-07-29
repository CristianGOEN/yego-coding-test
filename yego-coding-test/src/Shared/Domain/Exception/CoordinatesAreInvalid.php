<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\Exception;

use Yego\Shared\Domain\DomainError;

final class CoordinatesAreInvalid extends DomainError
{
    public function errorCode(): string
    {
        return 'coordinates_are_invalid';
    }

    protected function errorMessage(): string
    {
        return 'Latitude or longitude are out of the range';
    }
}
