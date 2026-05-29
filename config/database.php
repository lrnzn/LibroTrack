<?php

class Database
{
    private string $host = "localhost";
    private string $username = "u367097290_db_librotrack";
    private string $password = "Librotrack213";
    private string $database = "u367097290_db_librotrack";

    public function connect(): mysqli
    {
        $conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}