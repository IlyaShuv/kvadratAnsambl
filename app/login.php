<?php 
	header('Content-Type: text/html; charset=utf-8');
	mb_internal_encoding("UTF-8");
	mysql_set_charset('utf8');
	
	session_start();         
  $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
  $user = json_decode($s, true);
  //$user['network'] - соц. сеть, через которую авторизовался пользователь
  //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
  //$user['first_name'] - имя пользователя
  //$user['last_name'] - фамилия пользователя

  $network = $user['network'];
  $identity = $user['identity'];
  $first_name = $user['first_name'];
  $last_name = $user['last_name'];

  if (isset($user))
  {
  	#Соединение с БД
  	$db = mysql_connect("localhost", "i40232_ksoloband", "2018ksoloband");
  	mysql_select_db("i40232_ksoloband", $db);

  	mysql_query("INSERT INTO people (first_name, last_name, network, identity) VALUES ('$first_name','$last_name','$network','$identity')");



  	$_SESSION['user'] = $user;
  	header("Location: reg_page.php");
  	exit;
  }
?>                