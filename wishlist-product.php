<?php
require("app/pages/head.php");
$database			=	new	Database_Framework();
$database			->	connect_database();
$database			->	select_database();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wish List Product</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link href="css/product-view.css" rel="stylesheet" type="text/css" />


<!----------------------------------colorbox ------------------------------------>
<script src="jquery1.10/jquery.min17.js"></script>
<link type="text/css" media="screen" rel="stylesheet" href="css/colorbox.css" />
<script src="colorbox/jquery.colorbox.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function($){
//Examples of how to assign the ColorBox event to elements
$("a[rel='example1']").colorbox();

$("a[rel='example2']").colorbox({transition:"fade"});
$("a[rel='example3']").colorbox({transition:"none", width:"740", height:"600"});
$("a[rel='example4']").colorbox({slideshow:true});
$(".example5").colorbox();
$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
$(".example7").colorbox({width:"66%", height:"79%", iframe:true});
$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
$(".example9").colorbox({
onOpen:function(){ alert('onOpen: colorbox is about to open'); },
onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
});

//Example of preserving a JavaScript event for inline calls.
$("#click").click(function(){ 
$('#click').css({"background-color":"#000", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
return false;
});
});
</script>
<!------------------------end colorbox------------------------------>
<noscript><meta http-equiv="refresh" content="0; URL=jsdisabled.php"></noscript>
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
<li><a href="acheivements.php">Achievements</a></li>
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

<<article class="leftbox1">
<h1>Sub Categories</h1>
<div class="online-link">

<?php
require("design/left-category.php");
?>



</div> 
</article>

<article class="leftbox">
<!--<div class="left-cartbox">
<h3>compare products</h3>
<p class="com">You have no products to compare</p>

</div>-->
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

<div class="inner-bookslist">

<div class="book-wrap">
<?php
$table			=	"product";
$table_name		=	"settings_store";
$fields			=	"*";
$where			=	"product_code='".$_GET["id"]."'";
$where1			=	"1=1";
$order 			= 	"id";
$limit 			= 	"";
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	= 	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

$database_query1	=$database->fetch_data($table_name, $fields, $where1, $order, $limit, $desc, $limitBegin, $monitoring);

foreach($database_query1 as $row)
{
	$currency	=	$row["currency"];
}


	foreach($database_query as $row)
	{
	$p_image_link 	=	$row["p_image_link"];
	$p_name 		=	$row["p_name"];
	$p_author 		=	$row["p_author"];
	$p_price 		=	$row["p_price"];
	$p_inventory 	=	$row["p_inventory"];
	$p_status 		=	$row["p_status"];
	$p_id			=	$row["id"];
	$p_code			=	$row["product_code"];
	$p_description	=	$row["p_description"];
	$p_format		=	$row["p_format"];
	}
?>

<div class="book-box"><img src="<?php echo $p_image_link; ?>" width="250px" height="380px"/></div>

<div class="book-description">

<div class="book-head1">

<h1><?php echo $p_name; ?></h1>
<p><?php echo $p_author; ?></p>
</div>

<div class="book-rating1">
<p class="book">Availability :  In stock<br />
Binding : <?php echo $p_format; ?><br />
Price : <?php echo $currency." ".$p_price; ?></p>

<h2>Quick Overview</h2>
<p><?php echo $p_description; ?></p>
</div>

 <div class="cart-button"><a href="cart.php?action=add&id=<?php echo $p_code; ?>" >Add to Cart</a></div>

<!-- 
<div class="buttonarea1"><p><a href="wishlist.php?action=add&id=<?php echo $p_code; ?>" ><img src="images/wistlist-pic.png" class="pic-cl" />Add To Wish List </a></p></div>

-->

</div>



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
