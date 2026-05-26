<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\JsonResponse;
use App\Services\ReceitaService;

class ReceitaController
{
    private ReceitaService $receitaService;

    public function __construct()
    {
        $this->receitaService = new ReceitaService();
    }

    public function save(array $body = []): string
    {
        try {
            $novaReceita = $this->receitaService->save($body);
            return JsonResponse::json(201, 'success', $novaReceita);
        } catch (\Exception $e) {
            return JsonResponse::json(500, $e->getMessage());
        }
    }

    public function getAll(): string
    {
        try {
            $receitas = $this->receitaService->getAll();
            return JsonResponse::json(200, 'success', $receitas);
        } catch (\Exception $e) {
            return JsonResponse::json(500, $e->getMessage());
        }
    }

    public function delete(array $params = []): string
    {
        try{
            $this->receitaService->delete($params);
            return JsonResponse::json(200, 'success');
        }catch (\Exception $e){
            return JsonResponse::json(500, $e->getMessage());
        }

    }
}
