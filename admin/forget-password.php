<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$messege		=		"";
if(isset($_POST["submit"]))
{
	$rand					= new Random_Variables();
	$table_name				=	"customer_details";
	
		$table			=	"user_details";
		$fields			=	"*";
		$order 			= 	"id"; 
		$limit 			= 	""; 
		$where			=	"email_id='".$_POST["email_id"]."'";	
		$desc			=	"";
		$limitBegin		=	"0";
		$monitoring 	=	false;
		$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
		$count			=	$database->count_rows($table_name, $where);
		foreach($database_query as $r)
		{
		$user_email		=	$_POST["email_id"];
		$user_name		=	$r["user_name"];
		$user_password	=	$r["user_password"];
		$user_Full_name	=	$r["user_first_name"]." ".$r["user_last_name"];
		
		}
		
		if($count > 0)
		{
		$to					=		$_POST["email_id"];
		$message_content	= 
		'
		<html>
		<head></head>
		<body>
		<br/>
		<strong>Login Details</strong><br />
		<hr />
		<table>

		<tr>
		<td>User Name :- &nbsp;</td>
		<td>'.$user_name.'</td>

		</tr>

		<tr>
		<td>Password :- &nbsp;</td>
		<td>'.$user_password.'</td>
		</tr>
		
		<tr>
		<td>Full name :- &nbsp;</td>
		<td>'.$user_Full_name.'</td>
		</tr>

		</table>
		<hr />
		</body>
		</html>
		';
			$subject	=	"Login Details";
			$headers	=	array();
			$headers[] 	=	"MIME-Version: 1.0";
			$headers[] 	=	"Content-type: text/html; charset=iso-8859-1";
			$headers[] 	=	"From: ".$_POST["email_id"];
			$headers[] 	=	"Cc: ";
			$headers[]	=	"Reply-To: ".$_POST["email_id"];
			$headers[] 	=	"X-Mailer: PHP/".phpversion();
			
			mail($to, $subject,$message_content , implode("\r\n", $headers));
			echo'<script>alert("Account Details has been forwarded to your email id \n please check your email id ");</script>';
			exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
		}
	
	else
	{
	$messege	=	"Invalid Email ID! Please try again ";
	/*echo'<script>alert("Invalid Email Id Please Try Again");</script>';
	exit ("<meta http-equiv='refresh' content='o;url=forget-password.php'>");*/
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
<th scope="col" class="rounded-company" style="font-size:11px"><strong>FORGET PASSWORD</strong></th>
<th scope="col" class="rounded-q4" ></th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>

<tr>
<td width="40%">Email ID</td>
<td><input type="text" name="email_id" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="Email ID" class="form-inputbox" />
</td>
</tr>
<tr>
<td colspan = "2"> 
<input type="submit" name="submit" value="ENTER" style="float:right"/>
</td>
</tr>

</tbody>
</table>
<h3><?php echo $messege; ?></h3>
</form>

</div>

<div class="clear"></div>
</div> <!--end of main content-->

</div>
</body>
</html>