<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeralatanController;

Route::get('peralatan/statistik', [PeralatanController::class, 'statistik']);

Route::apiResource('peralatan', PeralatanController::class);
