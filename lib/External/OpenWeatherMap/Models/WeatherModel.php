<?php

namespace External\OpenWeatherMap\Models;

class WeatherModel
{

    public $conditionId = 0;
    public $description = '';
    public $icon = '';

    public function deserialize(array $input): WeatherModel
    {
        $model = new WeatherModel();
        $model->conditionId = $input['id'] ?? 0;
        $model->description = $input['description'] ?? '';
        $model->icon = $input['icon'] ?? '';

        return $model;
    }

}
