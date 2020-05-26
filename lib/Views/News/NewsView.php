<?php

namespace Views\News;

use External\HackerNews\HackerNewsApi;
use Models\ResponseModel;
use Rendering\Views\View;

class NewsView extends View
{

    /** @var NewsViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new NewsViewModel($this->req->getRequestedPath($this->env));
        $this->model->setHackerNewsModels(
            (new HackerNewsApi())->getTopStories($this->req->issetGet('count') ? (int)$this->req->getGet('count') : 25)
        );
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
