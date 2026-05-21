<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Http\JsonResponse;
use App\Services\CategoriaService;

class CategoriaController
{
    private CategoriaService $service;

    public function __construct(){
        $this->service = new CategoriaService();
    }

    public function save(array $body = []): string{
        $novaCategoria = $this->service->save($body);
        return JsonResponse::json(201, 'success', $novaCategoria);
    }

    public function getAll(): string{
        $categorias = $this->service->getAll();
        return JsonResponse::json(200, 'success', $categorias);
    }

    public function delete(array $params = []): string{
        $this->service->delete((int)$params['id']);
        return JsonResponse::json(200, 'success');
    }

}

