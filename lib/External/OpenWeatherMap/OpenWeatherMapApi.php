<?php

namespace External\OpenWeatherMap;

use External\HttpRequest;
use Util\Url;

class OpenWeatherMapApi
{

    /** @var string */
    private const BASE_URL = 'https://api.openweathermap.org/data/2.5';

    /** @var HttpRequest */
    private $httpRequest;

    /** @var array */
    private $getParams = [];

    /** @var float */
    private $lon = 0;

    /** @var float */
    private $lat = 0;

    public function __construct(string $apiKey)
    {
        $this->httpRequest = new HttpRequest();
        $this->getParams = ['appid' => $apiKey,];
    }

    public function setLon(float $lon): OpenWeatherMapApi
    {
        $this->lon = $lon;
        return $this;
    }

    public function setLat(float $lat): OpenWeatherMapApi
    {
        $this->lat = $lat;
        return $this;
    }

    public function getForecast()
    {
        $result = $this->httpRequest->setUrl(
            (new Url(self::BASE_URL . '/onecall'))->addGetParams(array_merge($this->getParams, [
                'lat' => $this->lat,
                'lon' => $this->lon,
            ]))
        )->run();
        //var_dump($result);exit();
    }

}
