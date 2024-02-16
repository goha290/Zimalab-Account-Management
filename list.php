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
      require_once('AccountList.php');

      $page = isset($_GET["page"]) ? $_GET["page"] : 1;

      $accountList = new AccountList("localhost", "root", "root", "accountmanagementdb");

      echo $accountList->getAccounts($page);
      ?>
    </table>
    <div>
      <?php
      echo $accountList->getTotalPages();
      $accountList->closeConnection();
      ?>
    </div>
  </div>
</body>

</html>