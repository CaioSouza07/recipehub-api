<?php

declare(strict_types=1);
namespace model;

class Receita{
    public function __construct(
        private int $id,
        private Categoria $categoria,
        private string $titulo,
        private int $tempoPreparo
    ){}

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getCategoria(): \model\Categoria{
        return $this->categoria;
    }

    public function setCategoria(\model\Categoria $categoria): void{
        $this->categoria = $categoria;
    }

    public function getTitulo(): string{
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void{
        $this->titulo = $titulo;
    }

    public function getTempoPreparo(): int{
        return $this->tempoPreparo;
    }

    public function setTempoPreparo(int $tempoPreparo): void{
        $this->tempoPreparo = $tempoPreparo;
    }

}
