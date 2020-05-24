<?php

namespace Request;

use Database\Connection;
use Models\ResponseModel;
use Rendering\Views\View;

abstract class AppContainer
{

    /** @var Request */
    protected $req;

    /** @var Connection */
    protected $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
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

    final public function isView()
    {
        return ($this instanceof View);
    }

}