<?php

namespace Request;

use Config\Environment;
use Config\EnvNotSetException;

class Request
{
    /** @var array */
    private $get = [];

    /** @var array */
    private $post = [];

    /** @var array */
    private $server = [];

    /** @var array */
    private $session = [];

    /** @var string[] */
    private $queryStringParams = [];

    private function __construct()
    {}

    public static function fromGlobals(): Request
    {
        return (new Request())
            ->setGet($_GET)
            ->setPost($_POST)
            ->setServer($_SERVER)
            ->setSession($_SESSION);
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

    private function setSession(array $session): Request
    {
        $this->session = $session;
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

    public function getAllSession(): array
    {
        return $this->session;
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

    public function issetSession(string $key): bool
    {
        return isset($this->session[$key]);
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

    public function getSession(string $key): string
    {
        return $this->session[$key];
    }

    public function setSessionValue(string $key, $value): Request
    {
        $this->session[$key] = $value;
        $_SESSION[$key] = $value;

        return $this;
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

    public function getRequestedPath(Environment $env): string
    {
        $requestedUrl = $this->getRequestedUrl();

        try {
            $appUrl = $env->get('APP_URL');
            $pos = strpos($requestedUrl, $appUrl);
            if ($pos !== false) {
                return substr_replace($requestedUrl, '', $pos, strlen($appUrl));
            }
        } catch (EnvNotSetException $e) {}
        return '';
    }

    public function getRequestedUrl(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public function getRequestMethod(): string
    {
        return $this->getServer('REQUEST_METHOD');
    }

    public function redirectTo(string $url)
    {
        header('Location: ' . $url);
        exit();
    }

}