<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\Connection;
use App\Models\Categoria;
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
}
