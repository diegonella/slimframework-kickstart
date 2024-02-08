<?php

use Algolia\AlgoliaSearch\SearchClient;
use Algolia\AlgoliaSearch\SearchIndex;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Slim\App;
use Slim\Csrf\Guard;
use Slim\Flash\Messages as Flash;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;
use Slim\Views\TwigExtension as TwigExt;
use Interop\Container\ContainerInterface as c;
use Medoo\Medoo;

(function (App $app) {

    $c = $app->getContainer();

    /**
     * Cross Site Request Forgery Protection
     *
     * https://github.com/slimphp/Slim-Csrf
     *
     * @param Interop\Container\ContainerInterface $c
     * @return Slim\Csrf\Guard
     */
    $c['csrf'] = function (c $c) : Guard
    {
        $g = new Guard();
        $f = $c->get('flash');
        $g->setFailureCallable(function (Request $request, Response $response, callable $next) use ($f) {
            $f->addMessage('error', 'There was an error submitting your details. Please try again');
            $r = $f->getMessage('referer')[0] ?? '/';
            return $response->withStatus(302)->withHeader('Location', $r);
        });

        return $g;
    };

    /**
     * PDO Database Connection
     *
     * @param Interop\Container\ContainerInterface $c
     * @return PDO
     */
    $c['db'] = function (c $c)
    {
        $s = $c->get('settings')['db'];
        return new PDO($s['dsn'], $s['user'], $s['pass'], $s['opts']);
    };

    $c['medoo'] = function (c $c) : Medoo
    {
        $s = $c->get('settings')['db'];
        return new Medoo([
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'empresas_20240208',
            'username' => 'root',
            'password' => 'root'
        ]);
    };


    $c['algolia'] = function (c $c) : SearchIndex
    {
        $s = $c->get('settings')['algolia'];
        
        $s = [
            'enabled' => true,
            'index_name' => 'empresas_lyris',
            'api_id' => 'XTOCDI8RMB',
            'api_key' => 'dacd9d3de6ca303cdf0366297c24f582'
        ];

        // echo json_encode($s);
        // exit();

        if ($s['enabled'])
        {
            $algolia = SearchClient::create(
                $s['api_id'],
                $s['api_key']
            );

            $index = $algolia->initIndex($s['index_name']);
            $results_array = $index->search("resma", [
                'attributesToRetrieve' => [
                    'producto_id',
                    'producto_nombre',
                    'img'
                ],
                'hitsPerPage' => 50
            ]);

            echo "<pre><code>";
            print_r($results_array);
            
            echo "</pre></code>";
            exit();
            return $index;
        }

        return null;
    };

    /**
     * Flash Messaging
     *
     * https://github.com/slimphp/Slim-Flash
     *
     * @param Interop\Container\ContainerInterface $c
     * @return Slim\Flash\Messages
     */
    $c['flash'] = function (c $c) : Flash
    {
        return new Flash;
    };

    /**
     * Logger
     *
     * https://github.com/Seldaek/monolog
     *
     * @param Interop\Container\ContainerInterface $c
     * @return Monolog\Logger
     */
    $c['logger'] = function (c $c) : Logger
    {
        $s = $c->get('settings')['logger'];
        $l = new Logger($s['name']);
        $l->pushProcessor(new UidProcessor);
        $l->pushHandler(new StreamHandler($s['path'], $s['level']));
        return $l;
    };

    /**
     * Twig View
     *
     * https://github.com/slimphp/Twig-View
     *
     * @param Interop\Container\ContainerInterface $c
     * @return Slim\Views\Twig
     */
    $c['view'] = function (c $c) : View
    {
        $s = $c->get('settings')['view'];
        $v = new View($s['templateDir'], $s['twig']);
        $v->addExtension(new TwigExt($c->get('router'), $c->get('request')->getUri()));
        return $v;
    };

})($app);