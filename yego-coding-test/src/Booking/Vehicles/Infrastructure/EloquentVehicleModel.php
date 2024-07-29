<?php

declare(strict_types=1);

namespace Yego\Booking\Vehicles\Infrastructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class EloquentVehicleModel extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude',
        'battery',
        'type',
        'createdOn',
        'updatedOn'
    ];
}
