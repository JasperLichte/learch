<?php

namespace Util;

use Config\Environment;
use Config\EnvNotSetException;

class Url
{

    /** @var string */
    private $path = '';

    public function __construct(string $path = '')
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return Url::sanitize($this->path);
    }

    public function setPath(string $path): Url
    {
        $this->path = $path;

        return $this;
    }

    public function addGetParams(array $params): Url
    {
        $urlParts = parse_url($this->getPath());

        $oldParams = [];
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $oldParams);
        }

        $urlParts['query'] = http_build_query(array_merge($oldParams, $params));
        $this->setPath(http_build_url($urlParts));

        return $this;
    }

    public function prepend($path): Url
    {
        $this->setPath($path . $this->path);

        return $this;
    }

    public function append($path): Url
    {
        $this->setPath($this->getPath() . '/' . $path);

        return $this;
    }

    public static function sanitize(string $path): string
    {
        return filter_var($path, FILTER_VALIDATE_URL);
    }

    public function __toString()
    {
        return $this->getPath();
    }

    /**
     * @param string $path
     * @return Url
     * @throws EnvNotSetException
     */
    public static function to(string $path): Url
    {
        $env = Environment::getInstance();

        $url = new Url($path);
        $url->prepend($env->get('APP_URL'));
        return $url;
    }

}