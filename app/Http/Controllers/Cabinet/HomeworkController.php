<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public static $route = '/homework/{id?}';
    public static $name = 'homework';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Request $request, $id = null)
    {
        return view('cabinet.index', [
            'category' => 'homework', 
            'user' => $request->user(),
            'homework' => isset($id) ? Homework::find($id) : null,
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        $user = $request->user();
        $data = $request->except([ '_token' ]);
        $homework = Homework::find($data['id']);

        if (!isset($homework)) {
            return $this->response(null, 404);
        }

        if (!$homework->hasAccess($user)) {
            return $this->response(null, 403);
        }

        $homework->edit($data);
        
        if ($homework->isDirty()) {
            $homework->save();
            return $this->response();
        }
        
        return $this->response(null, 208);
    }
}
