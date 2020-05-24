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
        ->view('/1', \Actions\HelloWorldAction::class)
        ->match(Request::fromGlobals());
} catch (NoRouteMatchedException|MatchedNotAMiddlewareException $e) {
    $middleWare = new \Views\Err404View();
}

$middleWare->run();

echo Renderer::byMiddleware($middleWare)->render();
