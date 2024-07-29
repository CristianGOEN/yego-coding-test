<?php

declare(strict_types=1);

namespace Yego\Booking\Rides\Infrastructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class EloquentRideModel extends Model
{
    use HasFactory;

    protected $table = 'rides';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'vehicleId'
    ];
}
