<?php
if (version_compare(PHP_VERSION, '5.2.0', '<')) 
{
die("<strong>Sorry, Website requires PHP 5.2.17 or greater in order to run. <br />You are using ". PHP_VERSION . " which is very outdated.  <br />Please consider upgrading to a newer & more secure version of PHP.<br /<br /></strong>");
}

date_default_timezone_set('Asia/Calcutta');
ini_set('memory_limit','512M');
session_start();

$maintenanceFile	=	"websitedown.true";
if (file_exists($maintenanceFile)) 
{
session_destroy();
die ('<div align="center" style="margin-top:60px"><img src="app/framework/down.gif" /></div>');
}
?>