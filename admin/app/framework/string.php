<?php
class string_framework
{
	function string_case_change($case, $string)
	{
		switch ($case) 
		{
		case "UPPER":
		return mb_convert_case($string, MB_CASE_UPPER, "UTF-8");
		break;

		case "LOWER":
		return mb_convert_case($string, MB_CASE_LOWER, "UTF-8");
		break;
		
		case "TITLE":
		return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
		break;
		
		default:
		echo "<br />Invalid Case Specified";
		}
	}
	
	function string_length($string)
	{
		return strlen($string);
	}
	
	function zerofill ($number, $zerofill = 5)
	{
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
}
?>