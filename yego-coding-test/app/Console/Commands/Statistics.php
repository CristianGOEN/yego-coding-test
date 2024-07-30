<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Yego\Booking\Rides\Domain\RideRepository;

class Statistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:stats {date? : The date in Y-m-d format}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays the number of rides done each day. If no date is specified, display the number of rides done each day from the first known date. If the option ‘Y-m-d’ is given, displays the number of rides done each hour of the day specified.';

    /**
     * Execute the console command.
     */
    public function handle(RideRepository $rideRepository)
    {
        $date = $this->argument('date');
        if ($date) {
            $this->table(['Hour', 'Number of Rides'], $this->formatTableResults($rideRepository->getRidesByDate($date)));

            return 0;
        }

        $this->table(['Date', 'Number of rides'], $this->formatTableResults($rideRepository->getAllRides()));

        return 0;
    }

    private function formatTableResults(array $results): array
    {
        return array_map(function ($ride) {
            return [
                $ride->time, $ride->number_of_rides,
            ];
        }, $results);
    }
}
