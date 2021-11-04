<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public static $route = '/personal';
    public static $name = 'personal';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request)
    {
        return view('cabinet.index', [
            'category' => 'personal', 
            'user' => $request->user()
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'snils_id' => 'min:11|unique:users'
        ]);

        $user = $request->user();
        $data = $request->except([ '_token' ]);

        $user->editIf($data, function ($key, $value, $new) {
            return $value == null;
        });

        if ($user->isDirty()) {
            $user->save();
        }

        return $this->response();
    }
}
