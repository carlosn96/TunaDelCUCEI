<?php

namespace controller;

class Router {

    private static $routes = [];

    public static function registerStack(array $stack) {
        foreach($stack as $class) {
            $class::register();
        }
    }

    public static function register(array $routes) {
        foreach ($routes as $route) {
            self::$routes[] = $route;
        }
    }

    public static function resolve($method, $path) {
        foreach (self::$routes as $route) {
            $routePattern = preg_replace('/\{[^\}]+\}/', '([a-zA-Z0-9_\-]+)', $route['route']);
            if ($route['method'] === $method && preg_match("#^$routePattern$#", $path, $matches)) {
                array_shift($matches);
                if ($route['callback'] === [static::class, 'getById']) {
                    $param = $matches[0] ?? null;
                    if ($param === null || !is_numeric($param)) {
                        return call_user_func([static::class, 'getByValue'], $param);
                    }
                }
                return call_user_func_array($route['callback'], $matches);
            }
        }
        http_response_code(404);
        echo json_encode(['message' => 'Recurso no encontrado']);
    }
}
