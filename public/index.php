<?php
error_reporting(E_ALL ^ E_DEPRECATED);

(function(){
    require_once __DIR__ . '/../vendor/autoload.php';
    $src = __DIR__ . '/../App/';

    session_start();

    $app = new Slim\App(require_once $src . 'settings.php');

    require_once $src . 'dependencies.php';
    require_once $src . 'actions.php';
    require_once $src . 'middleware.php';
    require_once $src . 'routes.php';

    $app->run();
})();