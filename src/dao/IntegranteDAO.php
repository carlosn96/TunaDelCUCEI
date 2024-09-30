<?php

namespace dao;

class IntegranteDAO extends DAO {

    private const NOMBRE_TABLA = "integrante";
    private const SELECT = "SELECT * FROM listar_integrantes __where__";
    private const INSERTAR = "CALL insertar_" . self::NOMBRE_TABLA . " (?, ?, ?, ?, ?)";
    private const ACTUALIZAR = "CALL actualizar_" . self::NOMBRE_TABLA . " (?, ?, ?, ?, ?, ?)";
    private const CONSULTAR_RANGOS = "SELECT * FROM listar_rangos";
    private const CONSULTAR_INSTRUMENTOS = "SELECT * FROM instrumento";

    public function buscarPorNombreMote($valorBuscado) {
        $campoBusqueda = "'%$valorBuscado%'";
        $sql = "WHERE nombre LIKE $campoBusqueda OR mote LIKE $campoBusqueda";
        return $this->buscarPorCampo($sql);
    }

    public function buscarPorCorreo($correoElectronico) {
        $sql = "WHERE correo_electronico = $correoElectronico";
        return $this->buscarPorCampo($sql);
    }

    public function buscarPorID($id) {
        return $this->buscarPorCampo("WHERE integrante_id = $id", false);
    }

    public function listar() {
        return $this->buscarPorCampo("");
    }

    public function insertar(\modelo\Integrante $integrante) {
        $prep = $this->prepararInstruccion(self::INSERTAR);
        $prep->agregarString($integrante->getNombre());
        $prep->agregarString($integrante->getMote());
        $prep->agregarString($integrante->getFechaIngreso());
        $prep->agregarString($integrante->getRango());
        $prep->agregarJSON($integrante->getInstrumentos());
        return $prep->ejecutar();
    }

    public function actualizar(\modelo\Integrante $integrante) {
        $prep = $this->prepararInstruccion(self::ACTUALIZAR);
        $prep->agregarInt($integrante->getId());
        $prep->agregarString($integrante->getNombre());
        $prep->agregarString($integrante->getMote());
        $prep->agregarString($integrante->getFechaIngreso());
        $prep->agregarString($integrante->getRango());
        $prep->agregarJSON($integrante->getInstrumentos());
        return $prep->ejecutar();
    }

    private function buscarPorCampo($where, $fetchAll = true) {
        return $this->ejecutarConsulta(str_replace("__where__", $where, self::SELECT), $fetchAll);
    }

    public function eliminar($id) {
        return $this->eliminarPorId(self::NOMBRE_TABLA, "id", $id);
    }

    public function getRangos() {
        $rangos = $this->ejecutarConsulta(self::CONSULTAR_RANGOS);
        return explode(",", $rangos[0]["rango"]);
    }

    public function getInstruments() {
        return $this->ejecutarConsulta(self::CONSULTAR_INSTRUMENTOS);
    }
}
