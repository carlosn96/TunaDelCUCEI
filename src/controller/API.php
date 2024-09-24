<?php

namespace controller;

abstract class API {

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

    public abstract function delete($id);

    private function codificarRespuesta($respuesta) {
        echo json_encode($respuesta);
    }

    protected function enviarRespuesta(array $respuesta) {
        $this->codificarRespuesta($respuesta);
    }

    protected function enviarResultadoOperacion(bool $esResultadoCorrecto) {
        $this->enviarRespuesta(["msg" => $esResultadoCorrecto ? "Operacion Completa" : "Ha ocurrido un error"]);
    }

    protected function enviarRespuestaStr(string $respuesta) {
        $this->enviarRespuesta(["response" => $respuesta]);
    }

    public static function register() {
        $instance = new static();
        $controllerName = $instance->getControllerName();
        $routes = [
            ['method' => 'GET', 'route' => $controllerName, 'callback' => [$instance, 'getAll']],
            ['method' => 'GET', 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'get']],
            ['method' => 'POST', 'route' => $controllerName, 'callback' => [$instance, 'create']],
            ['method' => 'PUT', 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'update']],
            ['method' => 'DELETE', 'route' => $controllerName . '/{id}', 'callback' => [$instance, 'delete']]
        ];
        Router::register($routes);
    }
}
