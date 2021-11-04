<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public static $route = '/debug/{action}';
    public static $name = 'debug';

    public function post(Request $request, $action)
    {
        $data = $request->all();

        switch ($action) {
            case 'add.lesson':
                $request->validate([
                    'name' => 'required|string'
                ]);

                Lesson::create($data);
                break;
            case 'add.homework':
                $request->validate([
                    'user_id'    => 'required|numeric',
                    'lesson_id'  => 'required|numeric',
                    'expire_at'  => 'required|date',
                    'description'=> 'required|string',
                ]);

                Homework::create($data);
                break;
            case 'delete.homework':
                $request->validate([
                    'id' => 'required|numeric'
                ]);

                $home = Homework::find($data['id']);
                if (isset($home)) {
                    $home->delete();
                }
                break;
        }

        return $this->response();
    }
}
