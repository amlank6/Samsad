<?php
class Security_Framework
{
	public $key 	= 	'';
	function encrypt($str)
	{
	$result  = "";
	$char	 = "";
	$keychar = "";
	for($i=0; $i<strlen($str); $i++) 
	{
	$char = substr($str, $i, 1);
	$keychar = substr('magicnines_basant', ($i % strlen('magicnines_basant'))-1, 1);
	$char = chr(ord($char)+ord($keychar));
	$result.=$char;
	}
	return urlencode(base64_encode($result));
	}

	function decrypt($str)
	{
	$result 	= "";
	$char	 	= "";
	$keychar 	= "";
	$str = base64_decode(urldecode($str));
	for($i=0; $i<strlen($str); $i++) 
	{
	$char = substr($str, $i, 1);
	$keychar = substr('magicnines_basant', ($i % strlen('magicnines_basant'))-1, 1);
	$char = chr(ord($char)-ord($keychar));
	$result.=$char;
	}
	return $result;
	}
	
	function check_page_access()
	{
		if(!isset($_SESSION["user_token"]))
		{
		session_destroy();
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
		}
	}
}
?>