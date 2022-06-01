<?php


require __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register database
$database = require __DIR__ . '/../src/database.php';
$database($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app);



//require_once __DIR__ . '/../vendor/autoload.php';
//
//$config = include __DIR__ . '/config.php';
//$app = new Slim\App($config);
//$container = $app->getContainer();
//
//require_once __DIR__ . '/dependencies.php';
//require_once __DIR__ . '/database.php';
//
//require_once __DIR__ . '/../routes/web.php';
