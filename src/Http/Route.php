<?php

namespace TestTask\Http;
use TestTask\View\View;
use TestTask\Http\Request;
use TestTask\Http\Response;


class Route
{
    protected static array $routes = [];


    public function __construct(public Request $request, public Response $response)
    {
    }

    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    }

    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();

        $action = self::$routes[$method][$path] ?? false;

        if (!array_key_exists($path, self::$routes[$method])) {
            //view('404');
            $this->response->setStatusCode(404);
            View::makeError('404');
        }



        // if(!$action)
        // {
        // return;
        // }


        if (is_callable($action)) {
            call_user_func_array($action, []);
        }

        if (is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }
    }
}
