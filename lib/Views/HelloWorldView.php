<?php

namespace Views;

use Models\ResponseModel;
use Models\ViewModel;
use Rendering\Views\View;

class HelloWorldView extends View
{

    public function getModel(): ResponseModel
    {
        return new ViewModel();
    }

    function getTemplate(): string
    {
        return '@pages/hello_world';
    }
}
