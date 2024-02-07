<?php
// Фильтрация входных данных
$firstname = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_SPECIAL_CHARS);
$secondname = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$companyname = filter_var(trim($_POST['companyName']), FILTER_SANITIZE_SPECIAL_CHARS);
$position = filter_var(trim($_POST['position']), FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_SPECIAL_CHARS);
$secondphone = filter_var(trim($_POST['secondPhone']), FILTER_SANITIZE_SPECIAL_CHARS);
$alternatephone = filter_var(trim($_POST['alternatePhone']), FILTER_SANITIZE_SPECIAL_CHARS);

// Проверка длины входных данных
if (mb_strlen($firstname) < 2 || mb_strlen($firstname) > 50) {
    echo "Недопустимая длина имени";
    exit();
} elseif (mb_strlen($secondname) < 2 || mb_strlen($secondname) > 50) {
    echo "Недопустимая длина фамилии";
    exit();
} elseif (mb_strlen($email) < 5 || mb_strlen($email) > 320) {
    echo "Недопустимая длина email";
    exit();
} elseif (mb_strlen($companyname) > 100) {
    echo "Недопустимая длина названия компании";
    exit();
} elseif (mb_strlen($position) > 100) {
    echo "Недопустимая длина должности";
    exit();
} elseif (mb_strlen($phone) > 20) {
    echo "Недопустимая длина номера телефона";
    exit();
} elseif (mb_strlen($secondphone) > 20) {
    echo "Недопустимая длина второго номера телефона";
    exit();
} elseif (mb_strlen($alternatephone) > 20) {
    echo "Недопустимая длина дополнительного номера телефона";
    exit();
}

// Подключение к БД и проверка подключения
$mysql = new mysqli('localhost', 'root', 'root', 'accountmanagementdb');
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Запрос на добавление данных в БД и проверка успешности выполнения запроса
$sql = "INSERT INTO accounts (firstName, lastName, emailAddress, companyName, position, phoneNumber, secondaryPhone, alternatePhone) 
VALUES('$firstname', '$secondname', '$email', '$companyname', '$position', '$phone', '$secondphone', '$alternatephone')";

if ($mysql->query($sql) === TRUE) {
    echo '<script>alert("The account has been successfully registered")</script>';
    echo '<script>window.location.href = "registration.html";</script>';
} else {
    echo '<script>alert("The email you entered is already registered")</script>';
    echo '<script>window.location.href = "registration.html";</script>';
}

$mysql->close();
