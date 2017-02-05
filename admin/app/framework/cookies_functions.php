<?php
class Cookie_Framework 
{
	public function status($name)
	{
		return isset($_COOKIE[$name]);
	}
	
	public function activate($name, $value, $expire)
	{
		setcookie($name,$value,time()	+	$expire, "/");
	}
	
	public function deactivate($name)
	{
		return setcookie($name, "", time() - 3600*24*7);
	}
}
?>