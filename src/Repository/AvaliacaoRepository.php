<?php

declare(strict_types=1);
namespace App\Repository;

use App\Models\Avaliacao;
use PDO;

class AvaliacaoRepository{

    public function __construct(
        private PDO $pdo
    ){}

    public function findAll(): array{
        $dados = $this->pdo->query('SELECT * FROM avaliacoes')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($a) =>  , $dados);

    }

}