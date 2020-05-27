<?php

namespace External\OpenWeatherMap;

use External\HttpRequest;
use External\OpenWeatherMap\Models\CurrentWeatherModel;
use External\OpenWeatherMap\Models\ForecastModel;
use Util\Url;

class OpenWeatherMapApi
{

    /** @var string */
    private const BASE_URL = 'https://api.openweathermap.org/data/2.5';

    /** @var HttpRequest */
    private $httpRequest;

    /** @var array */
    private $getParams = [];

    /** @var string */
    private $language = 'de';

    /** @var float */
    private $lon = 0;

    /** @var float */
    private $lat = 0;

    public function __construct(string $apiKey)
    {
        $this->httpRequest = new HttpRequest();
        $this->getParams = [
            'appid' => $apiKey,
            'units' => 'metric',
        ];
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

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getForecast(): ForecastModel
    {
        $result = $this->httpRequest->setUrl(
            (new Url(self::BASE_URL . '/onecall'))->addGetParams(array_merge($this->getParams, [
                'lat'  => $this->lat,
                'lon'  => $this->lon,
                'lang' => $this->language,
            ]))
        )->run();

        return (new ForecastModel())
            ->setCurrent((new CurrentWeatherModel())->deserialize($result['current'] ?? []));
    }

}
