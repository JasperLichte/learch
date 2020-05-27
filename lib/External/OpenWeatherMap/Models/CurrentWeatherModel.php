<?php

namespace External\OpenWeatherMap\Models;

class CurrentWeatherModel
{

    public $temp = 0;
    public $feelsLikeTemp = 0;
    public $pressure = 0;
    public $humidity = 0;
    public $clouds = 0;
    public $uvIndex = 0;
    public $windSpeed = 0;
    public $windGust = 0;
    public $windDeg = 0;

    /** @var WeatherModel */
    public $weather = null;

    public function deserialize(array $input): CurrentWeatherModel
    {
        $model = new CurrentWeatherModel();
        $model->temp = $input['temp'] ?? 0;
        $model->feelsLikeTemp = $input['feels_like'] ?? 0;
        $model->pressure = $input['pressure'] ?? 0;
        $model->humidity = $input['humidity'] ?? 0;
        $model->clouds = $input['clouds'] ?? 0;
        $model->uvIndex = $input['uvi'] ?? 0;
        $model->windSpeed = $input['wind_speed'] ?? 0;
        $model->windGust = $input['wind_gust'] ?? 0;
        $model->windDeg = $input['wind_deg'] ?? 0;
        $model->weather = (new WeatherModel())->deserialize($input['weather'][0] ?? []);

        return $model;
    }

}
