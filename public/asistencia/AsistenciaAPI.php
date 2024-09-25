<?php

namespace asistencia;

use controller\API;
use admin\AdminFactory;

class AsistenciaAPI extends API {

    protected function getControllerName() {
        return "asistencia";
    }

    /**
     * Obtiene la lista de asistencias para un evento específico.
     *
     * @param int $idEvento ID del evento para el que se listan las asistencias.
     */
    public function getById(int $idEvento) {
        $this->sendResponse(AdminFactory::getAdminAsistencia()->listarAsistentesPorEvento($idEvento));
    }

    /**
     * Obtiene la lista de faltas para un evento específico.
     *
     * @param int $idEvento ID del evento para el que se listan las faltas.
     */
    public function getFaltasById(int $idEvento) {
        $this->sendResponse(AdminFactory::getAdminAsistencia()->listarFaltantesPorEvento($idEvento));
    }

    public function getByValue(string $value) {
        
    }

    public function getAll() {
        
    }

    public function create() {
        
    }

    /**
     * Actualiza la asistencia de un integrante en un evento en especifico
     *
     * @param int $integrante ID del integrante.
     */
    public function update($integrante) {
        $data = $this->getData();
        $asistencia = $data["asistencia"] ?? 0;
        $evento = $data["evento"] ?? 0;
        $this->sendOperationResult(
                AdminFactory::getAdminAsistencia()->actualizarAsistencia(
                        $integrante,
                        $evento,
                        $asistencia
                )
        );
    }

    public function delete($id) {
        
    }

    public static function register() {
        parent::register();
        self::addRoute(self::GET, "/faltas/{evento}", "getFaltasById");
    }
}
