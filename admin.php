<?php
	include_once("config.php");
?>
<?php
	session_start();
	if(isset($_SESSION["admin"])) {
		$_SESSION["admin"] = null;
		header("Location: /guest_book.php");
		exit;
	}
?>
<?php
	if(isset($_POST['admin_name']) && isset($_POST['admin_pass'])) {
		if(empty($_POST['admin_name']) || empty($_POST['admin_pass'])) {
			echo "Извините, вы должны заполнить все поля";
		} else {
			if($_POST['admin_name'] == USERNAME && $_POST['admin_pass'] == PASSWORD) {
				$_SESSION["admin"] = "gb_admin";
				header('Location: /guest_book.php');
				exit;
			} else {
				echo "Извините, пара логин/пароль не корректны";
			}
		}
	}
?>
<html>
	<head>
		<title>Гостевая книга</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/gb_style.css">
	</head>
	<body>
		<form action="admin.php" method="POST">
			<div>
				<label for="admin_name">Логин</label>
				<input id="admin_name" type="text" name="admin_name" />
			</div>
			<div>
				<label for="admin_pass">Пароль</label>
				<input id="admin_pass" type="password" name="admin_pass" />
			</div>
			<input type="submit" value="Login"/>
		</form>
		<a href="guest_book.php"><input type="reset" id="admin_pass" value="Вернуться на главную"/></a>
	</body>
</html>