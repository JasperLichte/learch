<?php

namespace Actions\Strava;

use Api\Action;
use Config\EnvNotSetException;
use External\Strava\NoAccesTokenException;
use External\Strava\StravaApi;
use Util\Url;

class StravaRedirectAction extends Action
{

    public function run(): void
    {
        if (!$this->req->issetGet('code')) {
            $this->res->setStatus(400);
            return;
        }

        try {
            $accessToken = StravaApi::getAccessToken($this->env, $this->req->getGet('code'));
        } catch (EnvNotSetException|NoAccesTokenException $e) {
            $this->res->setStatus(500);
            return;
        }

        $this->req->setSessionValue('access_token', $accessToken);

        try {
            $this->req->redirectTo(Url::to('/'));
        } catch (EnvNotSetException $e) {
            $this->res->setStatus(500);
        }
    }

}
