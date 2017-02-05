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
<title>Headers</title>
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
<h2><img src="images/header-footer.png" alt="" title="" border="0" />&nbsp;Headers</h2>

<table id="rounded-corner" width="98%">
<thead>
<tr align="center">
<th scope="col" class="rounded-company">Headers</th>
<th scope="col" class="rounded">&nbsp;</th>
<th scope="col" class="rounded-q4">&nbsp;</th>

</tr>
</thead>
<tfoot></tfoot>
<tbody>
<tr>

</tr>
<tr align="center">
<td>header.php</td>
<td><a href="#">View</a></td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="3">
<a href="add-new-header.php" class="bt_blue"><span class="bt_blue_lft"></span><strong>Add New Header</strong><span class="bt_blue_r"></span></a>
<input type="submit" name="delete" value="Delete Item" style="background: url(images/button_bg.png) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #c24739; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;" />
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