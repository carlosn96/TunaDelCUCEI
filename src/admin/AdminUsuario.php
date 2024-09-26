<?php

namespace admin;

class AdminUsuario extends Admin {
    
    public function __construct() {
        parent::__construct(new \dao\UsuarioDAO);
    }

    public function construirUsuario($data) {
        $id = $data["id"] ?? 0;
        $correoElectronico = $data["correo_electronico"];
        $contrasenia = $data["contrasenia"];
        $rol = $data["rol"];
        $integrante = AdminFactory::getAdminIntegrante()->construirIntegrante($data);
        return new \modelo\Usuario($id, $correoElectronico, $contrasenia, $rol, $integrante);
    }

    public function autenticar($correo) {
        $data = $this->dao->buscarPorCorreo($correo);
        if (count($data)) {
            return $this->construirUsuario($data);
        } else {
            return self::SIN_INFORMACION;
        }
    }
}
