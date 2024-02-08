<?php
namespace App\Action;

use Algolia\AlgoliaSearch\SearchIndex;
use Medoo\Medoo;
use Monolog\Logger;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

final class Home
{
    private $logger;
    private $flash;
    private $view;
    private $medoo;
    private $algolia;

    public function __construct(Logger $logger, Messages $flash, Twig $view, Medoo $medoo = null, SearchIndex $algolia)
    {
        $this->logger = $logger;
        $this->flash  = $flash;
        $this->view   = $view;
        $this->medoo  = $medoo;
        $this->algolia = $algolia;
    }

    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        $this->logger->info("Home Action Invoked", $args);
        $referer = $this->flash->getMessage('referer')[0];
        /*
        
        $dataDb = $this->medoo->select('empresas', [
            'codigo_erp',
            'nombre'
        ], [
            'id' => 2
        ]);
        
        $results_array = $this->algolia->search("resma", [
            'attributesToRetrieve' => [
                'producto_id',
                'producto_nombre',
                'img'
            ],
            'hitsPerPage' => 50
        ]);
        
        

        echo "<pre>";
        // echo ($results_array['nbHits']).PHP_EOL;
        $producto_ids = array_column($results_array['hits'], 'producto_id');
        print_r($producto_ids);
        
        echo "</pre>";

        */
        
        

        $this->view->render($response, 'main.twig', ['referer' => $referer, 'dataDb' => $dataDb ]);
        return $response;
    }
}