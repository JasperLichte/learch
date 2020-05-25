<?php

namespace Rendering;

use Request\AppContainer;

abstract class Renderer
{

    /**
     * @var AppContainer
     */
    protected $middleware;

    public static function byMiddleware(AppContainer $middleware): Renderer
    {
        if ($middleware->isView()) {
            return new ViewRenderer($middleware);
        }
        return new ActionRenderer($middleware);
    }

    protected function __construct(AppContainer $middleware)
    {
        $this->middleware = $middleware;
    }

    abstract public function render(): string;

}
