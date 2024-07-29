<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RidePostController;

Route::post('/ride', RidePostController::class);
