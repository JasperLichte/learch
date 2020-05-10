<?php

namespace actions;

use api\Action;
use api\ApiResponse;

class ParamTestAction extends Action
{

    public function run(): ApiResponse
    {
        return $this->res->withData([$this->req->getQueryStringParams()]);
    }
}
