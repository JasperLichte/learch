<?php

namespace Api;

use Models\ResponseModel;
use Request\AppContainer;

abstract class Action extends AppContainer
{

    /** @var Response */
    protected $res;

    final public function __construct()
    {
        parent::__construct();
        $this->res = new Response();
    }

    public function getModel(): ResponseModel
    {
        return $this->res;
    }

}
