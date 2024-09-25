<?php

namespace dao;

class Conexion {

    private $conexion;
    private $conexionAbierta = false;

    public function __construct() {
        $this->crearConexion();
    }

    public function crearConexion($servidor = DB_HOST, $usuario = DB_USER, $contrasenia = DB_PASS, $bd = DB_NAME) {
        if ($this->conexionAbierta) {
            $this->cerrarConexion();
        }
        $this->conexion = new \mysqli($servidor, $usuario, $contrasenia, $bd);
        if ($this->conexion->connect_errno) {
            die("Connection failed: " . $this->conexion->connect_error);
            exit();
        } else {
            $this->conexion->set_charset("utf8");
            $this->conexionAbierta = true;
        }
    }

    public function cerrarConexion() {
        if ($this->conexionAbierta) {
            $this->conexion->close();
            $this->conexion = null;
            $this->conexionAbierta = false;
        }
    }

    public function esConexionNueva() {
        return !$this->conexionAbierta;
    }

    public function isConnected() {
        return $this->conexion !== null && $this->conexion->ping();
    }

    public function ejecutarInstruccion($instruccion) {
        return $this->conexion->query($instruccion);
    }

    public function prepararInstruccion($instruccion){
        return $this->conexion->prepare($instruccion);
    }

    public function errorInfo() {
        return $this->conexion->error;
    }

    public function affectedRows() {
        return $this->conexion->affected_rows;
    }

    public function obtenerIdAutogenerado() {
        return $this->conexion->insert_id;
    }
}
