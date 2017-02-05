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
<title>Error Logs</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;"/></div>


<?php require ("design/nav.php"); ?>

<div class="center_content" style="height:400px; overflow:auto">

<br />
<h2><img src="images/home.png" alt="" title="" border="0" />&nbsp;Error Logs</h2> 
<center><input type="text" name="search_input" value="" /><input type="submit" name="search" value="Search" /></center>
<br />
<table id="rounded-corner" width="98%">
<thead>
<tr align="center">
<th scope="col" class="rounded-company">&nbsp;</th>
<th scope="col" class="rounded">Order Id</th>
<th scope="col" class="rounded">Purchased Date</th>
<th scope="col" class="rounded">Register Id</th>
<th scope="col" class="rounded-q4">Status</th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>
<tr align="center">
<td>1</td>
<td>011</td>
<td>26/07/1986</td>
<td>01abcd</td>
<td>Enabled</td>
</tr>

<tr align="center">
<td>2</td>
<td>012</td>
<td>26/07/1986</td>
<td>01efgh</td>
<td>Enabled</td>
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