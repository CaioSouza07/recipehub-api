<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\JsonResponse;
use App\Http\Router;

$router = new Router();

require __DIR__ . '/../routes/api.php';

try {
    $router->dispatch();
} catch (\Throwable $e) {
    echo JsonResponse::json(500, $e->getMessage());
}
