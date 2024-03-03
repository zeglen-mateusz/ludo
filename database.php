<?php

require_once 'config.php';

class Database
{
    private $connection;

    public function __construct()
    {

        $config = new DatabaseConfig();
        $this->connection = new mysqli($config->hostname, $config->username, $config->password, $config->database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        $this->connection->close();
    }
}

?>