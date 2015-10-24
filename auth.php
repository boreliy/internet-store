<?php
	include_once("db_connect.php");
?>
<?php
	session_start();
	if(isset($_SESSION["user"])) {
		$_SESSION["user"] = null;
		header("Location: /index.php");
		exit;
	}
?>
<?php
	if(isset($_POST['user_name']) && isset($_POST['user_pass'])) {
		$query = "SELECT * FROM `users` WHERE login='".$_POST['user_name']."' AND password='".$_POST['user_pass']."'";
		$queryResult = mysql_query($query);
		$queryl = mysql_fetch_row($queryResult);
		if(empty($_POST['user_name']) || empty($_POST['user_pass'])) {
			echo "Извините, вы должны заполнить все поля";
		} else {
			if($_POST['user_name'] == $queryl[3] && $_POST['user_pass'] == $queryl[4]) {
				if($queryl[5] == user)
				{
					$_SESSION["user"] = "user";
					$_SESSION["id"] = $queryl[0];
					header('Location: /index.php');
					exit;
				}
				else if($queryl[5] == admin)
				{
					$_SESSION["user"] = "admin";
					$_SESSION["id"] = $queryl[0];
					header('Location: /index.php');
					exit;
				}
			} else {
				echo "Извините, пара логин/пароль не корректны";
			}
		}
	}
?>
<html>
	<head>
		<title>Авторизация</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/gb_style.css">
	</head>
	<body>
		<form action="auth.php" method="POST">
			<div>
				<label for="user_name">Логин</label>
				<input id="user_name" type="text" name="user_name" />
			</div>
			<div>
				<label for="user_pass">Пароль</label>
				<input id="user_pass" type="password" name="user_pass" />
			</div>
			<input type="submit" value="Войти"/>
		</form>
		<a href="index.php"><input type="reset" value="Вернуться на главную"/></a>
	</body>
</html>