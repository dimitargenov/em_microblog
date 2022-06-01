<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer option 1
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // view rendere option 2
    $container['view'] = function ($container) {
        $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
            'cache' => $container->settings['views']['cache']
        ]);

        $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

        return $view;
    };

    // validator
    $container['validator'] = function ($container) { return new Awurth\SlimValidation\Validator; };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
};
