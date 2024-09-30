<?php

namespace admin;

class AdminIntegrante extends Admin {

    public function __construct() {
        parent::__construct(new \dao\IntegranteDAO());
    }

    public function buscarPorNombreMote($nombre) {
        return $this->construirListado($this->dao->buscarPorNombreMote($nombre));
    }

    public function buscarPorID($id) {
        return count($rs = $this->dao->buscarPorID($id)) ? $this->construirIntegrante($rs)->toArray() : $rs;
    }

    public function listar() {
        return $this->construirListado($this->dao->listar());
    }

    private function construirListado($data) {
        $lista = [];
        foreach ($data as $row) {
            $lista[] = $this->construirIntegrante($row)->toArray();
        }
        return $lista;
    }

    public function insertar($form) {
        return $this->dao->insertar($this->construirIntegrante($form));
    }

    public function eliminar($id) {
        return $this->dao->eliminar($id);
    }

    public function actualizar($id, $form) {
        $form["integrante_id"] = $id;
        return $this->dao->actualizar($this->construirIntegrante($form));
    }

    public function construirIntegrante($data): \modelo\Integrante {
        $nombre = $data["nombre"];
        $mote = $data["mote"];
        $fechaIngreso = $data["fechaIngreso"];
        $rango = $data["rango"];
        $instrumentos = is_array($instrumentos = $data["instrumentos"]) ? $instrumentos : explode(", ", $data["instrumentos"]);
        $id = $data["integrante_id"] ?? 0;
        return (new \modelo\Integrante($nombre, $mote, $fechaIngreso,
                        $rango, $instrumentos, $id));
    }
    
    public function getRangos() {
        return $this->dao->getRangos();
    }
    public function getInstruments() {
        return $this->dao->getInstruments();
    }
}
