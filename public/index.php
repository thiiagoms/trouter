<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use TRouter\Controllers\HelloWorldController;
use TRouter\Http\Router;

$router = new Router();

$router->get('/', function () {
    echo 'Hello World from callback';
});

$router->get('/static-method', HelloWorldController::class, 'testStatic');
$router->get('/instance-method', HelloWorldController::class, 'testInstance');

$router->post('/', function () {
    echo 'Hello World from POST callback';
});

$router->run();
