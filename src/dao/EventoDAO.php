<?php

namespace dao;

class EventoDAO extends DAO {

    private const NOMBRE_TABLA = "evento";
    private const SELECT = "SELECT * FROM listar_" . self::NOMBRE_TABLA . "s __where__";
    private const INSERTAR = "CALL insertar_" . self::NOMBRE_TABLA . " (?, ?, ?, ?)";
    private const ACTUALIZAR = "CALL actualizar_" . self::NOMBRE_TABLA . " (?, ?, ?, ?, ?)";
    private const INSERTAR_PARTICIPANTE = "INSERT INTO evento_participante VALUES (?, ?)";
    private const ELIMINAR_PARTICIPANTE = "DELETE FROM evento_participante WHERE evento_id = ? AND integrante_id = ?";

    public function insertar(\modelo\Evento $evento) {
        $prep = $this->prepararInstruccion(self::INSERTAR);
        $prep->agregarString($evento->getNombre());
        $prep->agregarString($evento->getFechaHora());
        $prep->agregarString($evento->getLugar());
        $prep->agregarString($evento->getDescripcion());
        return $prep->ejecutar();
    }

    public function insertarParticipante($idEvento, $idParticipante) {
        return $this->modificarParticipante(self::INSERTAR_PARTICIPANTE, $idEvento, $idParticipante);
    }

    public function eliminarParticipante($idEvento, $idParticipante) {
        return $this->modificarParticipante(self::ELIMINAR_PARTICIPANTE, $idEvento, $idParticipante);
    }

    private function modificarParticipante($instruccion, $idEvento, $idParticipante) {
        $prep = $this->prepararInstruccion($instruccion);
        $prep->agregarInt($idEvento);
        $prep->agregarInt($idParticipante);
        return $prep->ejecutar();
    }

    public function listar() {
        return $this->buscarPorCampo("");
    }

    public function buscarPorNombreLugarDescripcion($valorBuscado) {
        $campoBusqueda = "'%$valorBuscado%'";
        $sql = "WHERE nombre LIKE $campoBusqueda OR lugar LIKE $campoBusqueda OR descripcion LIKE $campoBusqueda";
        return $this->buscarPorCampo($sql);
    }

    public function buscarPorID($id) {
        return $this->buscarPorCampo("WHERE id = $id", false);
    }

    public function buscarPorFecha($fechaInicio, $fechaFin) {
        $fechaFin = $fechaFin ? "'$fechaFin'" : 'NOW()';
        $where = " WHERE fechaHora BETWEEN '$fechaInicio' AND $fechaFin";
        return $this->buscarPorCampo($where);
    }

    public function actualizar(\modelo\Evento $evento) {
        $prep = $this->prepararInstruccion(self::ACTUALIZAR);
        $prep->agregarInt($evento->getId());
        $prep->agregarString($evento->getNombre());
        $prep->agregarString($evento->getFechaHora());
        $prep->agregarString($evento->getLugar());
        $prep->agregarString($evento->getDescripcion());
        return $prep->ejecutar();
    }

    private function buscarPorCampo($where, $fetchAll = true) {
        return $this->ejecutarConsulta(str_replace("__where__", $where, self::SELECT), $fetchAll);
    }

    public function eliminar($id) {
        return $this->eliminarPorId(self::NOMBRE_TABLA, "id", $id);
    }
}
