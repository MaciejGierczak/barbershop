<?php
class Database
{
    private $dbserver = "localhost";
    private $dblogin = "root";
    private $dbname = "barber";
    private $dbpass = '';

    public function __construct()
    {
    }

    function insert($sql)
    {
        $conn = new mysqli($this->dbserver, $this->dblogin, $this->dbpass, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            return true;

        } else {
            $conn->close();
            return $conn->error;

        }
    }

    function Select($sql)
    {
        $conn = new mysqli($this->dbserver, $this->dblogin, $this->dbpass, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            $conn->close();
            return 0;
        }

    }

    function Update($sql)
    {$conn = new mysqli($this->dbserver, $this->dblogin, $this->dbpass, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($conn->query($sql) === TRUE) {
            $conn->close();
           return true;
        } else {
            $conn->close();
           return $conn->error;
        }



    }

}