<?php

namespace Views;

use External\Strava\StravaApi;
use Models\ResponseModel;
use Models\Views\HomeViewModel;
use Rendering\Views\View;

class HomeView extends View
{

    /** @var HomeViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new HomeViewModel($this->req->getRequestedPath($this->env));

        $this->model->setStravaIsAuthenticated($this->req->issetSession('access_token'));
        $this->model->setTitle('Start');

        if ($this->model->isStravaIsAuthenticated()) {
            $strava = new StravaApi($this->req->getSession('access_token'));
            $this->model->setStravaAthlete($strava->getAthlete());
        }
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
