<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$rand		=	new Random_Variables();
$security	=	new  Security_Framework();

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
		
		foreach($database_query as $r)
		{
		$user_email		=	$_POST["email_id"];
		$user_name		=	$r["user_name"];
		$user_password	=	$security->decrypt($r["user_password"]);
		$user_Full_name	=	$r["name"];
		$date			=	date('l, d - F - Y',$r["registered_on"]);
		}
		
	
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
		echo'<script>alert("Your user name and password has been send to your mail id \n please chack it");</script>';
		exit ("<meta http-equiv='refresh' content='3;url=user-demo.php'>");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Account Settings</title>
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
<p>Home > Registration </p>
</div> 

<div class="sign-box">
<div class="sign-head"></div>
<div class="sign-middle">
<form name="" action="#" method="post" >
<input type="text" name="email_id" value="" />
<input type="submit" name="save" value="Submit" />
</form>
</div>
<div class="sign-footer">&nbsp;</div>
</div>

<!--<a href="#"><div class="sunny">Create new account</div></a>-->

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
