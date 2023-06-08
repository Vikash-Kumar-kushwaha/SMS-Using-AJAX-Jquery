<?php
// $conn = mysqli_connect("localhost", "root", "", "studentinfo");
// $conn1 = "";
// if (!$conn) {
//     die("connection failed: " . mysqli_connect_error());
// } else {
//     $conn1 = "Connected";
// }

class database
{
    private $host;
    private $dbuser;
    private $dbpassword;
    private $dbname;
    public $conn;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbuser = 'root';
        $this->dbpassword = '';
        $this->dbname = 'studentinfo';
        $this->conn = new mysqli($this->host, $this->dbuser, $this->dbpassword, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }

}


?>