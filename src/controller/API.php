<?php

namespace controller;

abstract class API {

    protected const GET = "GET";
    protected const POST = "POST";
    protected const PUT = "PUT";
    protected const DELETE = "DELETE";

    protected function getData(): array {
        return json_decode(file_get_contents("php://input"), true) ?? [];
    }

    protected abstract function getControllerName();

    public function get($value) {
        if (is_numeric($value)) {
            $this->getById((int) $value);
        } else {
            $this->getByValue($value);
        }
    }

    public abstract function getById(int $id);

    public abstract function getByValue(string $value);

    public abstract function getAll();

    public abstract function create();

    public abstract function update($id);

    public abstract function delete(int $id);

    protected function sendResponse(array $respuesta) {
        echo json_encode($respuesta);
    }

    protected function sendOperationResult(bool $isResultCorrect) {
        $this->sendResponse(["msg" => $isResultCorrect ? "Operation Complete" : "An error has occurred"]);
    }

    protected function sendMessage(string $respuesta) {
        $this->sendResponse(["message" => $respuesta]);
    }

    public static function register() {
        $instance = new static();
        $controllerName = $instance->getControllerName();
        $routes = [
            ['method' => self::GET, 'route' => $controllerName, 'callback' => [$instance, 'getAll']],
            ['method' => self::GET, 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'get']],
            ['method' => self::POST, 'route' => $controllerName, 'callback' => [$instance, 'create']],
            ['method' => self::PUT, 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'update']],
            ['method' => self::DELETE, 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'delete']]
        ];
        Router::register($routes);
    }

    protected static function addRoute(string $method, string $route, string $callback) {
        $instance = new static();
        Router::register([
            [
                'method' => $method,
                'route' => $instance->getControllerName() . $route,
                'callback' => [$instance, $callback]
            ]
        ]);
    }
}
