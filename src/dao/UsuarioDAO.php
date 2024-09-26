<?php

namespace dao;

class UsuarioDAO extends DAO {

    private const TABLA = "usuario";
    private const LISTAR = "SELECT * FROM listar_" . self::TABLA . "s";
    private const BUSCAR_POR_CORREO = self::LISTAR . " WHERE correo_electronico = ?";

    public function buscarPorCorreo($correo) {
        $prep = $this->prepararInstruccion(self::BUSCAR_POR_CORREO);
        $prep->agregarString($correo);
        return $prep->ejecutarConsulta();
    }
}
