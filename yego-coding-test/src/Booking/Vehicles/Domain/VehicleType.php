<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use Yego\Shared\Domain\ValueObject\IntValueObject;

final class VehicleType extends IntValueObject
{
    private const int SCOOTER_TYPE = 0;
    private const array VALID_TYPES = [
        self::SCOOTER_TYPE
    ];

    public function __construct(int $value)
    {
        parent::__construct($value);

        $this->ensureIsAValidType();
    }

    public function ensureIsAValidType(): void
    {
        if (!in_array($this->value,self::VALID_TYPES)) {
            throw new VehicleTypeIsInvalid();
        }
    }
}
