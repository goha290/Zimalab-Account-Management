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

$accountObj = new AccountDetails("localhost", "root", "root", "accountmanagementdb");

// Проверка получения id из запроса GET
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $accountData = $accountObj->getAccountDetailsById($id);
} else {
    echo "ID parameter is missing in the request.";
}

$accountObj->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleChange.css">
    <title>Zimalab</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="registration.html">CUSTOMER REGISTRATION</a></li>
                <li><a href="list.php">LIST OF ACCOUNTS</a></li>
            </ul>
        </nav>
    </header>
    <div class="wrapper">
        <form action="save.php" method="post">
            <h1>UPDATE ACCOUNT DETAILS</h1>
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- передача id в скрытом поле -->
            <div class="input-box">
                <input type="text" name="firstName" id="firstName" placeholder="First name" value="<?php echo $accountData['firstName'] ?? ''; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="lastName" id="lastName" placeholder="Last name" value="<?php  echo $accountData['lastName'] ?? ''; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="email" id="email" placeholder="Email" value="<?php  echo $accountData['emailAddress'] ?? ''; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="companyName" id="companyName" placeholder="Company name" value="<?php echo $accountData['companyName'] ?? ''; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="position" id="position" placeholder="Position" value="<?php echo $accountData['position'] ?? ''; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="phone" id="phone" placeholder="Phone number" value="<?php  echo $accountData['phoneNumber'] ?? ''; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="secondPhone" id="secondPhone" placeholder="Second phone" value="<?php  echo $accountData['secondaryPhone'] ?? ''; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="alternatePhone" id="alternatePhone" placeholder="Alternate phone" value="<?php  echo $accountData['alternatePhone'] ?? ''; ?>">
            </div>
            <button type="submit" class="btn-save">Save</button>
        </form>
    </div>
</body>

</html>