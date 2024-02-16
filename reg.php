<?php
require_once('accountReg.php');

// Получение данных из POST запроса
$firstname = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_SPECIAL_CHARS);
$secondname = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$companyname = filter_var(trim($_POST['companyName']), FILTER_SANITIZE_SPECIAL_CHARS);
$position = filter_var(trim($_POST['position']), FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_SPECIAL_CHARS);
$secondphone = filter_var(trim($_POST['secondPhone']), FILTER_SANITIZE_SPECIAL_CHARS);
$alternatephone = filter_var(trim($_POST['alternatePhone']), FILTER_SANITIZE_SPECIAL_CHARS);

// Создание экземпляра класса Account
$account = new Account($firstname, $secondname, $email, $companyname, $position, $phone, $secondphone, $alternatephone);
$account->validateInput();
$account->addToDatabase();
?>