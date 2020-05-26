<?php

namespace Routing;

use Closure;
use Config\Environment;
use Request\AppContainer;
use Request\Request;
use Routing\Routes\GetRoute;
use Routing\Routes\Route;
use Routing\Routes\PostRoute;
use Util\Url;

class Router
{

    /** @var Route[] */
    private $routes = [];

    /** @var string[] */
    private $matches = [];

    public function get(string $expression, string $middlewareName): Router
    {
        $this->routes[] = new GetRoute($expression, $middlewareName);
        return $this;
    }

    public function view(string $expression, string $middlewareName): Router
    {
        $this->routes[] = new GetRoute($expression, $middlewareName);
        return $this;
    }

    public function post(string $expression, string $middlewareName): Router
    {
        $this->routes[] = new PostRoute($expression, $middlewareName);
        return $this;
    }

    public function group(string $expression, Closure $callback): Router
    {
        $groupRouter = $callback(new Router());
        if (!($groupRouter instanceof Router)) {
            return $this;
        }

        foreach ($groupRouter->getRoutes() as $route) {
            $route->setExpression($expression . $route->getExpression());
            $this->routes[] = $route;
        }

        return $this;
    }

    /**
     * @param Request $request
     * @return AppContainer
     * @throws MatchedNotAMiddlewareException
     * @throws NoRouteMatchedException
     */
    public function match(Request $request)
    {
        $actionName = $this->actionNameByPath(
            $request->getRequestedPath(Environment::getInstance()),
            $request->getRequestMethod()
        );
        $action = new $actionName;

        if (!($action instanceof AppContainer)) {
            throw new MatchedNotAMiddlewareException();
        }

        $action->setReq($request->setQueryStringParams($this->matches));
        return $action;
    }

    /**
     * @param string $path
     * @param string $method
     * @return string
     * @throws NoRouteMatchedException
     */
    private function actionNameByPath(string $path, string $method): string
    {
        foreach ($this->routes as $route) {
            $route->setExpression('^' . $route->getExpression() . '$');

            if (preg_match('#' . $route->getExpression() . '#', $path, $matches)
                && strtolower($method) == strtolower($route->getMethod())
            ) {
                array_shift($matches); // first element contains the whole string
                $this->matches = $matches;

                return $route->getMiddlewareName();
            }
        }

        throw new NoRouteMatchedException();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

}
