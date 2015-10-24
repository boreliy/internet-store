<?php
	session_start();
	include_once("db_connect.php");
	
	if(isset($_POST['del_bask']))
	{
		$id = addslashes($_POST['del_bask']);
		$query = "DELETE FROM `baskets` WHERE id_basket = ". $id;
		$queryResult = mysql_query($query);
		if($queryResult) {
			header('Location: /basket.php');
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
			<form method="POST" action="basket.php">
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
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="jur">JURISTICAL</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="eco">ECONOMICAL</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="psy">PSYCHOLOGICAL</a></li>
							</ul>
						</div>
					</div> 
					</div>
					<div id="main-panel">
					<div class="space">Корзина</div>
					<div id="serv-panel">
					<div id="serv-table-edit">
						<table border="1px" class="table">
							<tr>
								<td class='header'>Название услуги</td>
								<td class='header'>Цена</td>
								<td class='header'>Описание</td>
								<td class='header'>Удалить</td>
							</tr>
							<?php 
								$sql = "SELECT `id_basket`, services.`name_service`, services.`price`, services.`description` FROM baskets LEFT JOIN services ON baskets.id_serv=services.id_services WHERE id_user=".$_SESSION['id']." AND status is null";
								$result = mysql_query($sql) or die(mysql_error());

								while ($row = mysql_fetch_assoc($result)) {
									echo("
									<tr>
										<td class='edit-td2-2'>".$row['name_service']."</td>
										<td class='edit-td2-3'>".$row['price']."</td>
										<td class='edit-td2-4'>".$row['description']."</td>
										<td>
											<input type='submit' name='del_bask' class='button' value='".$row['id_basket']."'/>
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