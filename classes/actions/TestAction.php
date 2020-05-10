<?php

namespace actions;

use api\Action;
use api\ApiResponse;

class TestAction extends Action
{

    public function run(): ApiResponse
    {
        echo 'ss';
        return $this->res->setMessage('test');
    }

}
