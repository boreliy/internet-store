<?php 
	header('Content-Type: text/html; charset=utf-8');
	session_start();
    unset($_SESSION["captcha"]); //очищаем переменную с суммой
	header ("Content-type: image/png");  
	$img = imagecreate(150, 30);
	$colors=array('255-000-000' => 'красный',
		'255-255-255' => 'чёрный',
		'000-000-000' => 'белый',
		'000-255-000' => 'зелёный',
		'000-000-255' => 'синий',
		'255-255-000' => 'жёлтый',
		'000-255-255' => 'голубой',
		'128-000-255' => 'фиолетовый',
		'255-128-000' => 'оранжевый',
		'128-000-000' => 'бардовый',
		'128-128-128' => 'серый',
		'255-000-255' => 'розовый');
	$color = array_rand ($colors, 1);
	list($r, $g, $b) = explode('-', $color, 3);
	$background_color = imagecolorallocate($img, (int)$r, (int)$g, (int)$b);
	$_SESSION["captcha"] = $colors[$color];
	imagepng($img);
	imagedestroy($img); 
?>