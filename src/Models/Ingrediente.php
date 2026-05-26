<?php

declare(strict_types=1);

namespace App\Models;

class Ingrediente
{
    public function __construct(
        private int $id,
        private string $nome
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
