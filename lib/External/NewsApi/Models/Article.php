<?php

namespace External\NewsApi\Models;

class Article
{

    /** @var string */
    private $author = '';

    /** @var string */
    private $title = '';

    /** @var string */
    private $description = '';

    /** @var string */
    private $url = '';

    /** @var string */
    private $urlToImage = '';

    /** @var string */
    private $content = '';


    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }

    public function setUrlToImage(string $urlToImage): void
    {
        $this->urlToImage = $urlToImage;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}
