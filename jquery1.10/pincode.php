<?php
$mysql_server	= 'localhost';
$mysql_login	= 'sambook_samsad';
$mysql_password = 'w5HoM<4m6D@<Yst';
$mysql_database = 'sambook_samsad';

mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT pincode_list "
	."FROM list_pincode "
	."WHERE pincode_list LIKE '".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['pincode_list']);
}

echo json_encode($results);
?>