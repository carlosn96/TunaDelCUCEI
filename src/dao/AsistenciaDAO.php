<?php

namespace dao;

class AsistenciaDAO extends DAO {

    private const ASISTENCIA = 1;
    private const FALTA = 0;
    private const NOMBRE_TABLA = "asistencia";
    private const LISTAR_ASISTENCIA = "SELECT * FROM listar_" . self::NOMBRE_TABLA . "s";
    private const LISTAR_ASISTENCIA_POR_EVENTO = self::LISTAR_ASISTENCIA . " WHERE evento_id = ? AND asistencia = ?";
    private const ACTUALIZAR_ASISTENCIA = "UPDATE " . self::NOMBRE_TABLA . " SET asistencia = ? WHERE evento_id = ? AND integrante_id = ?";

    public function actualizarAsistencia($integrante, $evento, $asistencia) {
        $prep = $this->prepararInstruccion(self::ACTUALIZAR_ASISTENCIA);
        $prep->agregarInt($asistencia);
        $prep->agregarInt($evento);
        $prep->agregarInt($integrante);
        return $prep->ejecutar();
    }

    public function listarAsistentesPorEvento($idEvento) {
        return $this->listarAsistencia($idEvento, self::ASISTENCIA);
    }

    public function listarFaltantesPorEvento($idEvento) {
        return $this->listarAsistencia($idEvento, self::FALTA);
    }

    private function listarAsistencia($idEvento, $tipoAsistencia) {
        $prep = $this->prepararInstruccion(self::LISTAR_ASISTENCIA_POR_EVENTO);
        $prep->agregarInt($idEvento);
        $prep->agregarInt($tipoAsistencia);
        return $prep->ejecutarConsultaMultiple();
    }
}
