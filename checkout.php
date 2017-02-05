<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

if(isset($_POST["submit"]))
{
	if($_POST["checkout_type"]	==	0)
	{
	exit ("<meta http-equiv='refresh' content='0;url=payment-step1.php'>");
	}
	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=account-login.php'>");
	}
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
<p class="head"></p> 



<form name="account_setting" method="post" action="#" onsubmit="return validate_payment_step1()">

<div class="sign-box">
<div class="sign-head-1"><h4>Checkout Type</h4></div>
<div class="sign-middle">
<div class="sign-rdo"></div>
<div class="sign-rdo-1"><input name="checkout_type" type="radio" value="0" checked /><p>Guest User</p></div>
<div class="sign-rdo-1"><input name="checkout_type" type="radio" value="1" /><p>Registered User</p></div><br /><br />
<div><input type="submit" name="submit" value="Submit" class="sunny" style=" pos" /></div>
</div>

<div class="sign-footer">&nbsp;</div>
</div>

</form>

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
