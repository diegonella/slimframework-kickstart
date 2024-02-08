<?php
namespace App\Action;

use Medoo\Medoo;
use Monolog\Logger;
use PDO;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

final class Info
{
    private $logger;
    private $flash;
    private $view;
    private $medoo;
    private $db;

    public function __construct(Logger $logger, Messages $flash, Twig $view, Medoo $medoo, PDO $db)
    {
        $this->logger = $logger;
        $this->flash  = $flash;
        $this->view   = $view;
        $this->medoo  = $medoo;
        $this->db     = $db;

    }

    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        $id = 4;
        $stmt = $this->db->prepare("SELECT 'codigo_erp', 'nombre' FROM empresas WHERE id=? LIMIT 1"); 
        $stmt->execute([$id]); 
        $row = $stmt->fetch();

        $dataDb = $this->medoo->select('empresas', [
            'codigo_erp',
            'nombre'
        ], [
            'id' => 2
        ]);

        phpinfo();
        // $this->logger->info("Test Action Invoked", $args);
        // $referer = $this->flash->getMessage('referer')[0];
        // $this->view->render($response, 'test.twig', ['referer' => $referer]);
        return $response;
    }
}