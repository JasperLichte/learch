<?php

namespace External;

use Util\Url;

class HttpRequest
{

    /**
     * @var Url
     */
    private $url = null;

    /**
     * @var string
     */
    private $method = 'get';

    /**
     * @var array
     */
    private $body = [];

    /**
     * @var string[]
     */
    private $header = [];

    public function setUrl(Url $url): HttpRequest
    {
        $this->url = $url;
        return $this;
    }

    public function setMethod(string $method): HttpRequest
    {
        $this->method = strtolower($method);
        return $this;
    }

    public function setBody(array $body): HttpRequest
    {
        $this->body = $body;
        return $this;
    }

    public function addHeader(string $header): HttpRequest
    {
        $this->header[] = $header;
        return $this;
    }

    public function run(): ?array
    {
        $curl = curl_init();

        switch (strtolower($this->method)) {
            case 'get':
                curl_setopt($curl, CURLOPT_HTTPGET, 1);
                break;
            case 'post':
                curl_setopt($curl, CURLOPT_POST, 1);

                if (count($this->body)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $this->body);
                }
                break;
            case 'put':
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
        }

        if ($this->url !== null) {
            curl_setopt($curl, CURLOPT_URL, (string)$this->url);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);

        try {
            $json = json_decode($result, true);
            if (!empty($json)) {
                return $json;
            }
        } catch (\Exception $e) {
        }
        return null;
    }

}
