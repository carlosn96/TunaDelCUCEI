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
        switch ($value) {
            case "getRanges":
                $this->sendResponse(AdminFactory::getAdminIntegrante()->getRangos());
                break;
            default :
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

    public function autenticar() {
        $data = $this->getData();
        $correo = $data["correo"];
        $contrasenia = $data["contrasenia"];
        $usuario = AdminFactory::getAdminUsuario()->autenticar($correo);
        $statusCode = self::CODIGO_RESPUESTA_INFORMACION_INCORRECTA;
        $respuesta = self::RESPUESTA_VACIA;
        if ($usuario) {
            $statusCode = password_verify($contrasenia, $usuario->getContrasenia()) ? self::CODIGO_RESPUESTA_NO_ERROR : self::CODIGO_RESPUESTA_NO_AUTORIZADO;
            $respuesta = $usuario->toArray();
        }
        $this->sendResponse($respuesta, $statusCode);
    }

    public static function register() {
        parent::register();
        self::addRoute(self::POST, "/autenticar", "autenticar");
    }
}
