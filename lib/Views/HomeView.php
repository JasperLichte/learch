<?php

namespace Views;

use Models\ResponseModel;
use Models\ViewModel;
use Rendering\Views\View;

class HomeView extends View
{

    public function getModel(): ResponseModel
    {
        $model = new ViewModel();

        $model->setTitle('Home');

        return $model;
    }

    function getTemplate(): string
    {
        return '@pages/home';
    }
}
