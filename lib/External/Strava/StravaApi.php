<?php

namespace External\Strava;

use Config\Environment;
use External\HttpRequest;
use External\Strava\Models\AthleteModel;
use External\Strava\Models\AthleteStatsModel;

class StravaApi
{

    /**
     * @var Environment
     */
    private $env;

    private const BASE_URL = 'https://www.strava.com/api/v3/';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    /**
     * @param Environment $env
     * @throws \Config\EnvNotSetException
     */
    public function __construct(Environment $env)
    {
        $this->env = $env;
        $this->httpRequest = (new HttpRequest())->addHeader('Authorization: Bearer ' . $this->env->get('STRAVA_ACCESS_TOKEN'));
    }

    public function getAthlete(): ?AthleteModel
    {
        $apiRes = $this->httpRequest->setUrl(self::BASE_URL . 'athlete/')->run();
        if (empty($apiRes)) {
            return null;
        }

        $model = new AthleteModel();
        $model->id = (int)$apiRes['id'];
        $model->userName = $apiRes['username'];
        $model->firstName = $apiRes['firstname'];
        $model->lastName = $apiRes['lastname'];
        $model->city = $apiRes['city'];
        $model->state = $apiRes['state'];
        $model->country = $apiRes['country'];
        $model->profileImg = $apiRes['profile'];
        $model->stats = $this->getAthleteStats($model->id);

        return $model;
    }

    private function getAthleteStats(int $id): ?AthleteStatsModel
    {
        $apiRes = $this->httpRequest->setUrl(self::BASE_URL . 'athletes/' . $id . '/stats/')->run();
        if (empty($apiRes)) {
            return null;
        }

        $model = new AthleteStatsModel();

        $model->biggestRideDistance = $apiRes['biggest_ride_distance'];
        $model->biggestClimbElevationGain = $apiRes['biggest_climb_elevation_gain'];

        return $model;
    }

}
