<?php
return [
    'settings' => [
        // Slim
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => (bool)getenv('DISPLAY_ERRORS', true),

        // Database
        'db' => [
            'dsn'  => 'mysql:dbname=' . getenv('DB_NAME') . ';host=' . getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'opts' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        ],

        // Logging
        'logger' => [
            'name'  => 'App',
            'path'  => __DIR__ . '/../log/'.(new DateTimeImmutable("now", new DateTimeZone("America/Argentina/Buenos_Aires")))->format("Ymd").".log",
            'level' => (int)getenv('LOG_LEVEL'), // See Monolog\Logger constants
        ],

        // Twig
        'view' => [
            'templateDir' => __DIR__ . '/Template/',
            'twig' => [
                'cache'       => __DIR__ . '/../cache/twig/',
                'debug'       => (bool)getenv('VIEW_DEBUG'),
                'auto_reload' => (bool)getenv('VIEW_AUTO_RELOAD'),
            ],
        ],
    ]
];