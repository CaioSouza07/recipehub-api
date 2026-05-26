<?php

declare(strict_types=1);

namespace App\Models;

class Receita
{
    public function __construct(
        private ?int $id,
        private Categoria $categoria,
        private string $titulo,
        private int $tempoPreparo,
        private ?array $listaIngredientes,
        private string $modoPreparo,
    ) {}

    public function toArray(): array
    {
        return [
            'titulo' => $this->titulo,
            'categoria' => [
                'id' => $this->categoria->getId(),
                'nome' => $this->categoria->getNome()
            ],
            'tempo_preparo' => $this->tempoPreparo,
            'modo_preparo' => $this->modoPreparo,
            'ingredientes' => $this->listaIngredientes ?? []
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getTempoPreparo(): int
    {
        return $this->tempoPreparo;
    }

    public function getListaIngredientes(): array
    {
        return $this->listaIngredientes ?? [];
    }

    public function addIngrediente(array $ingrediente): void
    {
        $this->listaIngredientes[] = $ingrediente;
    }

    public function getModoPreparo(): string
    {
        return $this->modoPreparo;
    }
}
