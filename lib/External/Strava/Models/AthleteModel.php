<?php

namespace External\Strava\Models;

class AthleteModel
{

    public $id = 0;
    public $userName = '';
    public $firstName = '';
    public $lastName = '';
    public $city = '';
    public $state = '';
    public $country = '';
    public $profileImg = '';

    /** @var AthleteStatsModel */
    public $stats = null;

    /** @var ActivityModel[] */
    public $activities = [];

}
