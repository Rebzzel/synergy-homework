<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public static $route = '/logout';
    public static $name = 'logout';

    public function any(Request $request)
    {
        Auth::logout();
        return redirect()->route(AppController::$name);
    }
}