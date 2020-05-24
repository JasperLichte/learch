<?php

namespace Api;

use Exception;
use Models\ResponseModel;

class Response extends ResponseModel
{

    /** @var int */
    private $statusCode = 200;

    /** @var string */
    private $message = '';

    /** @var array */
    private $data = [];

    public function setMessage(string $message): Response
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setStatus(int $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->statusCode;
    }

    public function setData(array $data): Response
    {
        $this->data = (array)$data;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function exception(Exception $e): Response
    {
        $this->setMessage($e->getMessage())->setStatus(500);

        return $this;
    }

}
