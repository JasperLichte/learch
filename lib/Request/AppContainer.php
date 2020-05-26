<?php

namespace Request;

use Config\Environment;
use Database\Connection;
use Models\ResponseModel;
use Rendering\Views\View;

abstract class AppContainer
{

    /** @var Request */
    protected $req;

    /** @var Connection */
    protected $db;

    /** @var Environment */
    protected $env;

    public function __construct()
    {
        $this->env = Environment::getInstance();
        $this->db = Connection::getInstance($this->env);
    }

    public function getReq(): Request
    {
        return $this->req;
    }

    public function setReq(Request $req)
    {
        $this->req = $req;
    }

    abstract public function getModel(): ResponseModel;

    abstract public function run(): void;

}