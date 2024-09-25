<?php

namespace admin;

class AdminEvento extends Admin {

    public function __construct() {
        parent::__construct(new \dao\EventoDAO());
    }

    public function buscarPorNombreLugarDescripcion($nombre) {
        return count($rs = $this->dao->buscarPorNombreLugarDescripcion($nombre)) ? $this->construirEvento($rs)->toArray() :
                $rs;
    }

    public function buscarPorID($id) {
        return count($rs = $this->dao->buscarPorID($id)) ? $this->construirEvento($rs)->toArray() : $rs;
    }

    public function buscarPorFecha($fechaInicio, $fechaFin) {
        return $this->construirListado($this->dao->buscarPorFecha($fechaInicio, $fechaFin));
    }

    public function listar() {
        return $this->construirListado($this->dao->listar());
    }

    public function insertar($form) {
        return $this->dao->insertar($this->construirEvento($form));
    }

    public function insertarParticipante($idEvento, $idParticipante) {
        return $this->dao->insertarParticipante($idEvento, $idParticipante);
    }

    public function eliminarParticipante($idEvento, $idParticipante) {
        return $this->dao->eliminarParticipante($idEvento, $idParticipante);
    }

    public function eliminar($id) {
        return $this->dao->eliminar($id);
    }

    public function actualizar($id, $form) {
        $form["id"] = $id;
        return $this->dao->actualizar($this->construirEvento($form));
    }

    private function construirEvento($data): \modelo\Evento {
        $id = $data["id"] ?? 0;
        $nombre = $data["nombre"] ?? '';
        $fechaHora = $data["fechaHora"] ?? '';
        $lugar = $data["lugar"] ?? '';
        $descripcion = $data["descripcion"] ?? '';
        return new \modelo\Evento($id, $nombre, $fechaHora, $lugar, $descripcion);
    }

    private function construirListado($data) {
        $lista = [];
        foreach ($data as $row) {
            $lista[] = $this->construirEvento($row)->toArray();
        }
        return $lista;
    }
}
