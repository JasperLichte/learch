<?php

namespace Request;

use Config\Environment;
use Config\EnvNotSetException;
use Util\Url;

class Request extends RequestBase
{

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
        $requestedUrl = strtok($requestedUrl, '?');

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

    public function redirectTo(Url $url)
    {
        header('Location: ' . $url);
        exit();
    }

}