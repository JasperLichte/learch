<?php

namespace Views\News;

use Config\EnvNotSetException;
use External\NewsApi\NewsApi;
use Models\ResponseModel;
use Rendering\Views\View;
use Util\Url;

class NewsView extends View
{

    /** @var NewsViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new NewsViewModel($this->req->getRequestedPath($this->env));
        $this->model->addCssFile(Url::to('/public/css/splendor.min.css'));

        try {
            $this->model->setNews((new NewsApi($this->env->get('NEWS_API_KEY')))->getNews());
        } catch (EnvNotSetException $e) {
        }
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
