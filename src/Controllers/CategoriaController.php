<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Database\Connection;
use App\Http\JsonResponse;
use App\Services\CategoriaService;

class CategoriaController
{
    private CategoriaService $service;

    public function __construct(){
        $this->service = new CategoriaService();
    }

    public function save(array $parametros): string{
        $novaCategoria = $this->service->save($parametros);
        return JsonResponse::json(200, 'success', $novaCategoria);
    }

}

