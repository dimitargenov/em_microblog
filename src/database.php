<?php

use Illuminate\Database\Capsule\Manager;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $manager = new Manager;
    $manager->addConnection(array_merge($container->get('settings')['db'],[
        'charset'   =>  'utf8',
        'collation' =>  'utf8_unicode_ci'
    ]));

    $manager->bootEloquent();
    $manager->setAsGlobal();
    $container['db'] = $manager;
};
