<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

(function (App $app) {
    $c = $app->getContainer();

    /**
     * Use Slim-Flash to store 'referer' in session
     */
    $app->add(function (Request $request, Response $response, callable $next) : Response
    {
        $response = $next($request, $response);
        if ($response->getStatusCode() == 200) {
            $this->get('flash')->addMessage('referer', $request->getUri());
        }
        return $response;
    });

    /**
     * Slim-CSRF for all pages. Names and values stored in Twig for easily adding to any view
     */
    $app->add(function (Request $request, Response $response, callable $next) : Response
    {
        $csrf     = $this->get('csrf');
        $nameKey  = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();
        $name     = $request->getAttribute($nameKey);
        $value    = $request->getAttribute($valueKey);

        $v = $this->get('view');
        $v->getEnvironment()->addGlobal("csrfNameKey", $nameKey);
        $v->getEnvironment()->addGlobal("csrfValueKey", $valueKey);
        $v->getEnvironment()->addGlobal("csrfName", $name);
        $v->getEnvironment()->addGlobal("csrfValue", $value);

        return $next($request, $response);
    });

    /**
     * Slim-CSRF check. If fails will use failure callable defined in dependencies
     */
    $app->add($c->get('csrf'));

    $app->add(function (Request $request, Response $response, callable $next) : Response
    {
        $f = $this->get('flash');
        $v = $this->get('view');
        $e = $v->getEnvironment();
        if ($errors = $f->getMessage('error')) {
            $e->addGlobal("errorMessages", $errors);
        }
        if ($success = $f->getMessage('success')) {
            $e->addGlobal("successMessages", $success);
        }

        return $next($request, $response);
    });
})($app);