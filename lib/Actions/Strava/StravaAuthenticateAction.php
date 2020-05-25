<?php

namespace Actions\Strava;

use Api\Action;
use Config\EnvNotSetException;
use Util\Url;

class StravaAuthenticateAction extends Action
{

    public function run(): void
    {
        try {
            $url = (new Url('https://www.strava.com/oauth/authorize'))->addGetParams([
                'client_id' => $this->env->get('STRAVA_CLIENT_ID'),
                'redirect_uri' => (string)Url::to('/api/vendor/strava/redirect'),
                'response_type' => 'code',
                'scope' => 'read,activity:read_all',
            ]);

            $this->req->redirectTo($url);
        } catch (EnvNotSetException $e) {
            $this->res->setStatus(500);
        }
    }
}
