<?php

use App\Http\Controllers\Replaceables\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::resource('/employee', EmployeeController::class)->only([
    'index',
    'update',
    'destroy',
    'store',
]);