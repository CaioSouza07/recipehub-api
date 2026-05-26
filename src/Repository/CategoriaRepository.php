<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Categoria;
use PDO;

class CategoriaRepository
{
    public function __construct(
        private PDO $pdo
    ) {}

    public function findAll(): array
    {
        return $this->pdo->query('SELECT * FROM categorias')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?Categoria
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categorias WHERE id = :id');
        $stmt->execute([':id' => $id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            return new Categoria($dados['id'], $dados['nome']);
        }
        return null;
    }

    public function findByNome(string $nome): ?Categoria
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categorias WHERE nome = :nome');
        $stmt->execute([':nome' => $nome]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            return new Categoria($dados['id'], $dados['nome']);
        }
        return null;
    }

    public function save(string $nome): ?Categoria
    {
        $stmt = $this->pdo->prepare('INSERT INTO categorias (nome) VALUES (:nome)');
        $stmt->execute([':nome' => $nome]);

        $id = $this->pdo->lastInsertId();
        if ($id) {
            return new Categoria((int) $id, $nome);
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM categorias WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
