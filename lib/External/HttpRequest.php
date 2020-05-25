<?php

namespace External;

class HttpRequest
{

    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $method = 'post';

    /**
     * @var array
     */
    private $body = null;

    /**
     * @var string[]
     */
    private $header = [];

    public function setUrl(string $url): HttpRequest
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
            case 'post':
                curl_setopt($curl, CURLOPT_POST, 1);

                if (!empty($this->body)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $this->body);
                }
                break;
            case 'put':
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
        }

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        curl_close($curl);

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
