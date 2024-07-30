<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Domain;

interface RideRepository
{
    public function save(Ride $ride): void;
    public function getRidesByDate(string $date): array;
    public function getAllRides(): array;
}
