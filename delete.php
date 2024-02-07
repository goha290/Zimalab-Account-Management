<?php
if (isset($_GET['id'])) {
  // Подключение к БД
  $conn = new mysqli("localhost", "root", "root", "accountmanagementdb");

  // Проверка подключения
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $id = $_GET['id'];

  // Удаление записи
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $sql = "DELETE FROM accounts WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    header('Location: list.php');
    exit;
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  $conn->close();
}
