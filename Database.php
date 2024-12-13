<?php
class Database
{
    private $host = "localhost";
    private $db_name = "lab5b";
    private $username = "root";
    private $password = "";
    public $conn;

    //database connection
    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check connection ,kalau success atau x keluar memo
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // echo "Connected successfully";
        }

        return $this->conn;
    }
}
