<?php

namespace Views;

use Models\ResponseModel;
use Models\Views\ViewModel;
use Rendering\Views\View;

class Err404View extends View
{

    public function getModel(): ResponseModel
    {
        return new ViewModel($this->req->getRequestedPath($this->env));
    }

    function getTemplate(): string
    {
        return '@pages/errors/404';
    }
}
