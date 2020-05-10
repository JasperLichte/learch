<?php

namespace request;

class Request
{
    /** @var array */
    private $get;

    /** @var array */
    private $post;

    /** @var string[] */
    private $queryStringParams = [];

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function getAllPost(): array
    {
        return $this->post;
    }

    public function getAllGet(): array
    {
        return $this->get;
    }

    public function issetPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    public function issetGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    public function getPost(string $key): string
    {
        return $this->post[$key];
    }

    public function getGet(string $key): string
    {
        return $this->get[$key];
    }

    public function getQueryStringParams(): array
    {
        return $this->queryStringParams;
    }

    public function setQueryStringParams(array $queryStringParams): Request
    {
        $this->queryStringParams = $queryStringParams;
        return $this;
    }

}
