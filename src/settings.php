<?php

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true',
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Log settings
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

        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => getenv(DB_NAME),
            'username'  => getenv(DB_USER),
            'password'  => getenv(DB_PASSWORD),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        "jwt" => [
            'secret' => getenv('JWT_SECRET')
        ]
    ],
];
