<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\ValueObject;

use Yego\Shared\Domain\Exception\CoordinatesAreInvalid;

abstract class CoordinatesValueObject
{
    private const float LATITUDE_MIN = -90.0;
    private const float LATITUDE_MAX = 90.0;
    private const float LONGITUDE_MIN = -180.0;
    private const float LONGITUDE_MAX = 180.0;

    private const float MOVE_LENGTH = 60.0;
    private const float EARTH_RADIUS = 6371000;

    public function __construct(protected float $latitude, protected float $longitude)
    {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->latitude < self::LATITUDE_MIN || $this->latitude > self::LATITUDE_MAX) {
            throw new CoordinatesAreInvalid();
        }

        if ($this->longitude < self::LONGITUDE_MIN || $this->longitude > self::LONGITUDE_MAX) {
            throw new CoordinatesAreInvalid();
        }
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    private function latitudeRadiant(): float
    {
        return deg2rad($this->latitude);
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    private function longitudeRadiant(): float
    {
        return deg2rad($this->longitude);
    }

    public function equals(CoordinatesValueObject $coordinates): bool
    {
        return $coordinates->latitude === $this->latitude
            && $coordinates->longitude === $this->longitude;
    }

    public function hasMoved(CoordinatesValueObject $coordinatesTo): bool
    {
        $deltaLat = $coordinatesTo->latitudeRadiant() - $this->latitudeRadiant();
        $deltaLon = $coordinatesTo->longitudeRadiant() - $this->longitudeRadiant();

        $a = sin($deltaLat / 2) ** 2 +
            cos($this->latitudeRadiant()) * cos($coordinatesTo->latitudeRadiant()) * sin($deltaLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return self::EARTH_RADIUS * $c > self::MOVE_LENGTH;
    }
}
