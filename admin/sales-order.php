<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order List</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav.php"); ?>

<div class="center_content" style="height:400px; overflow:auto">

<br />
<h2><img src="images/order.png" alt="" title="" border="0" />&nbsp;Order List</h2> 

<table id="rounded-corner" width="98%">
<thead>
<tr align="center">
<th scope="col" class="rounded-company"></th>
<th scope="col" class="rounded">Order Id</th>
<th scope="col" class="rounded">Purchased On</th>
<th scope="col" class="rounded">Customer Name</th>
<th scope="col" class="rounded">Status</th>
<th scope="col" class="rounded">Amount</th>

</tr>
</thead>
<tfoot></tfoot>
<tbody>
<tr>

</tr>
<tr align="center">
<td><input type="checkbox" name="" /></td>
<td>00112</td>
<td>7/02/2013</td>
<td>Sandipa sarkar</td>
<td>Under Process</td>
<td>2500</td>
</tr>

<tr align="center">
<td><input type="checkbox" name="" /></td>
<td>00112</td>
<td>7/02/2013</td>
<td>Sandipa sarkar</td>
<td>Under Process</td>
<td>2500</td>
</tr>


<tr>
<td colspan="8">
<a href="#" class="bt_red"><span class="bt_red_lft"></span><strong>Delete</strong><span class="bt_red_r"></span></a>
</td>
</tr>




</tbody>
</table>

</div>   <!--end of center content -->               




<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>

</div>
</body>
</html>