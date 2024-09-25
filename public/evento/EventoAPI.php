<?php

namespace integrante;

use controller\API;

class IntegranteAPI extends API {
    
    protected function getControllerName() {
        return "integrante";
    }

    public function getById(int $id) {
        echo json_encode(['message' => "Obteniendo integrante con ID $id"]);
    }

    public function getByValue(string $value) {
        echo json_encode(['message' => "Obteniendo integrante con valor: $value"]);
    }

    public function getAll() {
        echo json_encode(['message' => 'Lista de todos los integrantes']);
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['message' => 'Integrante creado con data: '. print_r($data)]);
    }

    public function update($id) {
        echo json_encode(['message' => "Integrante con ID $id actualizado con data: ". print_r(json_decode(file_get_contents("php://input"), true))]);
    }

    public function delete($id) {
        echo json_encode(['message' => "Integrante con ID $id eliminado"]);
    }
}