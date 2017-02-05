<?php
class Date_Time_Utilities
{
	function display_date()
	{
	return date("l, d - F - Y");
	}

	function display_time()
	{
	return date("h: i a");
	}

	function display_short_datetime()
	{
	return date("d M Y h: i a");
	}

	function create_unix_timestamp($hour, $min, $sec, $month, $day, $year)
	{
	return mktime($hour, $min, $sec, $month, $day, $year);
	}
	
	function display_hms($seconds)
	{
	return gmdate("H:i:s",$seconds);
	}
	
	function add_time($hours, $minutes, $seconds)
	{
	date_default_timezone_set('Asia/Calcutta');
	$totalHours 	= date("H") + $hours;
	$totalMinutes 	= date("i") + $minutes;
	$totalSeconds 	= date("s") + $seconds;
	$timeStamp 		= mktime($totalHours, $totalMinutes, $totalSeconds);
	$myTime 		= date("h:i:s A", $timeStamp);
	return $myTime;
	}

	function convert_timezone($date_time_now, $timezone)
	{
	//$date_time_now	=	"18-6-2013 03:00";
	//$timezone			=	"EST";			
	$time_object = new DateTime($date_time_now);
	$time_object->setTimezone(new DateTimeZone($timezone));
	$DateTime = $time_object->format('Y-m-d h:i:s A');
	return $DateTime;
	}
	
	function total_hours($end, $start)
	{
	$diff				=		$end - $start;
	$h 					= 	ceil(($end - $start)/3600);
	if($h ==1)
	{
	$h	=	$diff / 60 % 60;
	$h	.=" Minutees";
	return  $h;
	}
	else
	{
	$h 		= 	ceil(($end - $start)/3600);
	$h		.=" Hours";
	return $h;
	}
	}
	
	function date_time_difference($time1, $time2, $precision = 6) 
	{
	/*
	Examples :-
	echo dateDiff("2010-01-26", "2004-01-26") . "\n";
	echo dateDiff("2006-04-12 12:30:00", "1987-04-12 12:30:01") . "\n";
	echo dateDiff("now", "now +2 months") . "\n";
	echo dateDiff("now", "now -6 year -2 months -10 days") . "\n";
	echo dateDiff("2009-01-26", "2004-01-26 15:38:11") . "\n";

	6 years
	18 years, 11 months, 30 days, 23 hours, 59 minutes, 59 seconds
	2 months
	6 years, 2 months, 10 days
	4 years, 11 months, 30 days, 8 hours, 21 minutes, 49 seconds

	echo dateDiff(1371552518, 1371052518, 1) . "<br />";
	echo dateDiff(1371552518, time()-1000000, 3) . "<br />";
	echo dateDiff(1371552518, time()-1000000, 6) . "\n";

	5 days
	11 days, 13 hours, 46 minutes
	11 days, 13 hours, 46 minutes, 40 seconds
	*/

	if (!is_int($time1)) 
	{$time1 = strtotime($time1);}
	if (!is_int($time2)) 
	{$time2 = strtotime($time2);}

	if ($time1 > $time2) 
	{
	$ttime = $time1;
	$time1 = $time2;
	$time2 = $ttime;
	}
	$intervals = array('year','month','day','hour','minute','second');
	$diffs = array();
	foreach ($intervals as $interval) {
	$ttime = strtotime('+1 ' . $interval, $time1);
	$add = 1;
	$looped = 0;
	while ($time2 >= $ttime) {
	$add++;
	$ttime = strtotime("+" . $add . " " . $interval, $time1);
	$looped++;
	}
	$time1 = strtotime("+" . $looped . " " . $interval, $time1);
	$diffs[$interval] = $looped;
	}
	$count = 0;
	$times = array();
	foreach ($diffs as $interval => $value) 
	{
	if ($count >= $precision) { break; }

	if ($value > 0) {if ($value != 1) { $interval .= "s"; }
	$times[] = $value . " " . $interval;
	$count++;
	}}
	return implode(", ", $times);
	}
	
}
?>
