<?php
class AccountList
{
    private $conn;
    private $limit = 10;

    public function __construct($hostname, $username, $password, $database)
    {
        $this->conn = new mysqli($hostname, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAccounts($page)
    {
        $offset = ($page - 1) * $this->limit;
        $sql = "SELECT id, firstName, lastName, emailAddress, companyName, position, phoneNumber, secondaryPhone, alternatePhone FROM accounts LIMIT $offset, $this->limit";
        $result = $this->conn->query($sql);
        $output = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["firstName"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["lastName"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["emailAddress"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["companyName"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["position"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["phoneNumber"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["secondaryPhone"] . "</td>";
                $output .= "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["alternatePhone"] . "</td>";
                $output .= "<td><a href='accountDetailsForm.php?id=" . $row["id"] . "'>Change</a></td>";
                $output .= "<td><a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                $output .= "</tr>";
            }
        } else {
            $output = "0 results";
        }

        return $output;
    }

    public function getTotalPages()
    {
        $sql = "SELECT COUNT(id) FROM accounts";
        $result = $this->conn->query($sql);
        $row = $result->fetch_row();
        $total_records = $row[0];
        $total_pages = ceil($total_records / $this->limit);

        $pagination = "";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagination .= "<a href='list.php?page=" . $i . "'>" . $i . "</a> ";
        }

        return $pagination;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}