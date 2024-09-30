<?php

namespace dao;

class InstrumentoDAO extends DAO {

    private const NOMBRE_TABLA = "instrumento";
    private const SELECT = "SELECT * FROM " . self::NOMBRE_TABLA . " __where__";
    private const INSERTAR = "INSERT INTO " . self::NOMBRE_TABLA . " (nombre) VALUES(?)";
    private const ACTUALIZAR = "CALL actualizar_" . self::NOMBRE_TABLA . " (?)";

    public function insertar(\modelo\Instrumento $instrumento) {
        $prep = $this->prepararInstruccion(self::INSERTAR);
        $prep->agregarString($instrumento->getNombre());
        try {
            if ($prep->ejecutar()) {
                $id = $this->obtenerIdAutogenerado();
                return $this->buscarPorID($id);
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
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
