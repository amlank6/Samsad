<?php
require("app/pages/head.php");

if(isset($_SESSION["user_token"]) AND $_SESSION["user_name"])
{
exit ("<meta http-equiv='refresh' content='0;url=dashboard.php'>");
}

else
{
if(isset($_POST['submit']))
{
$database			=	new Database_Framework();
$encrypt1			=	new Security_Framework();
$database			->	connect_database();
$database			->	select_database();


$user_name			=	addslashes($_POST['user_name']);
$user_password		=	addslashes($_POST['user_password']);
$table_name			=	"user_details";
$fields1			=	"user_name='$user_name' AND user_password='$user_password'";
$login_check		=	$database->count_rows($table_name, $fields1);
	if($login_check	==	1)
	{
		$_SESSION["user_name"]			=	$user_name;
		$_SESSION["user_token"] 		=	md5(session_id());
		exit ("<meta http-equiv='refresh' content='0;url=dashboard.php'>");
	}
	else
	{
		session_destroy();
		echo '<script> alert("Invalid Username/Password");</script>';
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome Samsad Admin</title>
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

<div class="login_content" style="height:340px; overflow:auto">

<br /><br /><br />
<h2>&nbsp;</h2> 

<form name="login_form" action="#" method="post">
  <table id="rounded-corner" width="80%">
<thead>
<tr>
<th scope="col" class="rounded-company" style="font-size:11px"><strong>AUTHENTICATION</strong></th>
<th scope="col" class="rounded-q4" ></th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>

<tr>
<td width="40%">User Name</td>
<td><input type="text" name="user_name" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="User Name" class="form-inputbox" />
</td>
</tr>

<tr>
<td width="40%">Password</td>
<td><input type="password" name="user_password" id="user_password" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="marketing" class="form-inputbox"/>
</td>
</tr>

<tr>
<td><a href="forget-password.php">Forget Password</a></td>
<td>
<input type="submit" name="submit" value="LOGIN" style="float:right"/>
</td>
</tr>

</tbody>
</table>
</form>

</div>

<div class="clear"></div>
</div> <!--end of main content-->

</div>
</body>
</html>