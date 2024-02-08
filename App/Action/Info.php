<?php
namespace App\Action;

use Monolog\Logger;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

final class Info
{
    private $logger;
    private $flash;
    private $view;

    public function __construct(Logger $logger, Messages $flash, Twig $view)
    {
        $this->logger = $logger;
        $this->flash  = $flash;
        $this->view   = $view;
    }

    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        phpinfo();
        // $this->logger->info("Test Action Invoked", $args);
        // $referer = $this->flash->getMessage('referer')[0];
        // $this->view->render($response, 'test.twig', ['referer' => $referer]);
        return $response;
    }
}