<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public static $route = '/account';
    public static $name = 'account';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request)
    {
        return view('cabinet.index', [
            'category' => 'account', 
            'user' => $request->user()
        ]);
    }

    public function post(Request $request)
    {
        $user = $request->user();
        $data = $request->except([ '_token' ]);

        $user->edit($data);

        if ($user->isDirty()) {
            $user->save();
        }

        return $this->response();
    }
}
