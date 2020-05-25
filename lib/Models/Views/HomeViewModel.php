<?php

namespace Models\Views;

use External\Strava\Models\AthleteModel;

class HomeViewModel extends ViewModel
{

    /** @var bool */
    private $stravaIsAuthenticated = false;

    /** @var AthleteModel|null */
    private $stravaAthlete = null;

    public function setStravaAthlete(AthleteModel $stravaAthlete): HomeViewModel
    {
        $this->stravaAthlete = $stravaAthlete;
        return $this;
    }

    public function getStravaAthlete(): AthleteModel
    {
        return $this->stravaAthlete;
    }

    public function setStravaIsAuthenticated(bool $stravaIsAuthenticated): HomeViewModel
    {
        $this->stravaIsAuthenticated = $stravaIsAuthenticated;
        return $this;
    }

    public function isStravaIsAuthenticated(): bool
    {
        return $this->stravaIsAuthenticated;
    }

}
