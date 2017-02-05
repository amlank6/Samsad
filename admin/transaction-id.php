<?php
$mysql_server	= 'localhost';
$mysql_login	= 'myholida_test';
$mysql_password = 'ritalin1986';
$mysql_database = 'myholida_samsad';

mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT product_transaction_id "
	."FROM logs_transaction "
	."WHERE product_transaction_id LIKE '%".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['product_transaction_id']);
}

echo json_encode($results);
?>