<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Logout</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav2.php"); ?>

<div style="height:340px;">

<br /><br /><br /><br /><br /><br /><br />
<h2></h2> 

<form name="logout_form" action="#" method="POST">
<div class="warning_box" style="text-align:center; margin-left:150px">
<strong>You have been successfully logged out <br /><br />
You can <a href="index.php">click here</a> to return to login page or wait 3 seconds to get redirect to home page</strong>
</div>
</form>

</div>   <!--end of center content -->               




<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>


</div>		
</body>
</html>

<?php
session_start();
session_destroy();
exit ("<meta http-equiv='refresh' content='2;url=index.php'>");
?>