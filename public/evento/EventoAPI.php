<?php

namespace evento;

use controller\API;
use admin\AdminFactory;

class EventoAPI extends API {

    protected function getControllerName() {
        return "evento";
    }

    public function getById(int $id) {
        $this->sendResponse(AdminFactory::getAdminEvento()->buscarPorID($id));
    }

    public function getByValue(string $value) {
        $this->sendResponse(AdminFactory::getAdminEvento()->buscarPorNombreLugarDescripcion($value));
    }

    public function getAll() {
        $admin = AdminFactory::getAdminEvento();
        $filter = $this->getData();
        $this->sendResponse(
                isset($filter["fecha_inicio"]) ?
                        $admin->buscarPorFecha($filter["fecha_inicio"], $filter["fecha_fin"] ?? null) :
                        $admin->listar()
        );
    }

    public function create() {
        $this->sendOperationResult(AdminFactory::getAdminEvento()->insertar($this->getData()));
    }

    public function update($id) {
        $this->sendOperationResult(AdminFactory::getAdminEvento()->actualizar($id, $this->getData()));
    }

    public function delete($id) {
        $this->sendOperationResult(AdminFactory::getAdminEvento()->eliminar($id));
    }

    public function agregarParticipante($evento_id, $integrante_id) {
        $this->sendOperationResult(AdminFactory::getAdminEvento()->insertarParticipante($evento_id, $integrante_id));
    }

    public function eliminarParticipante($evento_id, $integrante_id) {
        $this->sendOperationResult(AdminFactory::getAdminEvento()->eliminarParticipante($evento_id, $integrante_id));
    }

    public static function register() {
        parent::register();
        self::addRoute(self::POST, "/{evento}/{integrante}", "agregarParticipante");
        self::addRoute(self::DELETE, "/{evento}/{integrante}", "eliminarParticipante");
    }
}
