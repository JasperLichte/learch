<?php

session_start();

require_once 'base.php';

use Rendering\Renderer;
use Request\Request;
use Routing\MatchedNotAMiddlewareException;
use Routing\NoRouteMatchedException;
use Routing\Router;

try {
    $middleWare = (new Router())
        ->get('/', \Views\Home\HomeView::class)
        ->get('/news', \Views\News\NewsView::class)
        ->get('/strava', \Views\Strava\StravaView::class)
        ->group('/api', function (Router $router) {
            return $router
                ->group('/v1', function (Router $router) {
                    return $router
                        ->group('/view', function (Router $router) {
                            return $router
                                ->get('/create-pdf', \Actions\Views\CreatePdfAction::class);
                        })
                        ->group('/strava', function (Router $router) {
                            return $router
                                ->get('/authenticate', \Actions\Strava\StravaAuthenticateAction::class)
                                ->get('/redirect', \Actions\Strava\StravaRedirectAction::class);
                        })
                        ->group('/google', function (Router $router) {
                            return $router;
                        });
                });
        })
        ->group('/file', function (Router $router) {
            return $router
                ->get('/([0-9]*)', \Actions\Files\ShowFileAction::class);
        })
        ->match(Request::fromGlobals());
} catch (NoRouteMatchedException|MatchedNotAMiddlewareException $e) {
    $middleWare = new \Views\Err404View();
}

$middleWare->run();

echo Renderer::byMiddleware($middleWare)->render();
