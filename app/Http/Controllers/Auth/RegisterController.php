<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public static $route = '/register';
    public static $name = 'register';
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get(Request $request)
    {
        return view('auth.register');  
    }

    public function post(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'middle_name'   => 'required|string',
            'birthday_at'   => 'required|date_format:Y-m-d',
            'passport_id'   => 'required|string|unique:users',
        ]);

        $data = $request->all();
        $user = User::create($data);
        Auth::login($user);
        return $this->response();
    }
}