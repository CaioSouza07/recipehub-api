<?php

declare(strict_types=1);
namespace App\Repository;

use App\Models\Avaliacao;
use App\Models\Receita;
use PDO;

class AvaliacaoRepository{

    private PDO $pdo;
    private ReceitaRepository $receitaRepository;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
        $this->receitaRepository = new ReceitaRepository($pdo);
    }

    public function save(Avaliacao $avaliacao): ?Avaliacao{
        $stmt = $this->pdo->prepare('INSERT INTO avaliacoes (id_receita, nota, comentario) VALUES(:id_receita, :nota, :comentario)');
        $stmt->execute([
            ':id_receita' => $avaliacao->getReceita()->getId(),
            ':nota' => $avaliacao->getNota(),
            ':comentario' => $avaliacao->getComentario()
        ]);

        if ($this->pdo->lastInsertId()){
            $id = $this->pdo->lastInsertId();
            $avaliacao->getReceita()->setId((int)$id);
            return $avaliacao;
        }
        return null;
    }

    public function delete(Avaliacao $avaliacao): bool{
        $stmt = $this->pdo->prepare('DELETE FROM avaliacoes WHERE id = :id');
        $stmt->execute(['id' => $avaliacao->getId()]);
        return $stmt->rowCount() > 0;
    }

    public function findById(int $id): ?Avaliacao{
        $stmt = $this->pdo->prepare('
            SELECT * from avaliacoes WHERE id = :id
        ');

        $stmt->execute([
            ':id' => $id
        ]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados){
            return null;
        }

        $receita = $this->receitaRepository->findById($dados['id_receita']);

        return new Avaliacao($dados['id'], $receita, $dados['nota'], $dados['comentario']);
    }

    public function findAllByReceita(Receita $receita): ?array{
        $stmt = $this->pdo->prepare('SELECT id, nota, comentario FROM avaliacoes WHERE id_receita = :id_receita');
        $stmt->execute([
            ':id_receita' => $receita->getId()
        ]);

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$dados){
            return null;
        }

        return array_map(fn ($d) => new Avaliacao($d['id'], $receita, $d['nota'], $d['comentario']), $dados);
    }
}