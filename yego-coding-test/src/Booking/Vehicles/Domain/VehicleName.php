<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use Yego\Shared\Domain\ValueObject\StringValueObject;

final class VehicleName extends StringValueObject
{
    private const int MAX_LENGTH = 255;
    public function __construct(?string $value)
    {
        parent::__construct($value);

        $this->ensureLengthIsInferiorThan(self::MAX_LENGTH);
    }
}
