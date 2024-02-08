<?php
namespace App\Action;

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

    public function __construct(Logger $logger, Messages $flash, Twig $view, Medoo $medoo = null)
    {
        $this->logger = $logger;
        $this->flash  = $flash;
        $this->view   = $view;
        $this->medoo  = $medoo;
    }

    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        $this->logger->info("Home Action Invoked", $args);
        $referer = $this->flash->getMessage('referer')[0];

        
        $dataDb = $this->medoo->select('empresas', [
            'codigo_erp',
            'nombre'
        ], [
            'id' => 2
        ]);
        
        

        $this->view->render($response, 'main.twig', ['referer' => $referer, 'dataDb' => $dataDb ]);
        return $response;
    }
}