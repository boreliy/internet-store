<?php 
	session_start();
	include_once("db_connect.php");
	//убеждаемс€ что администратор авторизировалс€
	if(isset($_SESSION["admin"])) {
		//провер€ем входные данные (номер сообщени€ и действие)
		if(isset($_GET["action"]) && isset($_GET["id_message"]) && is_numeric($_GET["id_message"])) {
			$mid = $_GET["id_message"];
			$action = $_GET["action"];
			$text = $_GET["text_message"];
			switch($action) {
				case "del":
					//удал€ем сообщение по уникальному идентифкатору
					$query = "SELECT * FROM `message` WHERE id_message = ". $mid;
					$queryResult = mysql_query($query);
					$queryl=mysql_fetch_row(($queryResult));
					if($queryl[6] != null) {
						unlink("C:/OpenServer/domains/project-gb".$queryl[6]);
					}
					$queryDelete = "DELETE FROM `message` WHERE id_message = ". $mid;
					$queryResult = mysql_query($queryDelete);
					if($queryResult) {
						//возвращаемс€ на главную страницу и передаем методом GET о том, что сообщение было удалено успешно
						header('Location: /guest_book.php?mesDelete=true');
						exit;
					}
				break;
				case "publish":
					$queryUpdate = "UPDATE `message` SET published = 1 WHERE id_message = ".$mid;
					$queryResult = mysql_query($queryUpdate);
					if($queryResult) {
						header('Location: /guest_book.php?mesUpdate=true');
						exit;
					}
				break;	
				default:
					echo "Ќеизвестное действие.";
					header('Location: /guest_book.php');
			}
		}
	} else {
		echo "”правл€ть сообщени€ми может только администратор, вы будете перенаправлены на главную страницу через 2 секунды.";
		header('Location: /guest_book.php');
		exit;
	}
?>