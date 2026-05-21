<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\Connection;
use App\Repository\CategoriaRepository;

class CategoriaService{

    private CategoriaRepository $categoriaRepository;

    public function __construct(){
        $this->categoriaRepository = new CategoriaRepository(Connection::getConnection());
    }

    public function save(array $parametros): array{
        $categoria = $this->categoriaRepository->save($parametros['nome']);
        return [
            'id' => $categoria->getId(),
            'nome' => $categoria->getNome()
        ];
    }

    public function getAll(): array{
        return $this->categoriaRepository->findAll();
    }

    public function delete(int $id): void{
        $this->categoriaRepository->delete($id);
    }
}
