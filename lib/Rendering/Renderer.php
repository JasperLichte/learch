<?php

namespace Rendering;

use Actions\Files\ShowFileAction;
use Rendering\Views\View;
use Request\AppContainer;

abstract class Renderer
{

    /**
     * @var AppContainer
     */
    protected $middleware;

    public static function byMiddleware(AppContainer $middleware): Renderer
    {
        if ($middleware instanceof View) {
            return new ViewRenderer($middleware);
        }
        if ($middleware instanceof ShowFileAction) {
            return new FileRenderer($middleware);
        }
        return new ActionRenderer($middleware);
    }

    protected function __construct(AppContainer $middleware)
    {
        $this->middleware = $middleware;
    }

    abstract public function render(): string;

}
