<?php

namespace Views;

use Config\EnvNotSetException;
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
        if (!$this->req->issetSession('access_token')) {
            $this->authWithStrava();
        }
        $this->model = new HomeViewModel($this->req->getRequestedPath($this->env));
        $this->model->setTitle('Start');

        $strava = new StravaApi($this->req->getSession('access_token'));
        $this->model->setStravaAthlete($strava->getAthlete());
    }

    public function getModel(): ResponseModel
    {
        return $this->model;
    }

    function getTemplate(): string
    {
        return '@pages/home';
    }

    private function authWithStrava()
    {
        try {
            $url = 'https://www.strava.com/oauth/authorize' .
                '?client_id=' . $this->env->get('STRAVA_CLIENT_ID') .
                '&redirect_uri=' . $this->env->get('APP_URL') . '/api/vendor/strava/redirect' .
                '&response_type=code' .
                '&scope=read,activity:read_all';

            $this->req->redirectTo($url);
        } catch (EnvNotSetException $e) {}
    }

}
