<?php

namespace Config;

use Dotenv\Dotenv;

class Environment
{

    /**
     * @var Environment
     */
    private static $instance = null;

    public static function getInstance(): Environment
    {
        if (self::$instance === null) {
            self::$instance = new Environment();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . './../..');
        $dotenv->load();
    }

    /**
     * @param string $key
     * @return string
     * @throws EnvNotSetException
     */
    public function get(string $key): string
    {
        if (isset($_ENV[$key])) {
            return (string)$_ENV[$key];
        }

        throw new EnvNotSetException($key);
    }

}
