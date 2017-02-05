<?php
class Captcha
{
	function colorful_simple_captcha()
	{
	$text	=	substr(str_shuffle(str_repeat("ABDGHKMXZQW123456789", 5)), 0, 5);
	$font	=	'font.ttf';
	putenv('GDFONTPATH=' . realpath('.'));
	$fsize	=	22;
	$path	=	'';
	$bg		=	array(255,255,255);
	$len	=	strlen($text);
	$im 	= 	imagecreatetruecolor($len*43, 55);
	$white 	= 	imagecolorallocate($im, 255, 255, 255);
	$grey 	= 	imagecolorallocate($im, 128, 128, 128);
	imagefilledrectangle($im, 0, 0, ($len*45)-2, 55, $white);
	for($i=0;$i<$len;$i++)
	{
		$char=substr($text,$i,1);
		$colorS	=	imagecolorallocate($im, 200, 200, 200);
		$color	=	imagecolorallocate($im, rand(15,255), rand(10,255), rand(20,255));
		$posX=($i*40)+20;
		$posY=rand(25,40);
		$angle=rand(-30,30);
		imagettftext($im, $fsize, $angle, $posX+1, $posY+1, $color, $font, $char);
		imagettftext($im, $fsize, $angle, $posX, $posY, $color, $font, $char);
	}
	imagepng($im,ltrim(rtrim($path,'/').'/image.png','/'));
	imagedestroy($im);
	header("Cache-Control: no-cache, must-revalidate");
	return "image.png";
	}
}
?>