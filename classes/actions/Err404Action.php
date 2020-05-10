<?php

namespace actions;

use api\Action;
use api\ApiResponse;

class Err404Action extends Action
{

    public function run(): ApiResponse
    {
        return $this->res->setMessage('Not found')->status(404);
    }

}