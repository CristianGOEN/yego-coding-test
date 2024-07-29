<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Infrastructure;

use Yego\Booking\Vehicles\Domain\Vehicle;
use Yego\Booking\Vehicles\Domain\VehicleBattery;
use Yego\Booking\Vehicles\Domain\VehicleCoordinates;
use Yego\Booking\Vehicles\Domain\VehicleName;
use Yego\Booking\Vehicles\Domain\VehicleRepository;
use Yego\Booking\Vehicles\Domain\VehicleType;
use Yego\Shared\Domain\Vehicles\VehicleId;

final class EloquentVehicleRepository implements VehicleRepository
{
    public function save(Vehicle $vehicle): void
    {
        $model = new EloquentVehicleModel();

        $model->id = $vehicle->id()->value();
        $model->name = $vehicle->name()->value();
        $model->latitude = $vehicle->coordinates()->latitude();
        $model->longitude = $vehicle->coordinates()->longitude();
        $model->battery = $vehicle->battery()->value();
        $model->type = $vehicle->type()->value();

        $model->save();
    }

    public function search(VehicleId $id): ?Vehicle
    {
        $model = EloquentVehicleModel::find($id->value());

        if (null === $model) {
            return null;
        }

        return Vehicle::create(
            new VehicleId($model->id),
            new VehicleName($model->name),
            new VehicleCoordinates($model->latitude, $model->longitude),
            new VehicleBattery($model->battery),
            new VehicleType($model->type),
            $model->createdOn,
            $model->updatedOn
        );
    }

    public function update(Vehicle $vehicle): void
    {
        $model = EloquentVehicleModel::find($vehicle->id()->value());

        $model->name = $vehicle->name()->value();
        $model->latitude = $vehicle->coordinates()->latitude();
        $model->longitude = $vehicle->coordinates()->longitude();
        $model->battery = $vehicle->battery()->value();
        $model->type = $vehicle->type()->value();
        $model->updatedOn = $vehicle->updatedOn();

        $model->update();
    }
}
