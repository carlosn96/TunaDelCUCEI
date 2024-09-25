<?php

namespace integrante;

use controller\API;
use admin\AdminFactory;

class IntegranteAPI extends API {

    protected function getControllerName() {
        return "integrante";
    }

    public function getById(int $id) {
        $this->sendResponse(AdminFactory::getAdminIntegrante()->buscarPorID($id));
    }

    public function getByValue(string $value) {
        if ($value === "getRanges") {
            $this->sendResponse(AdminFactory::getAdminIntegrante()->getRangos());
        } else {
            $this->sendResponse(AdminFactory::getAdminIntegrante()->buscarPorNombreMote($value));
        }
    }

    public function getAll() {
        $this->sendResponse(AdminFactory::getAdminIntegrante()->listar());
    }

    public function create() {
        $this->sendOperationResult(AdminFactory::getAdminIntegrante()->insertar($this->getData()));
    }

    public function update($id) {
        $this->sendOperationResult(AdminFactory::getAdminIntegrante()->actualizar($id, $this->getData()));
    }

    public function delete($id) {
        $this->sendOperationResult(AdminFactory::getAdminIntegrante()->eliminar($id));
    }

    public function getRangos() {
        
    }
}
