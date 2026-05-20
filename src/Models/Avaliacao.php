<?php

declare(strict_types=1);
namespace App\Models;

class Avaliacao{
    public function __construct(
        private int $id,
        private int $nota,
        private string $comentario
    ){}

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getNota(): int{
        return $this->nota;
    }

    public function setNota(int $nota): void{
        $this->nota = $nota;
    }

    public function getComentario(): string{
        return $this->comentario;
    }

    public function setComentario(string $comentario): void{
        $this->comentario = $comentario;
    }

}
