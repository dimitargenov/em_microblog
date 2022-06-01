<?php

use Slim\App;
use App\Controllers\UserController;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', \App\Controllers\HomeController::class . ':index');

    $app->get('/users', UserController::class . ':index');
    $app->get('/users/create', UserController::class . ':showCreate');
    $app->post('/users/create', UserController::class . ':create');
    $app->get('/users/delete/{id}', UserController::class . ':delete');
};
