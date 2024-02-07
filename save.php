<?php
// Подключение к БД и проверка подключения
$conn = new mysqli("localhost", "root", "root", "accountmanagementdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка, что форма была отправлена и данные были получены
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $companyName = $_POST["companyName"];
    $position = $_POST["position"];
    $phone = $_POST["phone"];
    $secondPhone = $_POST["secondPhone"];
    $alternatePhone = $_POST["alternatePhone"];

    // Обновление записи в БД
    $sql = "UPDATE accounts SET firstName='$firstName', lastName='$lastName', emailAddress='$email', companyName='$companyName', position='$position', phoneNumber='$phone', secondaryPhone='$secondPhone', alternatePhone='$alternatePhone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("The data has been successfully updated")</script>';
        echo '<script>window.location.href = "list.php";</script>';
    } else {
        echo '<script>alert("The data is incorrect")</script>';
        echo '<script>window.location.href = "list.php";</script>';
    }
}

// Получение id записи из запроса GET
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Выполнение запроса к БД для получения данных об аккаунте по id
    $sql = "SELECT * FROM accounts WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных из каждой строки
        while ($row = $result->fetch_assoc()) {
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
            $email = $row["emailAddress"];
            $companyName = $row["companyName"];
            $position = $row["position"];
            $phone = $row["phoneNumber"];
            $secondPhone = $row["secondaryPhone"];
            $alternatePhone = $row["alternatePhone"];
        }
    } else {
        echo "0 results";
    }
}

$conn->close();
