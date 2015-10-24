<?php 
	session_start(); 
	include_once("db_connect.php");
?>

<html>
	<head>
		<title>Goon - Consulting Solution</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript">
			var images = new Array();
			var i = 0;
			var speed = 2000;
			images[0] = './images/garro.jpg';
			images[1] = './images/tarvits.jpg';
			images[2] = './images/erebus.jpg';
			images[3] = './images/loken.jpg';
			images[4] = './images/team.jpg';
			 
			function viewImages() 
			{
				document.getElementById("image_timer").src = images[i]; 
				i++;
				if (i == images.length) i = 0;
				setTimeout("viewImages()", speed);
			} 	 	
		</script>
		<script type="text/javascript" language="JavaScript">
			function over(el){ el.src="images/garro_2.jpg"; };
			function out(el){ el.src="images/loken_2.jpg"; };
		</script>
		<script type="text/javascript" language="JavaScript">
			function loadPage() 
			{
				setTimeout( 'viewImages();' );
				over(el);
				out(el);
			}
		</script>
		<script>
			function openBlock(el) 
			{
				var kids = el.parentNode.childNodes; 
				for (var k = 0; k < kids.length; k++) 
				{
					var child = kids[k];
					if (child && child.className == "this_block_is_hidden") 
					{
						if (child.style.display != 'block') child.style.display = 'block';
						else child.style.display = 'none';
					}
				}
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
				<div class="top-block">
					<div id="user_enter">
						<a href="<?php if($_SESSION["user"]=="admin") echo("admin_panel.php"); else if($_SESSION["user"]=="user") echo("basket.php"); ?>">
							<?php
								if ($_SESSION["user"] == "admin") {
									echo ("Администрирование");
								}
								else if ($_SESSION["user"] == "user") {
									echo ("Корзина");
								}
							?>
							&nbsp&nbsp&nbsp
						</a>
						<a href="auth.php"><?php echo (isset($_SESSION["user"]))? "Выйти (".$_SESSION["user"].")":"Войти в систему"; ?></a>
					</div>
				</div>
				<div class="logo-mainmenu-ref-block">
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
								<li class="list-opt"><a href="#"><div class="menu-btn">ДОМОЙ</div></a></li>
								<li class="list-opt"><a href="service.php"><div class="menu-btn">СЕРИВИСЫ</div></a></li>
								<li class="list-opt"><a href="guest_book.php"><div class="menu-btn">ГОСТЕВАЯ КНИГА</div></a></li>
								<li onmouseover="show_Object1()" onmouseout="hide_Object1()" class="list-opt"><a href="#"><div class="menu-btn">О ПРОЕКТЕ</div></a></li>
							</ul>
						</div>	
						<div class="hidemenu hide" id="menu-hide" onmouseover="show_Object1()" onmouseout="hide_Object1()">
							<ul class="menu-button-hide">
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="jur">ОБ АВТОРАХ</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="eco">О ПРОЕКТЕ</a></li>
								<li class="list-opt"><a href="#" class="menu-btn-hide" id="psy">ОБРАТНАЯ СВЗЯЬ</a></li>
							</ul>
						</div>
					</div> 
					<div id="tw-fb-vk">
						<div id="share">
							<ul class="share-button">
								<li class="list-opt"><a href="#"><div class="share-btn" id="tw"><img class="img-block" src="images/tw.png" height="20" width="20"/></div></a></li>
								<li class="list-opt"><a href="#"><div class="share-btn" id="fb"><img class="img-block" src="images/fb.png" height="20" width="20"/></div></a></li>
								<li class="list-opt"><a href="#"><div class="share-btn" id="vk"><img class="img-block" src="images/vk.png" height="20" width="20"/></div></a></li>
							</ul>
						</div>
					</div>
					<div id="ref1">
						<div class="ref-white" id="ref1-24in7">
							<div id="ref-white-text1"><b>GET FREE BUSINESS ADVICE</b></div>
							<div id="ref-white-text2"><b>24/7</b></div>
							<div id="ref-white-text3"><b>ONLINE SUPPORT CHAT</b></div>
						</div>
						<div class="ref-blue">
							<div class="ref-logo">
								<img src="images/calc.png"/>
							</div>
							<div class="ref-text">
								LOAN SOLUTIONS
							</div>
						</div>
						<div class="ref_empty"></div>
					</div>
					<div id="ref2">
						<div class="ref-yellow" id="ref2-staff">
							<div class="ref-logo">
								<img src="images/staff.png"/>
							</div>
							<div class="ref-text">
								STAFFING SERVICE
							</div>
						</div>
						<div class="ref_empty" id="ref2-empty"></div>
						<div class="ref-white">
							<div class="ref-logo">
								<img src="images/risk.png"/>
							</div>
							<div class="ref-text-blue">
								RISK ASSESSMENT
							</div>
						</div>
					</div>
				</div>
				<div class="top-middle-news-block">
					<div id="top-middle-news-left">
						<div id="top-middle-news-left-top">
							<div id="top-middle-news-left-top-text">
								WE offer ideas<br/> that raise your business<br/> above the expected
							</div>
						</div>
						<div id="top-middle-news-left-middle">
							<div id="top-middle-news-left-middle-text">
								Praesent vestibulum aenaen nonummy hendrerit mauris. Cum sociis natoque penatibus
								et maghis dis parturient montes ascetur ridiculus mus. Nulla dui. Fusce feugiat
								malesuade odio. Morbi nunc odie gravida at cursus nec luctus a lorem. Maecenas
								tristique orcl ac sem. Suis ultricies pharetra magna.
							</div>
						</div>
						<a href="#">
							<div id="top-middle-news-left-bottom">
								<div id="top-middle-news-left-bottom-image">
									<img id="image_timer" src=""/>
								</div>
								<div id="top-middle-news-left-bottom-btn">
									<div id="top-middle-news-left-bottom-text">
										<b>meet <br/>our team</b>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div id="top-middle-news-right">
						<div id="top-middle-news-right-top">
							<div id="top-middle-news-text">
								<div id="top-middle-news-text-1">
									<b>We'll teach you <br/>how to implement</b>
								</div>
								<div id="top-middle-news-text-2">
									MANY DIFFERENT <br/>APPROACHES TO <br/>INTERNET MARKETING:
								</div>
							</div>
							<div id="top-middle-news-list">
								<ul id="list-top-middle">
									<li class="special-marker"><a href="#">&nbsp&nbspPRAESENT VESTIBULUM AENEAN</a></li>
									<li class="special-marker"><a href="#">&nbsp&nbspNONUMMY HENDERERIT MAURIS</a></li>
									<li class="special-marker"><a href="#">&nbsp&nbspCUM SOCIIS NATOQUE PENATIBUS</a></li>
									<li class="special-marker"><a href="#">&nbsp&nbspMAGNUS CMS PARTUTENT MONTES</a></li>
									<li class="special-marker"><a href="#">&nbsp&nbspASCETUR RIDICULUS MUS</a></li>
								</ul>
							</div>
						</div>
						<div id="top-middle-news-right-middle">
							<div id="top-middle-news-pic1">
								<a href="#"><img class="img-ref-1" src="images/appleicon.png"/></a>
							</div>
							<div id="top-middle-news-pic2">
								<a href="#"><img class="img-ref-1" src="images/clockicon.png"/></a>
							</div>
							<div id="top-middle-news-pic3">
								<a href="#"><img class="img-ref-1" src="images/menicon.png"/></a>
							</div>
						</div>
						<div id="top-middle-news-right-bottom" name="#center">
							<div id="top-middle-news-pic1-text">
								<div class="text-pic-text-1">
									<a href="#"><b>start-up</b></a>
								</div>
								<div class="this_block_is_hidden">
									<b>Praesent vestibulum aenean nonnummy hen drerit mauris. 
									Cum sociis natoque penatibus et magnis dis parturient</b>
								</div>
								<div class="text-pic-text-3" onclick="openBlock(this);">
									<a href="#center"><b><u>Подробнее</u></b></a>
								</div>
							</div>
							<div id="top-middle-news-pic2-text">
								<div class="text-pic-text-1">
									<a href="#"><b>planning</b></a>
								</div>
								<div class="this_block_is_hidden">
									<b>Praesent vestibulum aenean nonnummy hen drerit mauris. 
									Cum sociis natoque penatibus et magnis dis parturient</b>
								</div>
								<div class="text-pic-text-3" onclick="openBlock(this);">
									<a href="#center"><b><u>Подробнее</u></b></a>
								</div>
							</div>
							<div id="top-middle-news-pic3-text">
								<div class="text-pic-text-1">
									<a href="#"><b>presentation</b></a>
								</div>
								<div class="this_block_is_hidden">
									<b>Praesent vestibulum aenean nonnummy hen drerit mauris. 
									Cum sociis natoque penatibus et magnis dis parturient</b>
								</div>
								<div class="text-pic-text-3" onclick="openBlock(this);">
									<a href="#center"><b><u>Подробнее</u></b></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="first-between-news-block"></div>
				<div class="bottom-middle-news-block">
					<div class="banner-carusel">
						<img name="image-change" src="images/loken_2.jpg" onmouseover="over(this);" onmouseout="out(this);">
					</div>
					<div class="carusel-event" id="carusel1">
						<div class="carusel-date">
							<b>11/20</b>
						</div>
						<div class="carusel-text-1">
							<b>PRAESENT VESTIBULUM AENEAN NONNIMMY HEN DRERIT MAURIS.</b>
						</div>
						<div class="carusel-text-2">
							Praesent vestibulum aenean nonnummy hen drerit mauris. 
							Cum sociis natoque penatibus et magnis dis parturient montes.
						</div>
					</div>
					<div class="carusel-event" id="carusel2">
						<div class="carusel-date">
							<b>11/15</b>
						</div>
						<div class="carusel-text-1">
							<b>PRAESENT VESTIBULUM AENEAN NONNIMMY HEN DRERIT MAURIS.</b>
						</div>
						<div class="carusel-text-2">
							Praesent vestibulum aenean nonnummy hen drerit mauris. 
							Cum sociis natoque penatibus et magnis dis parturient montes.
						</div>
					</div>
					<div class="carusel-event" id="carusel3">
						<div class="carusel-date">
							<b>11/10</b>
						</div>
						<div class="carusel-text-1">
							<b>PRAESENT VESTIBULUM AENEAN NONNIMMY HEN DRERIT MAURIS.</b>
						</div>
						<div class="carusel-text-2">
							Praesent vestibulum aenean nonnummy hen drerit mauris. 
							Cum sociis natoque penatibus et magnis dis parturient montes.
						</div>
					</div>
				</div>
				<div class="second-between-news-block">
					<div id="carusel-scroll">
						<div id="scroll-image">
							<img src="images/carusel.png" height="28" width="39"/>
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
		<div class="end-block"></div>
	</body>
</html>