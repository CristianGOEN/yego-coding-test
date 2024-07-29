<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yego\Booking\Rides\Domain\RideRepository;
use Yego\Booking\Rides\Infrastructure\EloquentRideRepository;
use Yego\Booking\Vehicles\Domain\VehicleRepository;
use Yego\Booking\Vehicles\Infrastructure\EloquentVehicleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            VehicleRepository::class,
            EloquentVehicleRepository::class
        );

        $this->app->bind(
            RideRepository::class,
            EloquentRideRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
