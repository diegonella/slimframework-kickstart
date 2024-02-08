<?php
use App\Action;
use Slim\App;

(function (App $app) {
    $app->get('/', Action\Home::class)->setName('home');
    $app->get('/test', Action\Test::class)->setName('test');
    $app->get('/csrf', Action\Csrf::class)->setName('csrf');
    $app->post('/csrf', function (\Slim\Http\Request $req, \Slim\Http\Response $res) {
        $f = $this->get('flash');
        $f->addMessage('success', 'That went well!');
        return $res->withStatus(302)->withHeader('Location', $this->get('flash')->getMessage('referer')[0]);
    })->setName('csrfSubmit');
})($app);