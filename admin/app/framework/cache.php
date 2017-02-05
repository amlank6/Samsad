<?php
class cache_tools
{	
	function getUrl()
	{
		$url			=	$_SERVER["SCRIPT_NAME"];
		$break 			=	Explode('/', $url);
		$cacheFileName	=	md5($break[count($break) - 1]);
		return $cacheFileName;
	}
	
	function check_cache_lifetime()
	{
		$dir			=	"cache/";
		$cacheFileName	=	$this->getUrl();
		$cachetime		=	5 * 60; 	// 5 Minutes
		if(file_exists($dir.$cacheFileName) && time() - $cachetime < filemtime(utf8_decode($dir."/".$cacheFileName)))
		{
		return 0;
		}
		else
		{
		return 1;
		}
	}
	
	function create_cache()
	{
		$dir			=	"cache/";
		$cacheFileName	=	$this->getUrl();
		$fp 			=	fopen($dir.$cacheFileName, 'w');
		fwrite($fp,  ob_get_contents());
		fclose($fp);
		ob_end_flush();
	}
	
	function delete_cache()
	{
		$path	=	'../cache/*';	
		$files = glob($path);
		foreach($files as $file)
		{ 
			if(is_file($file))
			{	return unlink($file);	}
		}
	}
}
?>