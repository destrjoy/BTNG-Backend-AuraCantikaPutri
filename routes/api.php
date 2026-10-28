<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeralatanController;

Route::apiResource('peralatan', PeralatanController::class);
