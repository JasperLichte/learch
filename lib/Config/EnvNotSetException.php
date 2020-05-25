<?php

namespace Config;

use Throwable;

class EnvNotSetException extends \Exception
{

    public function __construct(string $envKey)
    {
        parent::__construct($envKey . ' not set');
    }

}
