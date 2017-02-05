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
<title>Samsad - Refund Policy</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
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

<!--<div class="nav-area">

<div class="navigationarea">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<div class="nav-sep1"></div>
<li><a href="about-us.php" class="active">About Us</a></li>
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
</div>-->

<div class="wrap1">

<div class="innerpage-content">

<!--<section class="page-link">
<p>Home > About Us</p>
</section>-->

<h1>Refund Policy</h1>
<p>There could be certain circumstances beyond our control where you could receive a damaged / defective product or a product that is not the same as per your original order. We will replace the product to your satisfaction at no extra cost. In such circumstances, before using the product, please get in touch with our Customer Service Team who will guide you on the process for the same at </p>

<p>* Our 24 hour call centre @ 0120-4455918.<br />
 The return process of the product can be restricted depending on the nature and category of the product.</p>


<div class="privacy-box">Conditions for Return</div>

<ol>

<li>Please notify us of receipt of a Damaged / Defective product within maximum 48 hours of delivery.</li>
<li>Products/Items should be UNUSED.</li>
<li>Products should be returned in their original packaging along with the original price tags, labels and invoices.</li>
<li>It is advised that the return packets should be strongly and adequately packaged so that there is no further damage of goods in transit.</li>

</ol>

<div class="privacy-box">Refunds</div>
<p>We will process the refund after receipt of the product by Homeshop18 or its business partner. Refund will be processed based on the mode of payment of the order</p>

<ol>
   <li>Orders paid by credit/ debit card will be refunded by credit back to the credit/ debit card within 7 working days and the refund will reflect in the next statement.</li>
    <li>Orders paid by net banking accounts will be credited back to bank account.</li>
    <li>For all other modes of payment, we will send a refund cheque. The cheque will be made in favor of the name as in the "billing name" provided at the time of placing the order.</li>
    
    <p>For orders placed through Gift Certificates / Vouchers of HomeShop18, refund would be provided in form of a fresh Gift Certificate / Voucher of the same value. </p>



</ol>

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
