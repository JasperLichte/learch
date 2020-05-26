<?php

namespace Views\Home;

use Files\BasicFileModel;
use Models\ResponseModel;
use Rendering\Views\View;

class HomeView extends View
{

    /** @var HomeViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new HomeViewModel($this->req->getRequestedPath($this->env));
        $this->model->setFiles(BasicFileModel::loadAll($this->db));
    }

    public function getModel(): ResponseModel
    {
        return $this->model;
    }

    function getTemplate(): string
    {
        return '@pages/home';
    }

}
