<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Acheivements</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<!---------------------- checkout --------------------------------->
<link rel="stylesheet" href="css/check-out.css" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.inputfocus-0.9.min.js"></script>
<script type="text/javascript" src="js/jquery.main.js"></script>

<!---------------------- checkout --------------------------------->
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



<article class="leftbox1">
<h1> Sub Categories</h1>
<div class="online-link">

<?php
require("design/left-category.php");
?>

</div> 
</article>



<article class="leftbox">
<div class="left-cartbox">
<h3>compare products</h3>
<p class="com">You have no products to compare</p>

</div>
</article>
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
<p>Home > Check out</p>
</div> 
<h1 class="head-one">check out</h1>

<div id="container">
<form action="#" method="post">

<!-- #first_step -->
<div id="first_step">
<h2>Billing Information<br />
<span class="text">Please provide your Payment details bolow and confirm your order</span></h2>

<div class="form">

<div class="check-formbox">
<div class="check-namebox">First Name</div>
<input type="text" name="firstname" id="firstname"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Last Name</div>
<input type="text" name="lastname" id="lastname"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Address</div>
<textarea name="textarea"></textarea>
</div>

<div class="check-formbox">
<div class="check-namebox">Email</div>
<input type="text" name="email" id="email"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Telephone</div>
<input type="text" name="phone" id="phone"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Fax</div>
<input type="text" name="fax" id="fax" />
</div>

<div class="check-formbox">
<div class="check-namebox">Billing Address</div>
<input type="text" name="bill-add" id="bill-add" />
</div>

<div class="check-formbox">
<div class="check-namebox">Username</div>
<input type="text" name="username" id="username" />
</div>

<div class="check-formbox">
<div class="check-namebox"> Password</div>
<input type="password" name="password" id="password1"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Confirm Password </div>
<input type="password" name="password" id="password2" />
</div>

<h3 class="gap1">Payment Details<br />
<span class="text1">Please give your payment details</span></h3>

<div class="check-formbox">
<div class="check-namebox">Your Card Number</div>
<input type="text" name="card-name" id="card-name"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Card Name</div>
<input type="text" name="card-num" id="card-num"/>
</div>

<div class="check-formbox">
<div class="check-namebox">Expiry date</div>
<input type="text" name="expiry-date" id="expiry-date"/>
</div>

</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
<input class="submit" type="submit" name="submit_first" id="submit_first" value="Submit" />
</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->


<!-- #second_step -->
<div id="second_step">
<h2>Delivery Options<br />
<span class="text">Choose the most convenient Delivery Option</span>
</h2>

<div class="form">
<div class="delbox"><input type="radio" class="account1" name="option" id="option" value="Option 1">Option 1</div>
<div class="delbox"><input type="radio" class="account1" name="option" id="option" value="Option 2">Option 2</div>

</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
<input class="submit" type="submit" name="submit_second" id="submit_second" value="Submit" />
</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->


<!-- #third_step -->
<div id="third_step">
<h2>Personal Details</h2>

<div class="form">


<div class="check-formbox">   
<select id="age" name="age">
<option > 0 - 17</option>
<option>18 - 25</option>
<option>26 - 40</option>
<option>40+</option>
</select>
</div>
<!-- clearfix --><div class="clear"></div><!-- /clearfix -->

<div class="check-formbox">
<select id="gender" name="gender">
<option>Male</option>
<option>Female</option>
</select>
</div>
<!-- clearfix --><div class="clear"></div><!-- /clearfix -->

<div class="check-formbox">
<select id="country" name="country">
<option>India</option>
<option>United Kingdom</option>
<option>Canada</option>

</select>
</div>
<!-- clearfix --><div class="clear"></div><!-- /clearfix -->

</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
<input class="submit1" type="submit" name="submit_third" id="submit_third" value="Submit" />

</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->


<!-- #fourth_step -->
<!--<div id="fourth_step">
<h2>Summary</h2>

<div class="form">

<div class="check-formbox">
<div class="check-namebox">Card Holder Name</div>
<input type="text" name="username" id="bill-add" />
</div>

<div class="check-formbox">
<div class="check-namebox">card Number</div>
<input type="text" name="username" id="bill-add" />
</div>


<div class="check-formbox">
<div class="check-namebox">Expiry Date</div>
<input type="text" name="username" id="bill-add" />
</div>

</div> <div class="clear"></div><!-- /clearfix 
<input class="submit" type="submit" name="submit_fourth" id="submit_fourth" value="Submit" />            
</div>-->

<!-- #fifth_step -->
<div id="fourth_step">
<h2>Summary</h2>

<div class="form">


<table>
<tr><td>Username</td><td></td></tr>
<tr><td>Email</td><td></td></tr>
<tr><td>Name</td><td></td></tr>
<tr><td>Age</td><td></td></tr>
<tr><td>Gender</td><td></td></tr>
<tr><td>Phone Number</td><td></td></tr>
<tr><td>Country</td><td></td></tr>
<tr><td>Delivery Option</td><td></td></tr>
<tr><td>Billing Address</td><td></td></tr>
<tr><td>Card name</td><td></td></tr>
<tr><td>card Number</td><td></td></tr>

</table>
</div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
<input class="send submit" type="submit" name="submit_fourth" id="submit_fifth" value="Confirm Order" />            
</div>

</form>
</div>

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
