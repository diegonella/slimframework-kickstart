<?php
return [
    'settings' => [
        // Slim
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true, #(bool)getenv('DISPLAY_ERRORS', true),

        // Database
        'algolia' => [
            'enabled' => true,
            'index_name' => 'empresas_lyris',
            'api_id' => "XTOCDI8RMB",
            'api_key' => "dacd9d3de6ca303cdf0366297c24f582",
        ],

        // Database
        'db' => [
            'dsn'  => 'mysql:dbname=' . "empresas_20240208" . ';host=' . "localhost",
            'name' => "empresas_20240208",
            'host' => "localhost",
            'port' => "3306",
            'user' => "root",
            'pass' => "root",
            'opts' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        ],

        // Logging
        'logger' => [
            'name'  => 'App',
            'path'  => __DIR__ . '/../log/'.(new DateTimeImmutable("now", new DateTimeZone("America/Argentina/Buenos_Aires")))->format("Ymd").".log",
            'level' => (int)getenv('LOG_LEVEL','DEBUG'), // See Monolog\Logger constants
        ],

        // Twig
        'view' => [
            'templateDir' => __DIR__ . '/Template/',
            'twig' => [
                'htmlcompress' => true,
                'cache'       => __DIR__ . '/../cache/twig/',
                'debug'       => (bool)getenv('VIEW_DEBUG'),
                'auto_reload' => (bool)getenv('VIEW_AUTO_RELOAD'),
            ],
        ],
    ]
];