<!DOCTYPE html>
<html>
<head>
  <title>Квадрат Соло - регистрация участников</title>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="max-age=60, must-revalidate">
  <link rel="stylesheet" type="text/css" href="css/admin.css">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
  <header>
    <div class="container">
      <h1>Квадрат соло</h1>
      <p>Регистрация участников</p>
      <form action="adminpage.php" method="POST">
        <input type="password" name="password" placeholder="Введите пароль" required>
        <input type="submit" name="button" value="Вывести данные">
      </form>
    </div>
  </header>
</body>
</html>

<?php
  header('Content-Type: text/html; charset=utf-8');
  mb_internal_encoding("UTF-8");

  if(isset($_POST['password'])) {
    $dbLog = mysql_connect("localhost", "i40232_logins", ".CfmJEF94GjtTcq");
    mysql_select_db("i40232_logins", $dbLog);

    $queryLog = "SELECT `pass` FROM `logins` WHERE `site` = 'band.kvadratsolo.ru'";
    $resultLog = mysql_query($queryLog) or die(mysql_error());
    $passLog = mysql_fetch_assoc($resultLog);
    $pass = $passLog['pass'];

    if($_POST['password'] == $pass) {
      $db = mysql_connect("localhost", "i40232_ksoloband", "2018ksoloband");
      mysql_select_db("i40232_ksoloband", $db);

      $query = "SELECT * FROM people ORDER BY record";
      $result = mysql_query($query) or die(mysql_error());

      echo "<div class='container'>";
      echo "<table border='1' cellpadding='5' bordercolor='#CCC'>";

      while ($row = mysql_fetch_assoc($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $network = $row['network'];
        $identity = $row['identity'];
        $login_date = $row['login_date'];
        echo "<tr>";
        echo "<td>";
        echo "<div class='cell'>$first_name</div>";
        echo "</td>";
        echo "<td>";
        echo "<div class='cell'>$last_name</div>";
        echo "</td>";
        echo "<td>";
        echo "<div class='cell'>$network</div>";
        echo "</td>";
        echo "<td>";
        echo "<div class='idcell'>$identity</div>";
        echo "</td>";
        echo "<td>";
        echo "<div class='timecell'>$login_date</div>";
        echo "</td>";
        echo "</tr>";
      }

      echo "</table>";
      echo "</div>";
      exit;
    } else {
      echo "Некорректный пароль!";
      exit;
    }
  }
	
?>