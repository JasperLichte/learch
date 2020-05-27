<?php

namespace External\NewsApi;

use External\HttpRequest;
use External\NewsApi\Models\Article;
use External\NewsApi\Models\NewsModel;
use Util\Url;

class NewsApi
{

    /** @var string */
    private const BASE_URL = 'https://newsapi.org/v2';

    /** @var HttpRequest */
    private $httpRequest;

    /** @var string */
    private $country = 'de';

    public function __construct(string $apiKey)
    {
        $this->httpRequest = (new HttpRequest())->addHeader('Authorization: Bearer ' . $apiKey);
    }

    public function setCountry(string $country): NewsApi
    {
        $this->country = $country;
        return $this;
    }

    public function getNews(): NewsModel
    {
        $news = new NewsModel();
        $news->setGeneral($this->getCategory('general'));
        $news->setBusiness($this->getCategory('business'));
        $news->setEntertainment($this->getCategory('entertainment'));
        $news->setHealth($this->getCategory('health'));
        $news->setScience($this->getCategory('science'));
        $news->setScience($this->getCategory('science'));
        $news->setSports($this->getCategory('sports'));
        $news->setTechnology($this->getCategory('technology'));
        return $news;
    }

    /**
     * @param string $category
     * @return Article[]
     */
    private function getCategory(string $category): array
    {
        $result = $this->httpRequest
            ->setUrl(
                (new Url(self::BASE_URL . '/top-headlines'))
                    ->addGetParams([
                        'country' => $this->country,
                        'category' => $category,
                    ])
            )
            ->run();

        if (!isset($result['articles']) || !is_array($result['articles']) || !count($result['articles'])) {
            return [];
        }

        $articles = [];
        foreach ($result['articles'] as $article) {
            $model = new Article();
            $model->setUrl($article['url'] ?? '');
            $model->setAuthor($article['author'] ?? '');
            $model->setTitle($article['title'] ?? '');
            $model->setDescription($article['description'] ?? '');
            $model->setContent($article['content'] ?? '');
            $model->setUrl($article['url'] ?? '');
            $model->setUrlToImage($article['urlToImage'] ?? '');

            $articles[] = $model;
        }
        return $articles;
    }

}
