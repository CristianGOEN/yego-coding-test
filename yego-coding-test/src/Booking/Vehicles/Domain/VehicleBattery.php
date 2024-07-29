<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Domain;

use Yego\Shared\Domain\ValueObject\IntValueObject;

final class VehicleBattery extends IntValueObject
{
    private const int MAX_BATTERY_VALUE = 100;
    private const int MIN_BATTERY_VALUE = 0;

    public function __construct(int $value)
    {
        parent::__construct($value);

        $this->ensureBatteryIsInRange();
    }

    public function ensureBatteryIsInRange(): void
    {
        if ($this->value < self::MIN_BATTERY_VALUE || $this->value > self::MAX_BATTERY_VALUE) {
            throw new VehicleBatteryIsInvalid();
        }
    }

    public function hasDecreased(VehicleBattery $battery): bool
    {
        return $battery->value() < $this->value();
    }
}
