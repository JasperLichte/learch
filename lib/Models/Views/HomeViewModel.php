<?php

namespace Models\Views;

use External\Strava\Models\AthleteModel;

class HomeViewModel extends ViewModel
{

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

}
