<?php

namespace Views\Briefing;

use Config\EnvNotSetException;
use External\NewsApi\NewsApi;
use Models\ResponseModel;
use Rendering\Views\View;
use Util\Url;

class BriefingView extends View
{

    /** @var BriefingViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new BriefingViewModel($this->req->getRequestedPath($this->env));
        try {
            $this->model->addCssFile(Url::to('/public/css/pages/briefing.css'));
        } catch (EnvNotSetException $e) {
        }

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
        return '@pages/briefing';
    }
}
