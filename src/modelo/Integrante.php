<?php

namespace modelo;

class Integrante {

    use Entidad;

    private int $id;
    private string $nombre;
    private string $mote;
    private string $fechaIngreso;
    private string $rango;
    private array $instrumentos;

    public function __construct(string $nombre, string $mote,
            string $fechaIngreso, string $rango, array $instrumentos, int $id) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mote = $mote;
        $this->fechaIngreso = $fechaIngreso;
        $this->rango = $rango;
        $this->instrumentos = $instrumentos;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getMote(): string {
        return $this->mote;
    }

    public function getFechaIngreso(): string {
        return $this->fechaIngreso;
    }

    public function getRango(): string {
        return $this->rango;
    }

    public function getInstrumentos(): array {
        return $this->instrumentos;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setMote(string $mote): void {
        $this->mote = $mote;
    }

    public function setFechaIngreso(string $fechaIngreso): void {
        $this->fechaIngreso = $fechaIngreso;
    }

    public function setRango(string $rango): void {
        $this->rango = $rango;
    }

    public function setInstrumentos(array $instrumentos): void {
        $this->instrumentos = $instrumentos;
    }
}
