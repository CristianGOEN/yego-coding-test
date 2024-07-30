<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Infrastructure;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Yego\Booking\Rides\Domain\Ride;
use Yego\Booking\Rides\Domain\RideRepository;

final class EloquentRideRepository implements RideRepository
{
    public function save(Ride $ride): void
    {
        $model = new EloquentRideModel();

        $model->id = $ride->id()->value();
        $model->vehicle_id = $ride->vehicleId()->value();
        $model->date = $ride->date();

        $model->save();
    }

    public function getRidesByDate(string $date): array
    {
        try {
            $startDate = Carbon::parse($date)->startOfDay();
            $endDate = Carbon::parse($date)->endOfDay();

            return DB::table('rides')
                ->select(DB::raw('strftime("%H", date) as time'), DB::raw('COUNT(*) as number_of_rides'))
                ->whereBetween('date', [$startDate, $endDate])
                ->groupBy(DB::raw('strftime("%H", date)'))
                ->orderBy(DB::raw('strftime("%H", date)'))
                ->get()
                ->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }

    public function getAllRides(): array
    {
        try {
            return DB::table('rides')
                ->select(DB::raw('strftime("%Y-%m-%d", date) as time, count(*) as number_of_rides'))
                ->groupBy(DB::raw('strftime("%Y-%m-%d", date)'))
                ->orderBy(DB::raw('strftime("%Y-%m-%d", date)'))
                ->get()
                ->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }
}
