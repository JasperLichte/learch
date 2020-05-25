<?php

namespace Database;

use Config\Environment;
use PDO;

class Connection
{

    private $pdo;

    // @var Connection
    private static $instance = null;

    private function __construct(Environment $env)
    {
        $this->pdo = new PDO(
            'mysql:host=' . $env->get('DB_HOST') . ';dbname=' . $env->get('DB_NAME'),
            $env->get('DB_USER'),
            $env->get('DB_PASSWORD')
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public static function getInstance(Environment $env)
    {
        if (self::$instance == null) {
            self::$instance = new Connection($env);
        }

        return self::$instance;
    }

    public function __invoke()
    {
        return $this->getPdo();
    }

}
