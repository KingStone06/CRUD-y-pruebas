<?php

namespace App;

use mysqli;
use Exception;

class Database {
    private $connection;

    public function __construct($host, $user, $password, $database) {
        $this->connection = new mysqli($host, $user, $password, $database);

        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8");
    }

    public function getConnection() {
        return $this->connection;
    }
}
