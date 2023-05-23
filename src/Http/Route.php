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
        $route = preg_replace('/\{(\w+)\}/', '(?P<$1>\w+)', $route);
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

    $action = null;
    $params = [];

    foreach (self::$routes[$method] as $route => $routeAction) {
        // Check if the route matches the requested path
        if (preg_match('#^' . $route . '$#', $path, $matches)) {
            $action = $routeAction;

            // Extract parameter values from the matched route
            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $params[$key] = $value;
                }
            }

            break;
        }
    }

    if ($action === null) {
        View::makeError('404');
    }

    if (is_callable($action)) {
        call_user_func_array($action, [$params]);
    }

    if (is_array($action)) {
        call_user_func_array([new $action[0], $action[1]], [$params]);
    }
}
}
