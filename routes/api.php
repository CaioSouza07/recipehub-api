<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Http\Router;

/** @var Router $router */

$categoriaController = new CategoriaController();

$router->post('/categorias', fn($p) => $categoriaController->save($p));
