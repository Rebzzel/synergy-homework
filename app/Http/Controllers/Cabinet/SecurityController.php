<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SecurityController extends Controller
{
    public static $route = '/security';
    public static $name = 'security';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request)
    {
        return view('cabinet.index', [
            'category' => 'security', 
            'user' => $request->user()
        ]);
    }

    public function post(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        if (array_key_exists('email', $data)) {
            $request->validate([
                'email' => 'email|unique:users'
            ]);

            $user->email = $data['email'];
        }

        if (array_key_exists('new_password', $data)) {
            $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:6|confirmed'
            ]);

            if (Hash::check($data['old_password'], $user->password)) {
                return $this->response(__('validation.current_password'), 400);
            }

            $user->password = $data['new_password'];
        }

        if ($user->isDirty()) {
            $user->save();
        }

        return $this->response();
    }
}
