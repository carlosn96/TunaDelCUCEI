<?php

namespace admin;

class AdminInstrumento extends Admin {

    public function __construct() {
        parent::__construct(new \dao\InstrumentoDAO());
    }

    public function buscarPorNombre($nombre) {
        return count($rs = $this->dao->buscarPorNombreLugarDescripcion($nombre)) ? $this->construirEvento($rs)->toArray() :
                $rs;
    }

    public function buscarPorID($id) {
        return count($rs = $this->dao->buscarPorID($id)) ? $this->construirInstrumento($rs)->toArray() : $rs;
    }

    public function listar() {
        return $this->construirListado($this->dao->listar());
    }

    public function insertar($form) {
        return $this->dao->insertar($this->construirInstrumento($form));
    }

    public function eliminar($id) {
        return $this->dao->eliminar($id);
    }

    public function actualizar($id, $form) {
        $form["id"] = $id;
        return $this->dao->actualizar($this->construirInstrumento($form));
    }

    private function construirInstrumento($data): \modelo\Instrumento {
        $id = $data["id"] ?? 0;
        $nombre = $data["nombre"] ?? '';
        return new \modelo\Instrumento($nombre, $id);
    }

    private function construirListado($data) {
        $lista = [];
        foreach ($data as $row) {
            $lista[] = $this->construirInstrumento($row)->toArray();
        }
        return $lista;
    }
}
