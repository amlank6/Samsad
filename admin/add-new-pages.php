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
<title>Add New Page</title>
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
<h2>Add New Page</h2> 

<div id="tabs">
<ul>
<li><a href="#tabs-1">Page Information</a></li>
<li><a href="#tabs-2">Meta Data</a></li>
</ul>

<div id="tabs-1">
<form name="tabs-1-form" method="post" action="#">
<table id="rounded-corner" width="98%">
<tr>
<td>Page Title</td>
<td><input type="text" name="page-title" value="" class="form-inputbox" /></td>
</tr>

<tr>
<td>URL Key</td>
<td><input type="text" name="url-key" class="form-inputbox" ></td>
</tr>

<tr>
<td>Status</td>
<td><select name="status" class="form-inputbox">
<option value="">- Select -</option>
<option value="enable">Enable</option>
<option value="disable">Disable</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" align="right" >
<input type="submit" name="add" value="Add" class="bt_blue"/>
</td>
</tr>

</table>
</form>
</div>

<div id="tabs-2">
<form name="tabs-2-form" method="post" action="#">
<table id="rounded-corner" width="98%">
<tr>
<td>Meta Tag Keywords</td>
<td><input type="text" name="meta-tag-keys" class="form-inputbox"></td>
</tr>

<tr>
<td>Description</td>
<td><textarea type="text" name="decription" id="decription" class="form-inputbox" ></textarea></td>
</tr>

<tr>
<td colspan="2" align="right" >
<input type="submit" name="add" value="Add" class="bt_blue"/>
</td>
</tr>

</table>
</form>
</div>
</div>

</div>   <!--end of center content -->

<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>


</div>		
</body>
</html>