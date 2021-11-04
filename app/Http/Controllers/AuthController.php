<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public static function register()
    {
        Auth\LoginController::register();
        Auth\LogoutController::register();
        Auth\RegisterController::register();
    }
}
