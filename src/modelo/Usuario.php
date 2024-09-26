<?php

namespace modelo;

class Usuario {

    use Entidad;

    private $id;
    private $correoElectronico;
    private $contrasenia;
    private $rol;
    private Integrante $integrante;

    public function __construct($id, $correoElectronico, $contrasenia, $rol,
            Integrante $integrante) {
        $this->id = $id;
        $this->correoElectronico = $correoElectronico;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;
        $this->integrante = $integrante;
    }

    public function getId() {
        return $this->id;
    }

    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getIntegrante(): Integrante {
        return $this->integrante;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCorreoElectronico($correoElectronico): void {
        $this->correoElectronico = $correoElectronico;
    }

    public function setContrasenia($contrasenia): void {
        $this->contrasenia = $contrasenia;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setIntegrante(Integrante $integrante): void {
        $this->integrante = $integrante;
    }

    public function toArray() {
        $array = [];
        $reflectionClass = new \ReflectionClass($this);

        // Extraer las propiedades del objeto
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($this);
        }

        // Agrega el integrante al array si está presente
        if ($this->integrante) {
            $array['integrante'] = $this->integrante->toArray();
        }

        return $array;
    }
}
