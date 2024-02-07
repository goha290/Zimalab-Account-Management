<?php
// Подключение к БД
$conn = new mysqli("localhost", "root", "root", "accountmanagementdb");

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка получения id из запроса GET
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Запрос для получения данных об аккаунте по id
    $sql = "SELECT * FROM accounts WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $email = $row["emailAddress"];
        $companyName = $row["companyName"];
        $position = $row["position"];
        $phone = $row["phoneNumber"];
        $secondPhone = $row["secondaryPhone"];
        $alternatePhone = $row["alternatePhone"];
    } else {
        echo "0 results";
    }
} else {
    echo "ID parameter is missing in the request.";
}

$conn->close();
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
                <input type="text" name="firstName" id="firstName" placeholder="First name" value="<?php echo $firstName; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="lastName" id="lastName" placeholder="Last name" value="<?php echo $lastName; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-box">
                <input type="text" name="companyName" id="companyName" placeholder="Company name" value="<?php echo $companyName; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="position" id="position" placeholder="Position" value="<?php echo $position; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="phone" id="phone" placeholder="Phone number" value="<?php echo $phone; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="secondPhone" id="secondPhone" placeholder="Second phone" value="<?php echo $secondPhone; ?>">
            </div>
            <div class="input-box">
                <input type="text" name="alternatePhone" id="alternatePhone" placeholder="Alternate phone" value="<?php echo $alternatePhone; ?>">
            </div>
            <button type="submit" class="btn-save">Save</button>
        </form>
    </div>
</body>

</html>