<?php

namespace admin;

class AdminAsistencia extends Admin {

    public function __construct() {
        parent::__construct(new \dao\AsistenciaDAO());
    }

    public function actualizarAsistencia($integrante, $evento, $asistencia) {
        return $this->dao->actualizarAsistencia($integrante, $evento, $asistencia);
    }

    public function listarAsistentesPorEvento($idEvento) {
        return $this->crearLista($this->dao->listarAsistentesPorEvento($idEvento));
    }

    public function listarFaltantesPorEvento($idEvento) {
        return $this->crearLista($this->dao->listarFaltantesPorEvento($idEvento));
    }

    private function crearLista($asistencias) {
        $adminIntegrantes = AdminFactory::getAdminIntegrante();
        $lista = [];
        foreach ($asistencias as $asistente) {
            $lista[] = $adminIntegrantes->construirIntegrante($asistente)->toArray();
        }
        return $lista;
    }
}
