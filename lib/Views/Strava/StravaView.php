<?php

namespace Views\Strava;

use External\Strava\StravaApi;
use Models\ResponseModel;
use Rendering\Views\View;

class StravaView extends View
{

    /** @var StravaViewModel */
    private $model;

    public function run(): void
    {
        $this->model = new StravaViewModel($this->req->getRequestedPath($this->env));

        $this->model->setStravaIsAuthenticated($this->req->issetSession('access_token'));
        $this->model->setTitle('Strava');

        if ($this->model->isStravaIsAuthenticated()) {
            $strava = new StravaApi($this->req->getSession('access_token'));
            $this->model->setStravaAthlete($strava->getAthlete());
            $this->model->setTitle($this->model->getStravaAthlete()->userName);
        }
    }

    public function getModel(): ResponseModel
    {
        return $this->model;
    }

    function getTemplate(): string
    {
        return '@pages/strava';
    }

}
