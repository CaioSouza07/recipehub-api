<?php

declare(strict_types=1);
namespace App\Repository;

use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Receita;
use PDO;

class ReceitaRepository{
    public function __construct(
        private PDO $pdo
    ){}

    public function findAll(): array{
        $dados = $this->pdo->query('
            SELECT r.id, r.id_categoria, c.nome as nome_categoria, r.titulo, r.tempo_preparo, r.modo_preparo FROM receitas r
            INNER JOIN categorias c
            ON r.id_categoria = c.id 
        ')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($r){
            $ingredientes = $this->findAllIngredientes($r['id']);
            $categoria = new Categoria($r['id_categoria'], $r['nome_categoria']);
            return new Receita($r['id'], $categoria, $r['titulo'], $r['tempo_preparo'], $ingredientes, $r['modo_preparo']);
        }, $dados);
    }

    public function findAllIngredientes(int $receitaId): array{
        $stmt = $this->pdo->prepare('
            SELECT ri.id_ingrediente, i.nome, ri.quantidade FROM receitas_ingredientes ri
            INNER JOIN ingredientes i
            ON ri.id_ingrediente = i.id
            WHERE ri.id_receita = :id_receita
        ');
        $stmt->execute([
            'id_receita' => $receitaId
        ]);

        return array_map(function ($i){

            $ingrediente = new Ingrediente($i['id_ingrediente'], $i['nome']);
            return [$i['id_ingrediente'] => [$ingrediente, $i['quantidade']]];

        }, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?Receita{
        $stmt = $this->pdo->prepare('SELECT * FROM receitas WHERE id = :id');
        $stmt->execute([':id' => $id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados){
            $ingredientes = $this->findAllIngredientes($dados['id']);
            $categoria = new Categoria($dados['id_categoria'], $dados['nome_categoria']);
            return new Receita($dados['id'], $categoria, $dados['titulo'], $dados['tempo_preparo'], $ingredientes, $dados['modo_preparo']);
        }
        return null;
    }

    public function save(Receita $receita): ?Receita{
        $stmt = $this->pdo->prepare('
            INSERT INTO receitas (id_categoria, titulo, tempo_preparo, modo_preparo) 
            VALUES (:id_categoria, :titulo, :tempo_preparo, :modo_preparo)
        ');
        $stmt->execute([
            ':id_categoria' => $receita->getCategoria()->getId(),
            ':titulo' => $receita->getTitulo(),
            ':tempo_preparo' => $receita->getTempoPreparo(),
            ':modo_preparo' => $receita->getModoPreparo()
        ]);
        if ($this->pdo->lastInsertId()){
            $id = $this->pdo->lastInsertId();
            $receita->setId((int)$id);
            return $receita;
        }
        return null;
    }

    public function delete(Receita $receita): bool{
        $stmt = $this->pdo->prepare('DELETE FROM receitas WHERE id = :id');
        $stmt->execute(['id' => $receita->getId()]);
        return $stmt->rowCount() > 0;
    }
}
