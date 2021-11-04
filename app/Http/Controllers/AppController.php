<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public static $route = '/';
    public static $name = 'home';

    public function any(Request $request)
    {
        if (Auth::check()) {
            return redirect(CabinetController::$route);
        }

        return view('app.index');
    }
}
