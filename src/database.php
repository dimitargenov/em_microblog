<?php

use Illuminate\Database\Capsule\Manager;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

//    $container['db'] = function ($c) {
//        $settings = $c->get('settings')['database'];
//        $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
//            $settings['user'], $settings['pass']);
//        var_dump($pdo->);
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//        return $pdo;
//    };

    $manager = new Manager;
    $manager->addConnection(array_merge($container->get('settings')['db'],[
        'charset'   =>  'utf8',
        'collation' =>  'utf8_unicode_ci'
    ]));

    $manager->bootEloquent();
    $manager->setAsGlobal();
    $container['db'] = $manager;
};
