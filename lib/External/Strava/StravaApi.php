<?php

namespace External\Strava;

use Config\Environment;
use Config\EnvNotSetException;
use External\HttpRequest;
use External\Strava\Models\ActivityModel;
use External\Strava\Models\AthleteModel;
use External\Strava\Models\AthleteStatsModel;

class StravaApi
{

    private const BASE_URL = 'https://www.strava.com/api/v3/';

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    public function __construct(string $accessToken)
    {
        $this->httpRequest = (new HttpRequest())->addHeader('Authorization: Bearer ' . $accessToken);
    }

    /**
     * @param Environment $env
     * @param string $code
     * @return string
     * @throws NoAccesTokenException
     * @throws EnvNotSetException
     */
    public static function getAccessToken(Environment $env, string $code): string
    {
        $url = 'https://www.strava.com/oauth/token' .
            '?client_id=' . $env->get('STRAVA_CLIENT_ID') .
            '&client_secret=' . $env->get('STRAVA_CLIENT_SECRET') .
            '&code=' . $code .
            '&grant_type=authorization_code';

        $result = (new HttpRequest())->setUrl($url)->setMethod('post')->run();

        if (!isset($result['access_token']) || empty($result['access_token'])) {
            throw new NoAccesTokenException();
        }
        return $result['access_token'];
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
        $model->activities = $this->getAthleteActivities();

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

    /**
     * @param int $id
     * @return ActivityModel[]
     */
    private function getAthleteActivities(): array
    {
        $apiRes = $this->httpRequest->setUrl(self::BASE_URL . 'athlete/activities/')->run();
        if (empty($apiRes) || !is_array($apiRes)) {
            return null;
        }

        $models = [];
        foreach ($apiRes as $activity) {
            $model = new ActivityModel();

            $model->id = $activity['id'] ?? 0;
            $model->name = $activity['name'] ?? '';
            $model->distance = $activity['distance'] ?? 0;
            $model->movingTime = $activity['moving_time'] ?? 0;
            $model->elapsedTime = $activity['elapsed_time'] ?? 0;
            $model->total_elevation_gain = $apiRes['total_elevation_gain'] ?? 0;

            $models[] = $model;
        }
        return $models;
    }

}
