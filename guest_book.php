<?php 
	session_start(); 
	include_once("db_connect.php");

	$globMessages = array();
	
	$userName = "";
	$userMail = "";
	$userMessage = "";
	//Переменая принимает три значения:
	// 0 - данные еще не добавлялись
	// 1 - данные успешно добавлены
	// -1 - при добавлении возникли ошибки
	$result = 0;
	
	function checkData($userName, $userMail, $userMessage, $captcha) {
		$errors = array();
		if(empty($userName)) {
			$errors["username"] = "Анонимные сообщения не принимаются";
		}
		
		if(empty($userMail) || !filter_var($userMail, FILTER_VALIDATE_EMAIL)) {
			$errors["usermail"] = "Не корректный электронный почтовый адрес";
		}
		
		if(empty($userMessage)) {
			$errors["message"] = "Пустое сообщение";
		}
		
		if(empty($captcha) || empty($_SESSION["captcha"]) || $_SESSION["captcha"] != $captcha) {
			$errors["captcha"] = "CAPTCHA введена не корректно";
		}
		
		return $errors;
	}
	
	function addData($userName, $userMail, $userMessage, $fileName = "") {
		global $globMessages;
		$r = -1;
		$query = 
			"INSERT INTO `message` (
				`username`, 
				`e-mail`, 
				`message_text`, 
				`date`, 
				`published`,
				`image_path`)".
			" VALUES(
				'".$userName."', 
				'".$userMail."', 
				'".$userMessage."', 
				NOW(), 
				0,
				'".$fileName."')";

		$queryResult = mysql_query($query);
		
		if(!$queryResult) {
			$globMessages['insert_error'] = 'Ошибка добавления: ' . mysql_error();
			$r = -1;
		} else {
			$globMessages['success'] = 'Данные успешно добавлены, индетификатор вашей записи: '. mysql_insert_id();
			$r = 1;
		}
		
		return $r;
	}
	
	if(isset($_POST["gb"]) && count($_POST["gb"]) == 3) {
		//функия addslashes экранирует спецсиволы
		$userName = addslashes($_POST["gb"]["username"]);
		$userMail = addslashes($_POST["gb"]["usermail"]);
		$userMessage = strip_tags(addslashes($_POST["gb"]["message"]));
		$captcha = $_POST["captcha"];
		
		$globMessages = checkData($userName, $userMail, $userMessage, $captcha);
		
		//добавляем данные в БД
		if(empty($globMessages)) {
			$fileName = "";
			$path_parts = pathinfo($_FILES["gb_mes_image"]["name"]);
			if(isset($_FILES["gb_mes_image"]) && $_FILES["gb_mes_image"]["error"] == 0) {
				if($_FILES["gb_mes_image"]["size"]<=512000 && ($path_parts['extension']=="jpg" || $path_parts['extension']=="jpeg")) {
					$fileName = "/files/".$_FILES["gb_mes_image"]["name"];
					// Проверяем загружен ли файл
					if(is_uploaded_file($_FILES["gb_mes_image"]["tmp_name"])) {
						// Если файл загружен успешно, перемещаем его из временной директории в конечную
						move_uploaded_file($_FILES["gb_mes_image"]["tmp_name"], __DIR__.$fileName);
						$globMessages['fileUploaded'] = "Файл был успешно загружен";
						$result = 1;
					} else {
						$globMessages['fileUploaded'] = "Не возможно загрузить файл";
						$result = -1;
					}
				}
				else {
					$globMessages['fileUploaded'] = "Неверный формат или размер файла";
					$result = -1;
				}
			}
			//Если не возникло ранее ошибок, то добавляем сообщение
			if($result != -1) {
				$result = addData($userName, $userMail, $userMessage, $fileName);
				if($result == 1) {
					//Отчищаем переменные в случае успешной записи
					$userName = "";
					$userMail = "";
					$userMessage = "";
				}
			}
		} else {
			$result = -1;
		}
	}
	//Выведем сообщение если удаление или обновление сообщения прошло успешно
	if(isset($_GET["mesDelete"]) && $_GET["mesDelete"] == true) {
		$globMessages['mesDelete'] = "Сообщение было удалено";
		$result = 1;
	}else if(isset($_GET["mesUpdate"]) && $_GET["mesUpdate"] == true) {
		$globMessages['mesUpdate'] = "Сообщение было опубликовано";
		$result = 1;
	}else if(isset($_GET["mesEdit"]) && $_GET["mesEdit"] == true) {
		$globMessages['mesEdit'] = "Сообщение изменено";
		$result = 1;
	}
?>

<html>
	<head>
		<title>Гостевая книга</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/gb_style.css">
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="admin_enter">
			<a href="index.php">Вернуться</a>&nbsp&nbsp&nbsp&nbsp
			<a href="admin.php"><?php echo (isset($_SESSION["admin"]))? "Выйти (".$_SESSION["admin"].")":"Вход для администратора"; ?></a>
		</div>
		<div class="wrapper">
			<div class='system_message 
				<?php 
					if($result == -1) {
						echo "warning_message";
					} if($result == 1) {
						echo "success_message";
					}
				?>
			'>
				<?php
					if(!empty($globMessages)) {
						echo "<ul>";
						foreach($globMessages as $field => $message) {
							echo "<li>".$message."</li>";
						}
						echo "</ul>";
					}
				?>
			</div>
			<form method="POST" action="guest_book.php" enctype="multipart/form-data" >
				<div class="gb_user_information">
					<div class="gb_user_name">
						<label for="gb_username">Ваше имя:</label>
						<input type="text" id="gb_user_name" <?php echo array_key_exists("username", $globMessages)?"class='error'":"";?> name="gb[username]" value="<?php echo $userName;?>">
					</div>
					<div class="gb_user_mail">
						<label for="gb_user_mail">Ваш e-mail:</label>
						<input type="text" id="gb_user_mail" <?php echo array_key_exists("usermail", $globMessages)?"class='error'":"";?> name="gb[usermail]" value="<?php echo $userMail;?>">
					</div>
				</div>
				<div>
					<label for="gb_message">Сообщение:</label>
					<textarea id="gb_message" name="gb[message]" <?php echo array_key_exists("message", $globMessages)?"class='error'":"";?> ><?php echo $userMessage;?></textarea>
				</div>
				<div class="gb_extension">
					<div class="gb_image">
						<input type="file" name="gb_mes_image" accept="image/*" />
					</div>
					<div class="gb_captcha">
						<div class="gb_future_image_captcha"><img src="captcha.php"></div>
						<input type="text" name="captcha" />
					</div>
				</div>
				<div class="gb_submit">
					<input type="submit" value="Отправить сообщение" />
				</div>
			</form>
			<div id="gb_messages">
			<?php
				$append = "";
				if(!isset($_SESSION["admin"])) {
					$append = "WHERE published = 1";
				}
				$queryResult = mysql_query("SELECT * FROM `message` " . $append);
				if($queryResult) {
					while ($row = mysql_fetch_array($queryResult, MYSQL_BOTH)) {
			?>
					<div class="gb_message">
						<div class="gb_mess_info">
							<div class="gb_mess_author"><a href="mailto:<?php echo $row['e-mail']; ?>"><?php echo $row['username'];?></a></div>
							<div class="gb_mess_date"><?php echo $row['date'];?></div>
							<?php
								if(isset($_SESSION["admin"])) {
							?>
								<!--Данный блок будет виден только администратору-->
								<ul class="gb_mess_control">
									<li><a href="edit.php?id_message=<?php echo $row['id_message'];?>">Редактировать</a></li>
									<li><a href="mes_control.php?action=del&id_message=<?php echo $row['id_message'];?>">Удалить</a></li>
									<li><a href="mes_control.php?action=publish&id_message=<?php echo $row['id_message'];?>">Опубликовать</a></li>
								</ul>
							<?php
								}
							?>
						</div>
						<?php 
							if (($row['published'] == 1) && (isset($_SESSION["admin"])))
								echo('<div class="gb_mess_content" style="border: 2px solid green; padding: 15px">');
							else
								echo('<div class="gb_mess_content" style="padding: 15px">');
						?>
						<?php if($row["image_path"] != ""):?>
							<div class="future_mess_image"><a href="<?php echo $row["image_path"];?>"><img src="<?php echo $row["image_path"];?>" width="100" height="100"></a></div>
						<?php endif;?>
						<?php echo $row["message_text"];?>
					</div>
			<?php 
					}
				}
			?>
			</div>
		</div>
	
</body></html>