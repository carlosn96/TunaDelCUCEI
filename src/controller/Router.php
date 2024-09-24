<?php

namespace controller;

class Router {

    private static $routes = [];

    public static function register(array $routes) {
        foreach ($routes as $route) {
            self::$routes[] = $route;
        }
    }

    public static function resolve($method, $path) {
        foreach (self::$routes as $route) {
            // Crear un patrón dinámico para la ruta
            $routePattern = preg_replace('/\{[^\}]+\}/', '([a-zA-Z0-9_\-]+)', $route['route']);

            // Comprobar si el método y la ruta coinciden
            if ($route['method'] === $method && preg_match("#^$routePattern$#", $path, $matches)) {
                // Eliminar la coincidencia completa del array
                array_shift($matches);

                // Verificar si el callback es para getById y si el valor es numérico
                if ($route['callback'] === [static::class, 'getById']) {
                    $param = $matches[0] ?? null;

                    // Si no es numérico, redirigir a getByValue
                    if ($param === null || !is_numeric($param)) {
                        return call_user_func([static::class, 'getByValue'], $param);
                    }
                }

                // Ejecutar el callback con los parámetros correspondientes
                return call_user_func_array($route['callback'], $matches);
            }
        }

        // Enviar respuesta 404 si no se encuentra la ruta
        http_response_code(404);
        echo json_encode(['message' => 'Recurso no encontrado']);
    }
}
