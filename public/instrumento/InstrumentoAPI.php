<?php

namespace instrumento;

use controller\API;
use admin\AdminFactory;

class InstrumentoAPI extends API {

    protected function getControllerName() {
        return "instrumento";
    }

    public function create() {
        $this->sendResponse(AdminFactory::getAdminInstrumento()->insertar($this->getData()));
    }

    public function delete($id) {
        $this->sendOperationResult(AdminFactory::getAdminInstrumento()->eliminar($id));
    }
    
    public function getAll() {
        $this->sendResponse(AdminFactory::getAdminInstrumento()->listar());
    }



    public function getById(int $id) {
        
    }

    public function getByValue(string $value) {
        
    }

    public function update($id) {
        $this->sendOperationResult(false);
    }
}
