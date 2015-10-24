<?php 
	session_start(); 
	include_once("db_connect.php");
	
	if(isset($_POST['edit_area']) && isset($_POST['edit_id'])){
		$editText = addslashes($_POST['edit_area']);
		$editId = addslashes($_POST['edit_id']);
		//добавляем данные в БД
		if (isset($_POST['edit_area']) && isset($_POST['edit_id']) && is_numeric($_POST['edit_id'])) {
			$query = "UPDATE `message` SET message_text='".$editText."', date=NOW() WHERE id_message=".$editId;
			$queryResult = mysql_query($query);
			if ($queryResult==1) {
				header('Location: /guest_book.php?mesEdit=true');
				exit;
			}
			else
			{
				echo("Ошибка в запросе");
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
		<form method="POST" action="edit.php">
			<div>
			<?php
				if(isset($_SESSION["admin"])) {
					//проверяем входные данные (номер сообщения и действие)
					if(isset($_GET["id_message"]) && is_numeric($_GET["id_message"])) {
						$mid = $_GET["id_message"];
						$query = "SELECT * FROM `message` WHERE id_message = ". $mid;
						$queryResult = mysql_query($query);
						if($queryResult) {
							$row = mysql_fetch_array($queryResult);
						}
					}
			?>
				<label for="gb_message">Редактирование сообщения:</label>
				<textarea id="edit_area" name="edit_area"><?php echo($row[3]); ?></textarea>
				<textarea id="edit_id" name="edit_id"><?php echo($row[0]); ?></textarea>
			<?php
				}
			?>
			</div>
			<div class="gb_submitEdit">
				<input type="submit" value="Отправить сообщение" />
			</div>
		</form>
	</body>
</html>