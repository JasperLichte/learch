<?php

namespace routes;

use actions\Err404Action;
use api\Action;
use request\AppContainer;
use views\View;

class Router
{

    /** @var Route[] */
    private $routes = [];

    /** @var string[] */
    private $matches = [];

    private function add($expression, string $actionClassName, string $method): Router
    {
        $this->routes[] = new Route($expression, $actionClassName, $method);

        return $this;
    }

    public function get($expression, string $actionClassName): Router
    {
        return $this->add($expression, $actionClassName, 'get');
    }

    public function post($expression, string $actionClassName): Router
    {
        return $this->add($expression, $actionClassName, 'post');
    }

    public function view($expression, string $actionClassName): Router
    {
        return $this->add($expression, $actionClassName, 'get');
    }

    public function run(): string
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = (isset($parsedUrl['path']) ? $parsedUrl['path'] : '/');
        $method = $_SERVER['REQUEST_METHOD'];

        $actionName = $this->actionNameByPath($path, $method);
        $action = ($actionName != null ? new $actionName : null);
        if ($action instanceof AppContainer) {
            $action->setReq($action->getReq()->setQueryStringParams($this->matches));

            if ($action instanceof Action) {
                return (string)$action->run();
            }
            if ($action instanceof View) {
                return $action->render();
            }
        }

        return (new Err404Action())->run();
    }

    private function actionNameByPath(string $path, string $method): ?string
    {
        foreach ($this->routes as $route) {
            $route->setExpression('^' . $route->getExpression() . '$');

            if (preg_match('#' . $route->getExpression() . '#', $path, $matches)
                && strtolower($method) == strtolower($route->getMethod())
            ) {
                array_shift($matches); // first element contains the whole string
                $this->matches = $matches;

                return $route->getAction();
            }
        }

        return null;
    }

}
