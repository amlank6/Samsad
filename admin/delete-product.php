<?php
if(isset($_POST["check"]))
{
$database1	=	new Database_Framework;
$database1	->	connect_database();
$database1	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();
	foreach ($_POST["check"] as $value)
	{
	$table_name			=	"product";
	$where			=	"unique_id='".$value."'";
	$database1		->	delete_data($table_name, $where);
	}
	echo '<script>alert("Selected Product Has Been Deleted")</script>';
	exit ("<meta http-equiv='refresh' content='0;url=product.php'>");
}
?>