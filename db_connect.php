<?php 
	include_once("config.php");
	$id_connect = mysql_connect(BD_HOST, BD_USERNAME, BD_PASSWORD) or die("Сервер временно недоступен - ".mysql_error());;
	mysql_select_db(BD_NAME, $id_connect) or die("Не возможно подключиться к БД - ".mysql_error());
?>