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
<title>Search</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<!----------------------------------colorbox ------------------------------------>

<link type="text/css" media="screen" rel="stylesheet" href="css/colorbox.css" />
<script type="text/javascript" src="js/download-colorbox.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
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

<!----------------------------------colorbox ------------------------------------>
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

<<article class="leftbox1">
<h1>Sub Categories</h1>
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



<div class="inner-bookslist">

<section class="productlist-head">
<p></p>

<article class="productlist-right">
<div class="pro-textbox">Sort By</div>
<div class="pro-selectbox">
<select class="pro-select">
<option selected="selected">Name</option>
<option>Name1</option>
<option>Name2</option>
</select>
</div>

<div class="pro-downarrow"><img src="images/down-arrow.png" /></div>

<div class="pro-textbox">Show</div>
<div class="pro-selectbox1">
<select class="pro-select1">
<option selected="selected">9</option>
<option>12</option>
<option>15</option>
</select>
</div>
<div class="pro-textbox1">per page</div>
</article>
</section>

<?php
$table			=	"product";
$table_name		=	"settings_store";
$fields			=	"*";
$where			=	"p_name='".$_GET["p_name"]."'";
$where1			=	"1=1";
$order 			= 	"id";
$limit 			= 	"";
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	= 	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

	if(empty($database_query))
	{
	echo '&nbsp;';
	}
	else
	{
	foreach($database_query1 as $x)
	{
	$currency			=	$x["currency"];
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
	}

echo '<form name="book_form" action="#" method="post">';
	echo '<article class="home-bookbox">';
	echo '<a href="product-view.php?pcode='.$p_code.'">';
	echo '<div class="main-box"> ';
	echo '<div class="book-pic"><img src="'.$p_image_link.'" alt="" title="" border="0" width="123" height="160" /></div>';
	echo '<div class="book-text">';
	echo '<h3>'.$p_name.'</h3>';
	echo '</div>';
	echo '</div></a>';
	echo '<div class="book-pricebox">';
	echo '<p>'.$currency."".$p_price.'</p>';
	echo '<div class="book-cartbutton"><a href="cart1.php?action=add&id='.$p_code.'" >Add to Cart</a></div>';
	echo '</div></a>';
	echo '</article>';
	echo "</form>";

?>

<!--<div class="pagination">
<ul>
<li><a href="#" class="pre">Previous</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#" class="pre">Next</a></li>
</ul>
</div>-->



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
