<?php

namespace Views\News;

use Models\ResponseModel;
use Rendering\Views\View;

class NewsView extends View
{

    /** @var NewsViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new NewsViewModel($this->req->getRequestedPath($this->env));
    }

    public function getModel(): ResponseModel
    {
        return $this->model;
    }

    function getTemplate(): string
    {
        return '@pages/news';
    }
}
