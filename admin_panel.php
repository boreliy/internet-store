<?php
	session_start();
	include_once("db_connect.php");
	
	if(isset($_POST['del_user']))
	{
		$id = addslashes($_POST['del_user']);
		$query = "DELETE FROM `users` WHERE id_user = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if (isset($_POST['del_service']))
	{
		$id = addslashes($_POST['del_service']);
		$query = "DELETE FROM `services` WHERE id_services = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['edit_user']))
	{
		$id = addslashes($_POST['edit_user']);
		$query = "UPDATE `users` SET name_user='".$_POST['user_name']."', surname_user='".$_POST['user_surname']."', login='".$_POST['login']."', password='".$_POST['password']."', role='".$_POST['role']."' WHERE id_user=".$id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['edit_service']))
	{
		$id = addslashes($_POST['edit_service']);
		$query = "UPDATE `services` SET name_service='".$_POST['serv_name']."', price='".$_POST['price']."', description='".$_POST['description']."' WHERE id_services=".$id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['new_user']))
	{
		$query = "INSERT INTO `users` (`name_user`, `surname_user`, `login`, `password`, `role`) VALUES('".$_POST['user_name']."', '".$_POST['user_surname']."', '".$_POST['login']."', '".$_POST['password']."', '".$_POST['role']."')";
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['new_service']))
	{
		$query = "INSERT INTO `services` (`name_service`, `price`, `description`) VALUES('".$_POST['serv_name']."', '".$_POST['price']."', '".$_POST['description']."')";
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['bask_appr']))
	{
		$id = addslashes($_POST['bask_appr']);
		$query = "UPDATE `baskets` SET status=1 WHERE id_basket = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['bask_unappr']))
	{
		$id = addslashes($_POST['bask_unappr']);
		$query = "UPDATE `baskets` SET status=NULL WHERE id_basket = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
	if(isset($_POST['bask_del']))
	{
		$id = addslashes($_POST['bask_del']);
		$query = "DELETE FROM `baskets` WHERE id_basket = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /admin_panel.php');
			exit;
		}
	}
?>

<html>
	<head>
		<title>Администрирование</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/admin_style.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" language="JavaScript">
			function loadPage() 
			{
				setTimeout( 'viewImages();' );
				over(el);
				out(el);
			}
		</script>
		<script type="text/javascript">
			function show_Object1() 
			{
				document.getElementById('menu-hide').className = 'show';
			}

			function hide_Object1() 
			{
				document.getElementById('menu-hide').className = 'hide';
			}
		</script>
	</head>
	<body onload="loadPage()">
	<div class="page">
			<div class="size-page">
			<form method="POST" action="admin_panel.php">
				<div class="top-block">
					<div id="user_enter">
						<a href="auth.php"><?php echo (isset($_SESSION["user"]))? "Выйти (".$_SESSION["user"].")":"Войти в систему"; ?></a>
					</div>
				</div>
				<div class="logo-mainmenu-ref-block-admin">
					<div id="logo-mainmenu">
						<div id="logo">
							<a href="#">
								<div class="logo-btn">
									<div id="logo-pic"><b>Goon</b></div>
									<div id="logo-text">CONSULTING COMPANY</div>
								</div>
							</a>
						</div>	
						<div id="mainmenu">
							<ul class="menu-button">
								<li class="list-opt"><a href="index.php"><div class="menu-btn">ДОМОЙ</div></a></li>
								<li class="list-opt"><a href="service.php"><div class="menu-btn">СЕРИВИСЫ</div></a></li>
								<li class="list-opt"><a href="guest_book.php"><div class="menu-btn">ГОСТЕВАЯ КНИГА</div></a></li>
								<li onmouseover="show_Object1()" onmouseout="hide_Object1()" class="list-opt"><a href="#"><div class="menu-btn">О ПРОЕКТЕ</div></a></li>
							</ul>
						</div>	
						<div class="hidemenu hide" id="menu-hide" onmouseover="show_Object1()" onmouseout="hide_Object1()">
							<ul class="menu-button-hide">
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="jur">ОБ АВТОРАХ</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="eco">О ПРОЕКТЕ</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="psy">ОБРАТНАЯ СВЯЗЬ</a></li>
							</ul>
						</div>
					</div> 
					</div>
					<div id="main-panel">
					<div class="space">Пользователи</div>
					<div id="user-panel">
					<div id="user-table">
						<table border="1px" class="table">
							<tr>
								<td class='header'>ID</td>
								<td class='header'>Имя</td>
								<td class='header'>Фамилия</td>
								<td class='header'>Логин</td>
								<td class='header'>Пароль</td>
								<td class='header'>Роль</td>
								<td class='header'>Изменить</td>
								<td class='header'>Удалить</td>
							</tr>
							<?php
								$sql = "SELECT * FROM `users`";
								$result = mysql_query($sql) or die(mysql_error());
		
								while ($row = mysql_fetch_assoc($result)) {
									echo("
									<tr>
										<td class='td1-1'>".$row['id_user']."</td>
										<td class='td1-2'>".$row['name_user']."</td>
										<td class='td1-3'>".$row['surname_user']."</td>
										<td class='td1-4'>".$row['login']."</td>
										<td class='td1-5'>".$row['password']."</td>
										<td class='td1-6'>".$row['role']."</td>
										<td>
											<input type='submit' name='edit_user' class='button' value='".$row['id_user']."'/>
										</td>
										<td>
											<input type='submit' name='del_user' class='button' value='".$row['id_user']."'/>
										</td>
									</tr>
									");
								}
							?>
						</table>
					</div>
					<div id="user-edit">
						<label><b>Редактирование сообщения:</b></label><br/>
						<label>Имя:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<textarea class="tx_area" name="user_name"></textarea><br/>
						<label>Фамилия:</label>
						<textarea class="tx_area" name="user_surname"></textarea><br/>
						<label>Логин:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<textarea class="tx_area" name="login"></textarea><br/>
						<label>Пароль:&nbsp&nbsp&nbsp</label>
						<textarea class="tx_area" name="password"></textarea><br/>
						<label>Роль:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<textarea class="tx_area" name="role"></textarea><br/>
						<input type='submit' name='new_user' value='Добавить пользователя'/><br/>
					</div>
					</div>
					<div class="space">Услуги</div>
					<div id="serv-panel">
					<div id="serv-table">
						<table border="1px" class="table">
							<tr>
								<td class='header'>ID</td>
								<td class='header'>Название</td>
								<td class='header'>Цена</td>
								<td class='header'>Описание</td>
								<td class='header'>Изменить</td>
								<td class='header'>Удалить</td>
							</tr>
							<?php 
								$sql = "SELECT * FROM `services`";
								$result = mysql_query($sql) or die(mysql_error());
		
								while ($row = mysql_fetch_assoc($result)) {
									echo("
									<tr>
										<td class='td2-1'>".$row['id_services']."</td>
										<td class='td2-2'>".$row['name_service']."</td>
										<td class='td2-3'>".$row['price']."</td>
										<td class='td2-4'>".$row['description']."</td>
										<td>
											<input type='submit' name='edit_service' class='button' value='".$row['id_services']."'/>
										</td>
										<td>
											<input type='submit' name='del_service' class='button' value='".$row['id_services']."'/>
										</td>
									</tr>
									");
								}
							?>
						</table>
					</div>
					<div id="serv-edit">
						<label><b>Редактирование услуги:</b></label><br/>
						<label>Название:&nbsp</label>
						<textarea class="tx_area" name="serv_name"></textarea><br/>
						<label>Цена:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<textarea class="tx_area" name="price"></textarea><br/>
						<label>Описание:</label>
						<textarea class="tx_area" name="description"></textarea><br/>
						<input type='submit' name='new_service' value='Добавить услугу'/><br/>
					</div>
					</div>
					<div class="space">Невыполненные заказы</div>
					<div id="serv-panel">
					<div id="bask-table">
						<table border="1px" class="table">
							<tr>
								<td class='header'>ID заказа</td>
								<td class='header'>Заказчик</td>
								<td class='header'>Услуга</td>
								<td class='header'>Цена</td>
								<td class='header'>Выполнить</td>
								<td class='header'>Удалить</td>
							</tr>
							<?php 
								$sql = "SELECT `id_basket`, services.`name_service`, services.`price`, users.`name_user`, users.`surname_user` FROM baskets LEFT JOIN services ON baskets.id_serv=services.id_services LEFT JOIN users ON baskets.id_user=users.id_user WHERE status is null";
								$result = mysql_query($sql) or die(mysql_error());
		
								while ($row = mysql_fetch_assoc($result)) {
									echo("
									<tr>
										<td class='td3-1'>".$row['id_basket']."</td>
										<td class='td3-2'>".$row['name_user']."&nbsp".$row['surname_user']."</td>
										<td class='td3-3'>".$row['name_service']."</td>
										<td class='td3-4'>".$row['price']."</td>
										<td>
											<input type='submit' name='bask_appr' class='button' value='".$row['id_basket']."'/>
										</td>
										<td>
											<input type='submit' name='bask_del' class='button' value='".$row['id_basket']."'/>
										</td>
									</tr>
									");
								}
							?>
						</table>
					</div>
					</div>
					<div class="space">Выполненные заказы</div>
					<div id="serv-panel">
					<div id="bask-table">
						<table border="1px" class="table">
							<tr>
								<td class='header'>ID заказа</td>
								<td class='header'>Заказчик</td>
								<td class='header'>Услуга</td>
								<td class='header'>Цена</td>
								<td class='header'>Не выполнен</td>
								<td class='header'>Удалить</td>
							</tr>
							<?php 
								$sql = "SELECT `id_basket`, services.`name_service`, services.`price`, users.`name_user`, users.`surname_user` FROM baskets LEFT JOIN services ON baskets.id_serv=services.id_services LEFT JOIN users ON baskets.id_user=users.id_user WHERE status is not null";
								$result = mysql_query($sql) or die(mysql_error());
		
								while ($row = mysql_fetch_assoc($result)) {
									echo("
									<tr>
										<td class='td3-1'>".$row['id_basket']."</td>
										<td class='td3-2'>".$row['name_user']."&nbsp".$row['surname_user']."</td>
										<td class='td3-3'>".$row['name_service']."</td>
										<td class='td3-4'>".$row['price']."</td>
										<td>
											<input type='submit' name='bask_unappr' class='button' value='".$row['id_basket']."'/>
										</td>
										<td>
											<input type='submit' name='bask_del' class='button' value='".$row['id_basket']."'/>
										</td>
									</tr>
									");
								}
							?>
						</table>
					</div>
					</div>
					</div>
					<div class="reference-block">
					<div id="copyright">
						<a href="#">
							<div class="copy-btn">
								<div id="copy-pic"><b>Goon</b></div>
								<div id="copy-text">© 2015 <br/>PRIVACY POLICY</div>
							</div>
						</a>
					</div>
					<div class="reference" id="end-ref1">
						<div class="ref-title" id="work">
							work
						</div>
						<div class="ref-text-new">
							<ul class="special_ul">
								<a href="#"><li class="special-marker-new">&nbsp&nbspCUSTOMER SUPPORT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspPLATINUM SUPPORT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspGOLD SUPPORT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspSTANDARD SUPPORT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspTRAINING</li></a>
							</ul>
						</div>
					</div>
					<div class="reference" id="end-ref2">
						<div class="ref-title" id="sol">
							solutions
						</div>
						<div class="ref-text-new">
							<ul class="special_ul">
								<a href="#"><li class="special-marker-new">&nbsp&nbspCONTACT CENTER</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspCUSTOMER SUPPORT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspHELP DESK</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspMANAGEMENT</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspWEB SELF-SERVICE</li></a>
							</ul>
						</div>
					</div>
					<div class="reference" id="end-ref3">
						<div class="ref-title" id="about">
							about us
						</div>
						<div class="ref-text-new">
							<ul class="special_ul">
								<a href="#"><li class="special-marker-new">&nbsp&nbspCUSTOMER FOCUS</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspPERFOMANCE</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspINNOVATION</li></a>
								<a href="#"><li class="special-marker-new">&nbsp&nbspRESPONSIBILITY</li></a>
							</ul>
						</div>
					</div>
					<div id="feedback">
						<div class="ref-title" id="fdb">
							contacts
						</div>
						<div class="ref-text-cont">
							<b>Щукин Антон Владимирович,<br/>
							Россия, Томская обл., г.Томск.</b></br>
							Телефон: <b>+79234016100</b><br/>
							E-MAIL: <b><u><a href="mailto:boreliy2@gmail.com">boreliy2@gmail.com</a></u></b>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</body>
</html>