<?php

class AccountDetails
{
    private $conn;

    public function __construct($hostname, $username, $password, $database)
    {
        $this->conn = new mysqli($hostname, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAccountDetailsById($id)
    {
        $sql = "SELECT * FROM accounts WHERE id = $id";
        $result = $this->conn->query($sql);

        $accountData = [];

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $accountData = $row;
        } else {
            echo "0 results";
        }

        return $accountData;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

?>