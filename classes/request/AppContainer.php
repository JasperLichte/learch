<?php

namespace request;

use api\Action;
use database\Connection;

abstract class AppContainer
{

    /** @var Request */
    protected $req;

    /** @var Connection */
    protected $db;

    public function __construct()
    {
        $this->req = new Request();
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

}
