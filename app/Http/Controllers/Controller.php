<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use TypeError;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    public static $route;

    /**
     * @var string
     */
    public static $name;

    public static function register() 
    {
        if (!isset(static::$route)) {
            throw new Exception('Nothing to register. Enter `$route` or implement self `register` method.');
        }

        if (gettype(static::$route) != 'string') {
            throw new TypeError();
        }

        $methods = [ 'get', 'post', 'any' ];

        foreach ($methods as $method) {
            if (!method_exists(static::class, $method)) {
                continue;
            }

            $route = Route::{$method}(static::$route, [ static::class, $method ]);
            if (isset(static::$name)) {
                $route->name(static::$name);
            }
        }
    }

    /**
     * @param null|string|array $data
     * @return \Illuminate\Http\Response
     */
    public function response($data = null, $status = 200)
    {
        $data = [
            'status' => $status,
            'response' => $data ?? __('http.'.$status),
        ];

        $response = response($data, $status);

        if (!request()->ajax() && request()->hasPreviousSession()) {  
            return redirect(url()->previous())->withErrors(
                !$response->isSuccessful() ? $data['response'] : []);
        }

        return $response;
    }
}
