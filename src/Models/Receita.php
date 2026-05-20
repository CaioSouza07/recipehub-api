<?php

declare(strict_types=1);
namespace App\Models;

class Receita{
    public function __construct(
        private int $id,
        private Categoria $categoria,
        private string $titulo,
        private int $tempoPreparo,
        private array $listaIngredientes,
        private string $modoPreparo
    ){}

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getCategoria(): Categoria{
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria): void{
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

    public function getListaIngredientes(): array{
        return $this->listaIngredientes;
    }

    public function setListaIngredientes(array $listaIngredientes): void{
        $this->listaIngredientes = $listaIngredientes;
    }

    public function addIngrediente(Ingrediente $ingrediente): void{
        $this->listaIngredientes[] = [$ingrediente->getId() => $ingrediente->getNome()];
    }

    public function removeIngrediente(Ingrediente $ingrediente): void{
        unset($this->listaIngredientes[$ingrediente->getId()]);
    }

    public function getModoPreparo(): string
    {
        return $this->modoPreparo;
    }

    public function setModoPreparo(string $modoPreparo): void
    {
        $this->modoPreparo = $modoPreparo;
    }

}
