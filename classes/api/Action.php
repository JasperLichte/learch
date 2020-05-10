<?php

namespace api;

use request\AppContainer;

abstract class Action extends AppContainer
{

    /** @var ApiResponse */
    protected $res;

    public function __construct()
    {
        parent::__construct();
        $this->res = new ApiResponse();
    }

    abstract public function run(): ApiResponse;

}
