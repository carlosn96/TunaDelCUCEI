<?php

namespace modelo;

class Instrumento {

    use Entidad;

    private int $id;
    private string $nombre;

    public function __construct(string $nombre, int $id = 0) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }
}
