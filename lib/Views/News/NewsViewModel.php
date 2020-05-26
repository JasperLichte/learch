<?php

namespace Views\News;

use External\HackerNews\Models\StoryModel;
use Models\ViewModel;

class NewsViewModel extends ViewModel
{

    /**
     * @var StoryModel[]
     */
    private $hackerNewsModels = [];

    public function setHackerNewsModels(array $hackerNewsModels): NewsViewModel
    {
        $this->hackerNewsModels = $hackerNewsModels;
        return $this;
    }

    public function getHackerNewsModels(): array
    {
        return $this->hackerNewsModels;
    }

}
