<?php

namespace External\HackerNews;

use External\HackerNews\Models\StoryModel;
use External\HttpRequest;
use Util\Url;

class HackerNewsApi
{

    private const BASE_URL = 'https://hacker-news.firebaseio.com/v0';

    /** @var HttpRequest */
    private $httpRequest;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
    }

    /**
     * @param int $count
     * @return StoryModel[]
     */
    public function getTopStories(int $count): array
    {
        $result = $this->httpRequest->setUrl(new Url(self::BASE_URL . '/beststories.json'))->run();
        if (!is_array($result) || !count($result)) {
            return [];
        }

        $ids = array_slice($result, 0, $count);
        $stories = array_map(function ($id) {return $this->getStoryDetails($id);}, $ids);

        return array_filter($stories, function (StoryModel $story) {
            return !empty($story->url);
        });
    }

    private function getStoryDetails(int $id): StoryModel
    {
        $result = $this->httpRequest->setUrl(new Url(self::BASE_URL . '/item/' . $id . '.json'))->run();

        $model = new StoryModel();

        $model->id = $result['id'] ?? 0;
        $model->author = $result['author'] ?? '';
        $model->score = $result['score'] ?? 0;
        $model->title = $result['title'] ?? '';
        $model->url = $result['url'] ?? '';

        return $model;
    }

}
