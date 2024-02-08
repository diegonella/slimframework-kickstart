<?php


use App\Action;
use Interop\Container\ContainerInterface as c;
use Slim\App;

(function (App $app) {
    $c = $app->getContainer();

    $c[Action\Home::class] = function (c $c) {
        return new Action\Home($c->get('logger'), $c->get('flash'), $c->get('view'), $c->get('medoo'), $c->get('algolia'));
    };

    $c[Action\Test::class] = function (c $c) {
        return new Action\Test($c->get('logger'), $c->get('flash'), $c->get('view'), $c->get('medoo'));
    };

    $c[Action\Info::class] = function (c $c) {
        return new Action\Info($c->get('logger'), $c->get('flash'), $c->get('view'), $c->get('medoo'));
    };

    $c[Action\Csrf::class] = function (c $c) {
        return new Action\Csrf($c->get('logger'), $c->get('flash'), $c->get('view'), $c->get('medoo'));
    };
})($app);