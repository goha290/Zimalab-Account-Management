<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleList.css">
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
  <div class="wrapper-list">
    <h1>LIST OF ACCOUNTS</h1>
    <table>
      <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Company name</th>
        <th>Position</th>
        <th>Phone number</th>
        <th>Secondary phone</th>
        <th>Alternate phone</th>
        <th>Change</th>
        <th>Delete</th>
      </tr>
      <?php
      // Подключение к БД
      $conn = new mysqli("localhost", "root", "root", "accountmanagementdb");

      // Проверка подключения
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $limit = 10; // количество записей на странице

      // Получение номера текущей страницы
      if (isset($_GET["page"])) {
        $page = $_GET["page"];
      } else {
        $page = 1;
      };
      $start_from = ($page - 1) * $limit;

      // Получение данных из БД с учетом пагинации
      $sql = "SELECT id, firstName, lastName, emailAddress, companyName, position, phoneNumber, secondaryPhone, alternatePhone FROM accounts LIMIT $start_from, $limit";
      $result = $conn->query($sql);

      // Вывод данных в таблицу
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["firstName"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["lastName"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["emailAddress"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["companyName"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["position"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["phoneNumber"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["secondaryPhone"] . "</td>";
          echo "<td data-type='text' data-id='" . $row['id'] . "' onclick='editCell(this)'>" . $row["alternatePhone"] . "</td>";
          echo "<td>";
          echo "<a href='change.php?id=" . $row["id"] . "'>Change</a>"; // Ссылка для изменения записи
          echo "</td>";
          echo "<td>";
          echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a>"; // Ссылка для удаления записи
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "0 results";
      }

      // Добавление пагинации
      $sql = "SELECT COUNT(id) FROM accounts";
      $result = $conn->query($sql);
      $row = $result->fetch_row();
      $total_records = $row[0];
      $total_pages = ceil($total_records / $limit);

      // Вывод пагинации
      for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='list.php?page=" . $i . "'>" . $i . "</a> ";
      };

      $conn->close();
      ?>
    </table>

  </div>
  </div>
</body>

</html>