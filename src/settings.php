<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'views' => [
            'cache' => getenv('VIEW_CACHE_DISABLED') === 'true' ? false : __DIR__ . '/../storage/views'
        ],

        'app' => [
            'name' => getenv('APP_NAME')
        ],

        'database' => [
            'host' => 'localhost',
            'dbname' => 'em_microblog',
            'user' => 'root',
            'pass' => '048780162dD?'
        ],

        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => getenv(DB_NAME),
            'username'  => getenv(DB_USER),
            'password'  => getenv(DB_PASSWORD),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];
