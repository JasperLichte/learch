<?php

namespace Actions;

use Api\Action;

class HelloWorldAction extends Action
{

    public function run(): void
    {
        $this->res->setMessage('Hello world!');
    }

}
