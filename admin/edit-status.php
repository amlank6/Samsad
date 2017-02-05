<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();

	$table			=	"logs_transaction";
	$fields			=	"*";
	$where			=	"1=1";
	$order 			= 	"id"; 
	$limit 			= 	"";  
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	=	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	foreach($database_query as $row)
	{
	$product_transaction_date	=	$row["product_transaction_date"];
	$product_transaction_status	=	$row["product_transaction_status"];
	}
	
if(isset($_POST["edit"]))
{
	$where1						=	"product_transaction_id='".$_GET["p_id"]."'";
	$date1						=	strtotime($_POST["datepicker"]);
	$data						=	array(
	'product_transaction_status'=>	$_POST["status"],
	'courier_id'				=>	addslashes($_POST["courier_id"]),
	'product_transaction_date'	=>	$date1,
	'courier_name'				=>	addslashes($_POST["courier_name"]),
	'courier_delivery_date'		=>	addslashes($_POST["courier_delivery_date"]),
	'courier_charges'			=>	addslashes($_POST["courier_amount"])
	);

	$x			=	$database->update_data($table, $data, $where1);
	if($x		=	'1')
	{
	echo '<script>alert("Data update successfull");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=transaction-details.php'>");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Status</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#datepicker").datepicker({dateFormat: 'd/m/yy'});
});

$(function() {
$( "#courier_delivery_date").datepicker({dateFormat: 'd/m/yy'});
});
</script>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav.php"); ?>

<div class="center_content" style="height:400px;">

<br />
<h2>Edit Status</h2> 

<form name="edit_status_form" action="#" method="POST">
<table id="rounded-corner" width="98%">
<thead>
<tr>
<th scope="col" class="rounded-company">&nbsp;</th>
<th scope="col" class="rounded-q4">&nbsp;</th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>

<tr>
<td width="40%">Status</td>
<td>
<select name = "status" class="form-inputbox">
<option value="Shipped" <?php if($product_transaction_status == "Shipped") { echo "selected=\"selected\""; } ?>>Shipped</option>
<option value="Un-shipped" <?php if($product_transaction_status == "Un-shipped") { echo "selected=\"selected\""; } ?>>Un-shipped</option>
</select>
</td>
</tr>

<tr>
<td>Date</td>
<td><input type="text" name="datepicker" id="datepicker" value="<?php echo date("d/m/Y ",$product_transaction_date); ?>" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Courier Id</td>
<td><input type="text" name="courier_id" value="" class="form-inputbox" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Courier Name</td>
<td><input type="text" name="courier_name" value="" class="form-inputbox" />
</td>
</tr>

<tr>
<td>Courier Delivery Date</td>
<td><input type="text" name="courier_delivery_date" id="courier_delivery_date" value="" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Courier Charges</td>
<td><input type="text" name="courier_amount" value="" class="form-inputbox"/>
</td>
</tr>


<tr>
<td colspan="2" align="center">
<input type="submit" name="edit" value="Edit Status" style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;" />
</td>
</tr>

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