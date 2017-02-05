<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$security		=	new  Security_Framework();

if(isset($_POST["create"]))
{
		$table			=	"customer_details";
		$fields			=	"*";
		$order 			= 	"id"; 
		$limit 			= 	""; 
		$where			=	"1=1";	
		$desc			=	"";
		$limitBegin		=	"0";
		$monitoring 	=	false;
		$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
		foreach($database_query as $r)
		{
		$email_id		=	$r["email_id"];
		}
	
	$rand					= new Random_Variables();
	
	
	if(isset($_POST["check"]))
	{
	$address		=	$_POST["address"];
	}
	
	else
	{
	$address		=	$_POST["address1"];
	}
	
	if($email_id	==	$_POST["email_id"])
	{
	echo'<script>alert("Email ID Already Exists");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=payment-step1.php'>");
	}
	
	$name		=	str_replace(" ","",$_POST["name"]);
	$user_name	=	substr($name,0,7);
	$password	=	$user_name.$rand->rand_number(5);
	
	$data	=	array(
	'id'					=>	"",
	'unique_id' 			=>	$rand->unique_alpha(10),
	'name' 					=>	addslashes($_POST["name"]),
	'email_id' 				=>	addslashes($_POST["email_id"]),
	'contact_no' 			=>	addslashes($_POST["contact_no"]),
	'address' 				=>	addslashes($_POST["address"]),
	'city' 					=>	addslashes($_POST["city"]),
	'postal_code' 			=>	addslashes($_POST["postal_code"]),
	'country' 				=>	addslashes($_POST["country"]),
	'state' 				=>	addslashes($_POST["state"]),
	'shipping_address'		=>	addslashes($address),
	'registered_on'			=>	addslashes(time()),
	'news_letter_suds' 		=>	addslashes($_POST["news_letter_suds"]),
	'user_name'				=>	addslashes($user_name),
	'user_password'			=>	addslashes($security->encrypt($password))
	);
	$x 						= $database->insert_data($table, $data);
	
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
	<td>'.$password.'</td>
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
		echo'<script>alert("Account Details has been forwarded to your email id \n please check your email id & login to proceed payment");</script>';
		exit ("<meta http-equiv='refresh' content='0;url=account-login.php'>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Payment Step1</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javascript" type="text/javascript" src="app/js/payment-step1.js"></script>

<?php include("script1.php");?>
</head>

<body>
<script>
"'article aside footer header nav section time'".replace(/\w+/g,function(n){document.createElement(n)})
</script>

<div id="outer_wrap">

<div class="head-wrap">
<div class="main-content">
<header>
<?php include("design/header.php");?>
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
<?php include("design/nav-searchbox.php");?>
</div>
</div>

<div class="wrap1">

<div class="left-wrap">

<section class="left-upwrap">

<?php
require("design/left-checkout.php");
?>

<article class="leftbox1">
<h1>Sub Categories</h1>
<div class="online-link">
<?php
require("design/left-category.php");
?>
</div> 
</article>



<!--<article class="leftbox">
<div class="left-cartbox">
<h3>compare products</h3>
<p class="com">You have no products to compare</p>

</div>
</article>-->
</section>

<section class="leftbottom-wrap">

<article class="leftbox1">
<div class="online-link">

<div class="link1">
<div class="link1-pic"><img src="images/shop-online.png" /></div>
<p><a href="#">How to buy offline ? </a></p>
</div>

<div class="link1">
<div class="link1-pic"><img src="images/e-book-purchase.png" /></div>
<p><a href="#">Purchase e-books</a></p>
</div>

<div class="link1">
<div class="link1-pic"><img src="images/brochure-icon.png" /></div>
<p><a href="#">Download Brochures</a></p>
</div>

</div> 
</article>


</section>
</div>


<div class="right-wrap"> 
<div class="inner-bookslist-one"> 
<div class="page-link">
<p>&nbsp;</p>
</div> 
<h1>Welcome User</h1>
<p class="head">Please fill form to continue payment process </p> 

<div class="sign-box">
<div class="sign-head"><h4>Your Personal Details</h4></div>
<div class="sign-middle">
<form name="account_setting" method="post" action="#" onsubmit="return validate_payment_step1()">

<input type="text" class="sign-name" name="name" value="Full Name*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  />

<input type="text" class="sign-name" name="email_id" value="Email Id*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  />

<input type="text" class="sign-name" name="contact_no" value="Contact No*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  />

</div>


<div class="sign-footer">&nbsp;</div>
</div>

<div class="sign-box">
<div class="sign-head"><h4>Your Full Address </h4></div>
<div class="sign-middle">

<textarea name="address" id="address" class="sign-area" " onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Addresss 1*</textarea>

<input type="text" class="sign-name" name="city" id="city" value="City*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"   />

<input type="text" class="sign-name" name="postal_code" id="postal_code" value="Postal Code*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"   />

<input type="text" class="sign-name" name="country" id="country" value="Country*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"   />

<input type="text" class="sign-name" name="state" id="state" value="State*" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"   />

</div>
<div class="sign-footer">&nbsp;</div>
</div>


<div class="sign-box">
<div class="sign-head"><h4>Shipping Address</h4></div>
<div class="sign-middle">
<input name="check" type="checkbox" value="" style="margin-left:15px;" /><span style="color:#000;"> Check if shipping address is same as above.</span><br /><br />

<textarea name="address1" id="address1" class="sign-area" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Addresss 1*</textarea>



<div class="sign-footer">&nbsp;</div>
</div>

<div class="sign-box">
<div class="sign-head-1"><h4>Newsletter Subscription</h4></div>
<div class="sign-middle">
<div class="sign-rdo">Subscribe</div>
<div class="sign-rdo-1"><input name="news_letter_suds" type="radio" value="0" checked /><p>Yes</p></div>
<div class="sign-rdo-1"><input name="news_letter_suds" type="radio" value="1" /><p>No</p></div>
</div>
<div class="sign-footer">&nbsp;</div>
</div>

<p class="privacy">I have read & agree to the <a href="#">Terms & Conditions</a><br /><br /></p>
<!--<a href="#"><div class="sunny">Create new account</div></a>-->

<input type="submit" name="create" value="Proceed to payment" class="sunny" />
<!--<input type="submit" name="login_id" value="Login" class="sunny" />
<a href="account-login.php" class="sunny">Login</a>-->
</form>

</div>
</div>


</div>
</div>

</div>

<div class="footer-wrap">
<?php include("design/footer.php");?>
</div>
</div>
</body>
</html>
