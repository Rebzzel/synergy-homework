<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public static $route = '/login';
    public static $name = 'login';
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get(Request $request)
    {
        return view('auth.login');  
    }

    public function post(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required',
            'remember_me' => 'boolean',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return $this->response([ __('auth.failed') ], 400);
        }

        return $this->response();
    }
}