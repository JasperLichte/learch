<?php

namespace Request;

abstract class RequestBase
{

    /** @var array */
    protected $get = [];

    /** @var array */
    protected $post = [];

    /** @var array */
    protected $server = [];

    /** @var array */
    protected $session = [];

    /** @var string[] */
    protected $queryStringParams = [];

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
}
