<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public static $route = '/upload';
    public static $name = 'uploader';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function post(Request $request)
    {
        $user = $request->user();
        $paths = [];

        foreach ($request->allFiles() as $file) {
            $paths[] = $file->store('public/usr/'.$user->id);
        }

        return $this->response($paths);
    }
}
