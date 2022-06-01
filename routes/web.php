<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\PostController;

$app->get('/', HomeController::class . ':index');

$app->group('/api', function(\Slim\App $app) {
    $app->get('/users', UserController::class . ':index');
});

$app->post('/api/users/create', UserController::class . ':create');
$app->post('/api/users/login', UserController::class . ':login');
$app->post('/login', function (Request $request, Response $response, array $args) {

    $input = $request->getParsedBody();
    $sql = "SELECT * FROM users WHERE email= :email";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("email", $input['email']);
    $sth->execute();
    $user = $sth->fetchObject();

    // verify email address.
    if (!$user) {
        return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);
    }

    // verify password.
    if (!password_verify($input['password'], $user->password)) {
        return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);
    }

    $settings = $this->get('settings'); // get settings array.

    $token = JWT::encode(['id' => $user->id, 'email' => $user->email], $settings['jwt']['secret'], "HS256");

    return $this->response->withJson(['token' => $token]);
});

$app->put('/api/users/update', UserController::class . ':update');

$app->post('/api/posts/create', PostController::class . ':create');
$app->put('/api/posts/update', PostController::class . ':update');
$app->delete('/api/posts/delete', PostController::class . ':delete');
$app->get('/api/posts', PostController::class . ':index');


