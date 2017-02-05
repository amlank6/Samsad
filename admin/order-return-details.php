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
<title>Add New Product</title>
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
$( "#tabs" ).tabs();
});
</script>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav.php"); ?>

<div class="center_content" style="height:400px; overflow:auto">

<br />
<h2>Add Order return Details</h2> 

<div id="tabs">
<ul>
<li><a href="#tabs-1">Order Return Details</a></li>
<li><a href="#tabs-2">Products</a></li>
</ul>

<div id="tabs-1">
<table id="rounded-corner" width="98%">
<tr>
<td>Order Id</td>
<td><input type="text" name="order-id" value="" class="form-inputbox" /></td>
</tr>
<tr>
<td>Order Date</td>
<td><input type="text" name="order-date" class="form-inputbox" ></td>
</tr>

<tr>
<td>customer</td>
<td><input type="text" name="customer" class="form-inputbox"></td>
</tr>

<tr>
<td>First Name</td>
<td><input type="text" name="first-name" class="form-inputbox" ></td>
</tr>

<tr>
<td>Last Name</td>
<td><input type="text" name="last-name" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td>Email</td>
<td><input type="text" name="email-id" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td>Phone</td>
<td><input type="text" name="phone" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td colspan="2" align="right" >
<input type="submit" name="add" value="Add" class="bt_blue"/>
</td>
</tr>

</table>
</div>

<div id="tabs-2">
<table id="rounded-corner" width="98%">
<tr>
<td>Products</td>
<td><input type="text" name="model" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td>dgd</td>
<td><select name="tax_class" class="form-inputbox">
<option value="">- Select -</option>
<option value="taxable-goods">Taxable</option>
<option value="downloadable-goods">Non Taxable</option>
</select>
</td>
</tr>

<tr>
<td>Price</td>
<td><input type="text" name="price" class="form-inputbox" ></td>
</tr>

<tr>
<td>Quantity</td>
<td><input type="text" name="meta_tag_desc" class="form-inputbox"></td>
</tr>

<tr>
<td>Minimun Quantity</td>
<td><input type="text" name="meta_tag_desc" class="form-inputbox" ></td>
</tr>

<tr>
<td>Subtract Stock</td>
<td><select name="subtract_stock" class="form-inputbox">
<option value="">- Select -</option>
<option value="yes">Yes</option>
<option value="no">No</option>
</select>
</td>
</tr>

<tr>
<td>Out Of Stock Status</td>
<td><select name="out_of_stock" class="form-inputbox">
<option value="">Out of stock</option>
<option value="2_3_days">2-3 days</option>
<option value="pre_order">Pre_order</option>
</select>
</td>
</tr>
<tr>
<td>Require Shipping</td>
<td><input type="text" name="meta_tag_desc" class="form-inputbox" ></td>
</tr>

<tr>
<td>Date Available</td>
<td><input type="text" name="meta_tag_desc" class="form-inputbox" ></td>
</tr>

<tr>
<td>Weight</td>
<td><input type="text" name="product_name" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td>Status</td>
<td><select name="sort_order" class="form-inputbox">
<option value="">- Select -</option>
<option value="enable">Enabled</option>
<option value="disable">Disabled</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" align="right" >
<input type="submit" name="add" value="Add" class="bt_blue"/>
</td>
</tr>

</table>
</div>

</div>

</div>   <!--end of center content -->               

<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>


</div>		
</body>
</html>