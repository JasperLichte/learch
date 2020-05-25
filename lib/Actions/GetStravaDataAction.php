<?php

namespace Actions;

use Api\Action;
use Config\EnvNotSetException;
use External\Strava\StravaApi;

class GetStravaDataAction extends Action
{

    public function run(): void
    {
        try {
            $strava = new StravaApi($this->env);
        } catch (EnvNotSetException $e) {
            $this->res->setStatus(500);
            return;
        }

        $this->res->setData([
            'athlete' => $strava->getAthlete(),
        ]);
    }

}
