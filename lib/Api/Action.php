<?php

namespace Api;

use Config\EnvNotSetException;
use Models\ResponseModel;
use Request\AppContainer;
use Util\Url;

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

    final public function redirectIfExpected(): void
    {
        if (!$this->req->issetGet('next')) {
            return;
        }
        try {
            $this->req->redirectTo(Url::to($this->req->getGet('next')));
        } catch (EnvNotSetException $e) {
        }
    }

}
