<?php

namespace routes;

use api\Action;

class Route
{

    /** @var string */
    private $expression;

    /** @var string */
    private $action;

    /** @var string */
    private $method;

    public function __construct(string $expression, string $action, string $method)
    {
        $this->expression = $expression;
        $this->action = $action;
        $this->method = $method;
    }

    public function getExpression(): string
    {
        return $this->expression;
    }

    public function setExpression(string $expression)
    {
        $this->expression = $expression;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

}
