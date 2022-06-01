<?php

namespace App\Controllers;

use App\Helpers\Validator;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class PostController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        $posts = $this->container['db']->table('posts')->get();;

        return $this->container->view->render($response, 'post/index.twig', [
            'appName' => $this->container->settings['app']['name'],
            'pageName' => 'Post list',
            'posts' => $posts
        ]);
    }

    public function showCreate(Request $request, Response $response, $args)
    {
        $users = $this->container['db']->table('users')->get();

        return $this->container->view->render($response, 'post/create.twig', [
            'appName' => $this->container->settings['app']['name'],
            'pageName' => 'Post create',
            'users' => $users
        ]);
    }

    public function create(Request $request, Response $response, $args)
    {
        // checks to ensure we have valid inputs
        $validator = $this->container['validator']->validate($request, [
            //'file' => Validator::image(),
            'title' => Validator::stringType()->notBlank(),
            'description' => Validator::stringType()->notBlank(),
            'userId' => Validator::intVal()->noWhitespace()->notBlank()
        ]);

        if ($validator->isValid()) {
            $bodyParams = $request->getParsedBody();
    
            $this->container['db']->table('posts')->insert(
                [
                    "title" => $bodyParams['title'],
                    "description" => $bodyParams['description'],
                    "image_id" => intval($bodyParams['file']),
                    "user_id" => $bodyParams['userId']
                ]
            );
    
            return $response->withStatus(302)->withHeader('Location', '/posts');
        } else {
            throw new \Exception("Invalid post fields." . $validator->getErrors());
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        $this->container['db']->table('posts')->delete($args['id']);

        return $response->withStatus(302)->withHeader('Location', '/posts');
    }
}

