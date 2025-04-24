<?php

use App\Core\Router;
use App\Controllers\TaskController;

$router = new Router();

/**
 * Grupo de rotas para task
 */
$router->group('/tasks', function ($router) {
    $router->get('/', fn () => (new TaskController())->index());
    $router->get('/{id}', fn ($id) => (new TaskController())->show($id));
    $router->post('/', fn () => (new TaskController())->create());
    $router->patch('/{id}', fn ($id) => (new TaskController())->update($id));
    $router->delete('/{id}', fn ($id) => (new TaskController())->delete($id));
});


// Despacha a requisição
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
