<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public static $route = '/cabinet';

    private static $classes = [
        Cabinet\IndexController::class,
        Cabinet\HomeworkController::class,
        Cabinet\AccountController::class,
        Cabinet\PersonalController::class,
        Cabinet\ScheduleController::class,
        Cabinet\SecurityController::class,
    ];

    public static function register()
    {
        foreach (static::$classes as $class) {
            $class::$route = static::$route.$class::$route;
            $class::register();
        }
    }
}
