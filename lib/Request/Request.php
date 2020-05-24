<?php

namespace Request;

class Request
{
    /** @var array */
    private $get = [];

    /** @var array */
    private $post = [];

    /** @var array */
    private $server = [];

    /** @var string[] */
    private $queryStringParams = [];

    private function __construct()
    {}

    public static function fromGlobals(): Request
    {
        return (new Request())
            ->setGet($_GET)
            ->setPost($_POST)
            ->setServer($_SERVER);
    }

    private function setPost(array $post): Request
    {
        $this->post = $post;
        return $this;
    }

    private function setGet(array $get): Request
    {
        $this->get = $get;
        return $this;
    }

    private function setServer(array $server): Request
    {
        $this->server = $server;
        return $this;
    }

    public function getAllPost(): array
    {
        return $this->post;
    }

    public function getAllGet(): array
    {
        return $this->get;
    }

    public function getAllServer(): array
    {
        return $this->server;
    }

    public function issetPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    public function issetGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    public function issetServer(string $key): bool
    {
        return isset($this->server[$key]);
    }

    public function getPost(string $key): string
    {
        return $this->post[$key];
    }

    public function getGet(string $key): string
    {
        return $this->get[$key];
    }

    public function getServer(string $key): string
    {
        return $this->server[$key];
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

    public function getRequestedPath(): string
    {
        $parsedUrl = parse_url($this->getServer('REQUEST_URI'));
        return (isset($parsedUrl['path']) ? $parsedUrl['path'] : '/');
    }

    public function getRequestMethod(): string
    {
        return $this->getServer('REQUEST_METHOD');
    }

}