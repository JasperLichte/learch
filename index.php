<?php

require_once 'vendor/autoload.php';

use Rendering\Renderer;
use Request\Request;
use Routing\MatchedNotAMiddlewareException;
use Routing\NoRouteMatchedException;
use Routing\Router;

try {
    $middleWare = (new Router())
        ->get('/', \Views\HelloWorldView::class)
        ->group('/api', function (Router $router) {
            return $router
                ->get('/1', \Actions\HelloWorldAction::class)
                ->get('/huhu', \Views\HelloWorldView::class);
        })
        ->match(Request::fromGlobals());
} catch (NoRouteMatchedException|MatchedNotAMiddlewareException $e) {
    $middleWare = new \Views\Err404View();
}

$middleWare->run();

echo Renderer::byMiddleware($middleWare)->render();
