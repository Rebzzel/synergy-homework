<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$controllers = [
    App\Http\Controllers\AppController::class,
    App\Http\Controllers\UploadController::class,
    App\Http\Controllers\AuthController::class,
    App\Http\Controllers\CabinetController::class,
];

foreach ($controllers as $controller) {
    $controller::register();
}

if (config('app.debug')) {
    App\Http\Controllers\DebugController::register();
}