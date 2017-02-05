<?php
class Random_Variables
{
	function rand_number($length)
	{
	return substr(str_shuffle(str_repeat("0123456789", $length)), 0, $length);
	}

	function rand_string($length)
	{
	return substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", $length)), 0, $length);
	}

	function rand_alphanumeric($length)
	{
	return substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz0123456789", $length)), 0, $length);
	}

	function unique_alpha($length)
	{
	return substr(md5(uniqid(mt_rand(), true)), 0, $length);	
	}
}
?>