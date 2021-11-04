<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public static $route = '/';
    public static $name = 'cabinet';

    protected static function getRedirectTo()
    {
        return HomeworkController::$name;
    }

    public function any(Request $request)
    {
        return redirect()->route(static::getRedirectTo());
    }
}
