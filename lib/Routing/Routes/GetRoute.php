<?php

namespace Routing\Routes;

class GetRoute extends Route
{

    public function __construct(string $expression, string $action)
    {
        parent::__construct($expression, $action, 'get');
    }

}
