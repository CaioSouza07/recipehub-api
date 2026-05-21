<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Http\Router;

/** @var Router $router */

$categoriaController = new CategoriaController();

$router->post('/categorias', fn($p, $b) => $categoriaController->save($b));
$router->get('/categorias', fn($p, $b) => $categoriaController->getAll());
$router->delete('/categorias/{id}', fn($p, $b) => $categoriaController->delete($p));
