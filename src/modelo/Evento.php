<?php

namespace modelo;

class Evento {

    use Entidad;

    private int $id;
    private string $nombre;
    private string $fechaHora;
    private string $lugar;
    private string $descripcion;

    public function __construct(int $id, string $nombre, string $fechaHora, string $lugar, string $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fechaHora = $fechaHora;
        $this->lugar = $lugar;
        $this->descripcion = $descripcion;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getFechaHora(): string {
        return $this->fechaHora;
    }

    public function getLugar(): string {
        return $this->lugar;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setFechaHora(string $fechaHora): void {
        $this->fechaHora = $fechaHora;
    }

    public function setLugar(string $lugar): void {
        $this->lugar = $lugar;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }
}
