<?php

require_once 'vendor/autoload.php';

use Rendering\Renderer;
use Request\Request;
use Routing\MatchedNotAMiddlewareException;
use Routing\NoRouteMatchedException;
use Routing\Router;

try {
    $middleWare = (new Router())
        ->group('/', function (Router $router) {
            return $router
                ->get('/', \Views\HomeView::class);
        })
        ->group('/api', function (Router $router) {
            return $router
                ->group('/strava', function (Router $router) {
                    return $router
                        ->get('/', \Actions\GetStravaDataAction::class);
                });
        })
        ->match(Request::fromGlobals());
} catch (NoRouteMatchedException|MatchedNotAMiddlewareException $e) {
    $middleWare = new \Views\Err404View();
}

$middleWare->run();

echo Renderer::byMiddleware($middleWare)->render();
