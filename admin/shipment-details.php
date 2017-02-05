<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();

if(isset($_POST["search"]))
{
	if(empty($_POST["search_trasaction_id"]))
	{
	echo '<script>alert("Please select transaction id");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=shipment-details.php'>");
	}
	else
	{
	$table			=	"logs_transaction";
	$fields			=	"*";
	$where			=	"product_transaction_id='".$_POST["search_trasaction_id"]."'";
	$order 			= 	"id"; 
	$limit 			= 	"10";  
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	=	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	}
}

else
{
$table			=	"logs_transaction";
$fields			=	"*";
$where			=	"1=1";
$order 			= 	"id"; 
$limit 			= 	"10";  
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	=	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shipment Details</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<?php
require("script1.php");
?>

</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav.php"); ?>

<div class="center_content" style="height:400px; overflow:auto">

<br />
<br />
<h2><img src="images/country.png" alt="" title="" border="0" />&nbsp;Shipment Details</h2>

<table id="rounded-corner">
<form name="shipment-details-form" action="#" method="post">
<tr> 
<td width="50%" align="right"><input type="text" name="search_trasaction_id" id="search_trasaction_id" value="" class="form-inputbox"/></td>
<td width="50%"><input type="submit" name="search" value="Search" style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;" /></td>
</tr>
</table>

<br />

<form name="shipment_details_form" action="#" method="post">
<table id="rounded-corner">
<thead>
<tr align="center">
<th scope="col" class="rounded-company"></th>
<th scope="col" class="rounded">Transaction ID</th>
<th scope="col" class="rounded">Product</th>
<th scope="col" class="rounded">Amount</th>
<th scope="col" class="rounded">Date</th>
<th scope="col" class="rounded">Status</th>
<th scope="col" class="rounded-q4">Edit Status</th>
</tr>
</thead>
<tfoot></tfoot>


<tbody>
<?php
$i	=	0;
if(empty($database_query))
{
	echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '</tr>';
}

else
{
foreach($database_query as $row)
	{
	$i++;
	echo '<tr align="center">';
	echo '<td>'.$i.'</td>';
	echo '<td>'.$row["product_transaction_id"].'</td>';
	echo '<td>'.$row["product_name"].'</td>';
	echo '<td>'.$row["product_amount"].'</td>';
	echo '<td>'.DATE('l, d-M-Y' ,$row["product_transaction_date"]).'</td>';
	echo '<td>'.$row["product_transaction_status"].'</td>';
	echo '<td><a href="edit-status.php?p_id='.$row[" product_transaction_id"].'"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>';
	echo '</tr>';
	}
}
?>


</tbody>
</table>
</form>



</div>   <!--end of center content -->               




<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>


</div>		
</body>
</html>