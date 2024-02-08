<?php

session_name("LYRISDIGITAL");
setlocale(LC_ALL, 'en_US.UTF8');
ini_set('date.timezone', 'America/Buenos_Aires');

ini_set('max_execution_time', 180);
ini_set('memory_limit', "512M");
ini_set('session.cookie_domain', '.lyrisdigital.com' );
session_set_cookie_params(0, '/', '.lyrisdigital.com');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL ^ E_DEPRECATED | E_WARNING);
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