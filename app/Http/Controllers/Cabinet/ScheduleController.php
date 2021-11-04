<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public static $route = '/schedule';
    public static $name = 'schedule';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request)
    {
        return view('cabinet.index', [
            'category' => 'schedule', 
            'user' => $request->user()
        ]);
    }
}
