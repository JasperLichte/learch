<?php

namespace Actions\Strava;

use Api\Action;
use Config\EnvNotSetException;
use External\Strava\NoAccesTokenException;
use External\Strava\StravaApi;

class StravaRedirectAction extends Action
{

    /** @var string */
    private $code;

    public function run(): void
    {
        if (!$this->req->issetGet('code')) {
            $this->res->setStatus(400);
            return;
        }

        $this->code = $this->req->getGet('code');

        try {
            $accessToken = StravaApi::getAccessToken($this->env, $this->code);
        } catch (EnvNotSetException|NoAccesTokenException $e) {
            $this->res->setStatus(500);
            return;
        }

        $this->req->setSessionValue('access_token', $accessToken);

        try {
            $this->req->redirectTo($this->env->get('APP_URL'));
        } catch (EnvNotSetException $e) {
            $this->res->setStatus(500);
        }
    }

}
