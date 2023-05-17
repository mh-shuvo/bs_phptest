<?php

namespace App;
use Dotenv\Dotenv;
class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];

        $this->conn = new \mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die($this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
