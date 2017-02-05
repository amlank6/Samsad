<?php
require("app/pages/head.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Product Listing</title>
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
$(".example7").colorbox({width:"66%", height:"77%", iframe:true});
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
<?php include("design/header.php")?>
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
<?php include("design/nav-searchbox.php")?>
</div>
</div>

<div class="wrap1">

<div class="left-wrap">

<section class="left-upwrap">

<article class="leftbox">
<div class="left-cartbox">
<h2>cart</h2>
<p>No Products</p>

<div class="cart-formbox">
<div class="cart-left">Free Shipping</div>
<div class="cart-right">Free Shipping!</div>
</div>

<div class="cart-formbox">
<div class="cart-left">Total Items</div>
<div class="cart-right">0.00</div>
</div>

<div class="checkout-button"><a href="#">check out</a></div>

</div>
</article>

<article class="leftbox">
<h1>Categories</h1>
<div class="left-innerbox">
<ul>
<li><a href="#">Lorem ipsum dolor sit amet consectetuer adipi</a></li>
<li><a href="#">scing elit</a></li>
<li><a href="#">Nam cursus. Morbi ut mi. Nullam enim leo</a></li>
<li><a href="#">egestas id</a></li>
<li><a href="#">umat laoreet mattis, massa. Sed eleifend non</a></li>
<li><a href="#">Praesent mauris ante elementum</a></li>

</ul> 
</div>
</article>

<article class="leftbox">
<h1>browse by authors</h1>
<div class="left-innerbox">
<ul>
<li><a href="#">Lorem ipsum dolor sit amet consectetuer adipi</a></li>
<li><a href="#">scing elit</a>
<ul>
<li>Nam cursus Morbi ut mi</li>
<li>umat laoreet mattis</li>
<li>Praesent mauris ante</li>
<li>sit amet, nibh vestibulum</li>
</ul>
</li>
<li><a href="#">Nam cursus. Morbi ut mi. Nullam enim leo</a></li>
<li><a href="#">egestas id</a></li>
<li><a href="#">umat laoreet mattis, massa. Sed eleifend non</a></li>
<li><a href="#">Praesent mauris ante elementum</a></li>

</ul> 
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

<article class="leftbox">
<h1>subscribe To our newsletter</h1>
<div class="left-innerbox">
<p class="newsletter">Lorem ipsum dolor sit amet, consectetuer adipis cing g elit. Nam cursus. Morbi ut </p>
<form>
<div class="news-formbox"><input type="text" class="news-inputbox"  value="Enter Your name"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>
<div class="news-formbox"><input type="text" class="news-inputbox" value="Enter Your Email Id"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>

<div class="news-button"><input type="submit" class="news-buttonbox" value="subscribe" /></div>
</form>
</div>
</article>

</section>
</div>

<div class="right-wrap">



<div class="inner-bookslist">


<?php
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$first_level_cats = mysql_query("SELECT * FROM sub_category where id='".$_GET['s_id']."'");
while($row = mysql_fetch_array($first_level_cats))
{
$sub_category_name	=	$row['name'];
}
echo '<div class="page-link">';
echo '<p>Home > Books > '.$sub_category_name.'</p>';
echo '</div>';
echo '<h1>'.$sub_category_name.'</h1>';
echo '<p class="head">'.$sub_category_name.'</p>';
?>
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

<div class="product-wrap">
<?php
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

$table			=	"product";
$fields			=	"*";
$where			=	"p_sub_category='".$_GET["s_id"]."'";
$order 			= 	"id";
$limit 			= 	"";
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	= 	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);


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

	echo '<form name="book_form" action="#" method="post">';
	echo '<article class="home-bookbox">';
	echo '<a href="product-view.php"?pcode='.$p_code.'">';
	echo '<div class="main-box"> ';
	echo '<div class="book-pic"><img src="../admin/'.$p_image_link.'" alt="" title="" border="0" width="123" height="160" /></div>';
	echo '<div class="book-text">';
	echo '<h3>'.$p_name.'</h3>';
	echo '<p>'.$p_author.'</p>';
	echo '</div>';
	echo '</div></a>';
	echo '<div class="book-pricebox">';
	echo '<p>Rs.'.$p_price.'/-</p>';
	echo '<div class="book-cartbutton"><a href="cart1.php?action=add&id='.$p_code.'" >Add to Cart</a></div>';
	echo '</div></a>';
	echo '</article>';
	echo '<input type="hidden" name="code" value="'.$p_code.'" />';
	echo '<input type="hidden" name="name" value="'.$p_name.'" />';
	echo "</form>";
	
}
?>

</div>

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
