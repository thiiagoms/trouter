<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use TRouter\Controllers\HelloWorldController;
use TRouter\Http\Router;

$router = new Router();

$router->get('/', function () {
    echo 'Hello World from callback';
});

$router->post('/', function () {
    echo 'Hello World from POST callback';
});

$router->get('/static-method', HelloWorldController::class, 'testStatic');
$router->get('/instance-method', HelloWorldController::class, 'testInstance');

$router->get('/hello', function () {
    echo 'Hello World from GET method';
});

$router->post('/hello', function () {
    echo 'Hello World from POST method';
});

$router->put('/hello', function () {
    echo 'Hello World from PUT method';
});

$router->delete('/hello', function () {
    echo 'Hello World from DELETE method';
});

$router->run();
