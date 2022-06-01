<?php

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true',

        'app' => [
            'name' => getenv('APP_NAME')
        ],

        'views' => [
            'cache' => getenv('VIEW_CACHE_DISABLED') === 'true' ? false : __DIR__ . '/../storage/views'
        ],

        'database' => [
            'host' => 'localhost',
            'dbname' => 'em_microblog',
            'user' => 'root',
            'pass' => '048780162dD?'
        ],

        "jwt" => [
            'secret' => getenv('JWT_SECRET')
        ]

    ],
    'determineRouteBeforeAppMiddleware' => true
];
