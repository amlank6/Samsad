<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$rand		=	new Random_Variables();
$security	=	new  Security_Framework();
$messege	=	"";

if(isset($_POST["save"]))
{
	$rand					= new Random_Variables();
	$table_name				=	"customer_details";
	
		$table			=	"customer_details";
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
		$user_password	=	$security->decrypt($r["user_password"]);
		$user_Full_name	=	$r["name"];
		$date			=	date('l, d - F - Y',$r["registered_on"]);
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
		
		<tr>
		<td>Registration Date :- &nbsp;</td>
		<td>'.$date.'</td>
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
			$headers[] 	=	$message_content;
			mail($to, $subject,'' , implode("\r\n", $headers));
			echo'<script>alert("Account Details has been forwarded to your email id \n please check your email id ");</script>';
			exit ("<meta http-equiv='refresh' content='3;url=account-login.php'>");
		}
	
	else
	{
	$messege	=	"Invalid Email ID , Please try again ";
	/*echo'<script>alert("Invalid Email Id Please Try Again");</script>';
	exit ("<meta http-equiv='refresh' content='o;url=forget-password.php'>");*/
	}
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Forgot Password</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
<div id="outer_wrap">

<div class="head-wrap">
<div class="main-content">
<header>
<? include("design/header.php")?>
</header>
</div>
</div>

<div class="inner-wrap">
<div class="main-content">

<div class="nav-area">

<div class="navigationarea">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<div class="nav-sep1"></div>
<li><a href="about-us.php">About Us</a></li>
<div class="nav-sep1"></div>
<?php
require("category-menu.php");
?>
<div class="nav-sep1"></div>
<li><a href="acheivements.php">Achievments</a></li>
<div class="nav-sep1"></div>
<li><a href="contact.php">Contact Us</a></li>
</ul>
</nav>
</div>

<div class="nav-rightarea">
<? include("design/nav-searchbox.php")?>
</div>
</div>


<div class="wrap1">
  <div class="innerpage-content">
  <h1>Reset your Password</h1>

  <div class="foget-box">
   <p>Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.</p>
  </div>
<!--<div class="page-link">
<p>Home > Registration </p>
</div>--> 
<!--<h1>Reset Password</h1>-->
<!--<div class="account-left">
<h3>New Customer</h3>
<p>By creating an account you will be able to shop faster, be up to date on an 
order's status, and keep track of the orders you have previously made.</p>
<a href="#" class="btn">Create Account</a>
</div>-->

<div class="sign-boxlog">

 <!-- <div class="sign-boxloghead">Reset Your Password</div>-->
<form name="account_setting" method="post" action="#" onsubmit="return validate_payment_step1()">

<input type="text" class="sign-name1" name="email_id" value="Enter Your Email Id" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  maxlength="45"/>

<div class="login-button2"><input type="submit" name="save" class="btn" value="Submit" /></div>
</form>
</div>

<div class="red-mbox">
<h3><?php echo $messege; ?></h3>

</div>


</div>
<!--<div class="account-right">
<h3>Registered Customer</h3>
<p>&nbsp;&nbsp;&nbsp;</p>
<form name="login_form" action="#" method="post">

<input type="text" name="user_name" value="Your User Name" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" class="acount-name"  />

<input type="text" name="user_password" value="Password" onblur="this.value=!this.value?'Password':this.value;" onfocus="this.select()" onclick="if (this.value=='Password'){this.value=''; this.type='password'}"  class="acount-name" size="20"  />

<input type="submit" name="login" class="btn" value="Login" />

</div>--> 

</div>

</div>

</div>

<div class="footer-wrap">
<? include("design/footer.php")?>
</div>
</div>
</body>
</html>
