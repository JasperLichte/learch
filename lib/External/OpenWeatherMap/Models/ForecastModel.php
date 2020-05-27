<?php

namespace External\OpenWeatherMap\Models;

class ForecastModel
{

    /** @var CurrentWeatherModel */
    private $current;

    public function setCurrent(CurrentWeatherModel $current): ForecastModel
    {
        $this->current = $current;
        return $this;
    }

    public function getCurrent(): CurrentWeatherModel
    {
        return $this->current;
    }

}
