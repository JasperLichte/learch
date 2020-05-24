<?php

namespace Routing\Routes;

class PostRoute extends Route
{

    public function __construct(string $expression, string $action)
    {
        parent::__construct($expression, $action, 'post');
    }

}
