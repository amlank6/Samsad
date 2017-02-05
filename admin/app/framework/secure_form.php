<?php
class secure_form
{
	function remove_sql_injection($val) 
	{
		$bad1		=		 array('/\blike\b/i','/\bdrop\b/i', '/\bor\b/i', '/\bscript\b/i', '/\balert\b/i', '/\bdelete\b/i', '/\binsert\b/i', '/\bselect\b/i');
		$val		=		 strip_tags($val);					// STRIP PHP & HTML TAGS
		$val		=		 preg_replace($bad1, '', $val);		// STRIP HARMFUL CODES 1 FOR SQL INJECTION
		$val		=		 addslashes($val);
		return $val;
	}
}
?>