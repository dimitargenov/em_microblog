<?php

use Slim\App;
use App\Controllers\UserController;
use App\Controllers\PostController;

return function (App $app) {
    $app->get('/', \App\Controllers\HomeController::class . ':index');

    $app->get('/users', UserController::class . ':index');
    $app->get('/users/create', UserController::class . ':showCreate');
    $app->post('/users/create', UserController::class . ':create');
    $app->get('/users/delete/{id}', UserController::class . ':delete');

    // TODO
    $app->put('/users/update/{id}', UserController::class . ':update');
    $app->put('/users/login', UserController::class . ':login');

    $app->get('/posts/create', PostController::class . ':showCreate');
    $app->post('/posts/create', PostController::class . ':create');
    $app->put('/posts/update/{id}', PostController::class . ':update');
    $app->get('/posts/delete/{id}', PostController::class . ':delete');
    $app->get('/posts', PostController::class . ':index');
};
