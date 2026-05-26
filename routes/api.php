<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Controllers\ReceitaController;
use App\Http\Router;

/** @var Router $router */

$categoriaController = new CategoriaController();
$receitaController = new ReceitaController();

$router->post('/categorias', fn($p, $b) => $categoriaController->save($b));
$router->get('/categorias', fn($p, $b) => $categoriaController->getAll());
$router->delete('/categorias/{id}', fn($p, $b) => $categoriaController->delete($p));


$router->post('/receitas', fn($p, $b) => $receitaController->save($b));
$router->get('/receitas', fn($p, $b) => $receitaController->getAll());