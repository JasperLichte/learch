<?php

namespace Routing\Routes;

abstract class Route
{

    /** @var string */
    protected $expression;

    /** @var string */
    protected $middlewareName;

    /** @var string */
    protected $method;

    protected function __construct(string $expression, string $action, string $method)
    {
        $this->expression = str_replace('//', '/', $expression);
        if($this->expression !== '/' && substr($this->expression, -1) == '/') {
            $this->expression = substr($this->expression, 0, -1);
        }

        $this->middlewareName = $action;
        $this->method = $method;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function setExpression(string $expression): Route
    {
        $this->expression = $expression;
        return $this;
    }

    public function getMiddlewareName(): string
    {
        return $this->middlewareName;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

}
