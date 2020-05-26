<?php

namespace Views\Strava;

use External\Strava\Models\AthleteModel;
use Models\ViewModel;

class StravaViewModel extends ViewModel
{

    /** @var bool */
    private $stravaIsAuthenticated = false;

    /** @var AthleteModel|null */
    private $stravaAthlete = null;

    public function setStravaAthlete(AthleteModel $stravaAthlete): StravaViewModel
    {
        $this->stravaAthlete = $stravaAthlete;
        return $this;
    }

    public function getStravaAthlete(): AthleteModel
    {
        return $this->stravaAthlete;
    }

    public function setStravaIsAuthenticated(bool $stravaIsAuthenticated): StravaViewModel
    {
        $this->stravaIsAuthenticated = $stravaIsAuthenticated;
        return $this;
    }

    public function isStravaIsAuthenticated(): bool
    {
        return $this->stravaIsAuthenticated;
    }

}
