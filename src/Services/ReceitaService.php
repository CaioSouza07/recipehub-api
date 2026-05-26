<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\Connection;
use App\Models\Receita;
use App\Repository\CategoriaRepository;
use App\Repository\IngredienteRepository;
use App\Repository\ReceitaRepository;

class ReceitaService
{
    private ReceitaRepository $receitaRepository;
    private IngredienteRepository $ingredienteRepository;
    private CategoriaRepository $categoriaRepository;

    public function __construct()
    {
        $pdo = Connection::getConnection();
        $this->receitaRepository = new ReceitaRepository($pdo);
        $this->ingredienteRepository = new IngredienteRepository($pdo);
        $this->categoriaRepository = new CategoriaRepository($pdo);
    }

    public function save(array $body): array
    {
        $categoria = $this->categoriaRepository->findById($body['id_categoria']);

        if (!$categoria) {
            throw new \Exception('Nenhuma categoria com esse id encontrada!');
        }

        $receita = new Receita(null, $categoria, $body['titulo'], (int) $body['tempo_preparo'], null, $body['modo_preparo']);
        $receita = $this->receitaRepository->save($receita);

        foreach ($body['ingredientes'] as $i) {
            $ingrediente = $this->ingredienteRepository->findByNome($i['nome']);
            if (!$ingrediente) {
                $ingrediente = $this->ingredienteRepository->save($i['nome']);
            }

            $this->receitaRepository->saveReceitaIngrediente($receita->getId(), $ingrediente->getId(), $i['quantidade']);
            $receita->addIngrediente([
                'id' => $ingrediente->getId(),
                'nome' => $ingrediente->getNome(),
                'quantidade' => $i['quantidade']
            ]);
        }

        return $receita->toArray();
    }

    public function getAll(): array
    {
        $receitas = $this->receitaRepository->findAll();
        return array_map(fn($r) => $r->toArray(), $receitas);
    }

    public function delete(array $params): void
    {

    }

}
