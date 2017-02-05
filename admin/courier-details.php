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
<title>Courier Management</title>
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
<h2><img src="images/folder.png" alt="" title="" border="0" />&nbsp;Courier Management</h2> 
<br />
<table id="rounded-corner" width="98%">
<thead>
<tr align="center">
<th scope="col" class="rounded-company">&nbsp;</th>
<th scope="col" class="rounded">Courier Name</th>
<th scope="col" class="rounded">Courier Destination</th>
<th scope="col" class="rounded-q4">Courier Weight</th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>
<tr align="center">
<td>1</td>
<td>Courier Name</td>
<td>Courier Destination</td>
<td>Courier Weight</td>
</tr>

<tr align="center">
<td>2</td>
<td>Courier Name</td>
<td>Courier Destination</td>
<td>Courier Weight</td>
</tr>

<tr>
<td colspan="2" align="right"><b>Upload File</b></td>
<td colspan="2"><input type="file" name="files[]" multiple="true" /></td>
</tr>
<tr>
<td colspan="4" align="center">
<br />(Please Upload csv Files Only)
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