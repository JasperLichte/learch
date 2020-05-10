<?php

namespace api;

use Exception;

class ApiResponse
{

    /** @var int */
    private $statusCode = 200;

    /** @var string */
    private $message = '';

    /** @var array */
    private $data = [];

    public function setMessage(string $message): ApiResponse
    {
        $this->message = $message;

        return $this;
    }

    public function status(int $statusCode): ApiResponse
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withData(array $data): ApiResponse
    {
        $this->data = (array)$data;

        return $this;
    }

    public function exception(Exception $e): ApiResponse
    {
        $this->setMessage($e->getMessage())->status(500);

        return $this;
    }

    public function __toString(): string
    {
        $retVals = [
            'status' => $this->statusCode,
        ];
        if (!empty($this->message)) {
            $retVals['message'] = $this->message;
        }
        if (!empty($this->data)) {
            $retVals['data'] = $this->data;
        }

        header('Content-Type: application/json');
        http_response_code($this->statusCode);
        return json_encode($retVals);
    }

}
