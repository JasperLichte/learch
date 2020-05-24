<?php

namespace Database;

use PDO;

class Connection
{

    private $pdo;

    // @var Connection
    private static $instance = null;

    private function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . Credentials::DB_HOST . ';dbname=' . Credentials::DB_NAME,
            Credentials::DB_USER,
            Credentials::DB_PASSWORD
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    public function __invoke()
    {
        return $this->getPdo();
    }

}
