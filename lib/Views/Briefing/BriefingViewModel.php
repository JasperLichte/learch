<?php

namespace Views\Briefing;

use DateTime;
use External\HackerNews\Models\StoryModel;
use External\NewsApi\Models\NewsModel;
use External\OpenWeatherMap\Models\ForecastModel;
use Models\ViewModel;

class BriefingViewModel extends ViewModel
{

    /** @var \DateTime */
    private $date;

    /** @var NewsModel */
    private $news;

    /** @var ForecastModel */
    private $forecast;

    public function __construct(string $path)
    {
        parent::__construct($path);

        $this->date = new DateTime();
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getNews(): NewsModel
    {
        return $this->news;
    }

    public function setNews(NewsModel $news): void
    {
        $this->news = $news;
    }

    public function getForecast(): ForecastModel
    {
        return $this->forecast;
    }

    public function setForecast(ForecastModel $forecast): void
    {
        $this->forecast = $forecast;
    }

}
