<?php

declare(strict_types=1);
namespace App\Repository;

use App\Models\Ingrediente;
use PDO;
class IngredienteRepository{
    public function __construct(
        private PDO $pdo
    ){}

    public function findAll(): array{
        $dados = $this->pdo->query('SELECT * FROM ingredientes')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($i) => new Ingrediente($i['id'], $i['nome']), $dados);
    }

    public function findById(int $id): ?Ingrediente{
        $stmt = $this->pdo->prepare('SELECT * FROM ingredientes WHERE id = :id');
        $stmt->execute([':id' => $id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados){
            return new Ingrediente($dados['id'], $dados['nome']);
        }
        return null;
    }

    public function findByNome(string $nome): ?Ingrediente{
        $stmt = $this->pdo->prepare('SELECT * FROM ingredientes WHERE nome = :nome');
        $stmt->execute([':nome' => $nome]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados){
            return new Ingrediente($dados['id'], $dados['nome']);
        }
        return null;
    }

    public function save(string $nome): ?Ingrediente{
        $stmt = $this->pdo->prepare('INSERT INTO ingredientes (nome) VALUES (:nome)');
        $stmt->execute([':nome' => $nome]);
        if ($this->pdo->lastInsertId()){
            $id = $this->pdo->lastInsertId();
            return new Ingrediente((int)$id, $nome);
        }
        return null;
    }

}