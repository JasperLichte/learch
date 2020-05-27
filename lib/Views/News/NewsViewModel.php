<?php

namespace Views\News;

use DateTime;
use External\HackerNews\Models\StoryModel;
use External\NewsApi\Models\NewsModel;
use Models\ViewModel;

class NewsViewModel extends ViewModel
{

    /** @var \DateTime */
    private $date;

    /** @var NewsModel */
    private $news;

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

}
