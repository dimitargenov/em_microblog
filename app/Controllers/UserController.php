<?php

namespace App\Controllers;

use App\Helpers\Validator;

use App\Models\UserModel;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class UserController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $users = $this->container['db']->table('users')->get();;

        return $this->container->view->render($response, 'user/index.twig', [
            'appName' => $this->container->settings['app']['name'],
            'pageName' => 'User list',
            'users' => $users
        ]);
    }

    public function showCreate(Request $request, Response $response, $args)
    {
        return $this->container->view->render($response, 'user/create.twig', [
            'appName' => $this->container->settings['app']['name'],
            'pageName' => 'Users create'
        ]);
    }

    public function create(Request $request, Response $response, $args)
    {
        $bodyParams = $request->getParsedBody();

        $this->container['db']->table('users')->insert(
            [
                "first_name" => $bodyParams['firstName'],
                "last_name" => $bodyParams['lastName'],
                "password" => $bodyParams['password'],
                "email" => $bodyParams['email']
            ]
        );

        return $response->withStatus(302)->withHeader('Location', '/users');
    }

    public function delete(Request $request, Response $response, $args)
    {
        $this->container['db']->table('users')->delete($args['id']);

        return $response->withStatus(302)->withHeader('Location', '/users');
    }
}

