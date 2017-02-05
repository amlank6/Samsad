<?php
require("app/pages/head.php");
$database			=	new	Database_Framework();
$database			->	connect_database();
$database			->	select_database();

if(isset($_POST["search_by_cat"]))
{
	if($_SESSION["sub_cat"] == 'category')
	{
		echo '<script>alert("Please select category to search")</script>';
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
		
	if($_POST["books"] != "" AND $_POST["author"] != "")
	{
	exit ("<meta http-equiv='refresh' content='0;url=search-list-book.php?p_name=".urlencode($_POST["books"])."&author=".urlencode($_POST["author"])."'>");
	}

	else
	{
		if($_POST["books"] != "")
		{
		exit ("<meta http-equiv='refresh' content='0;url=search-book.php?p_name=".urlencode($_POST["books"])."'>");
		}
		
		if($_POST["author"] != "")
		{
		exit ("<meta http-equiv='refresh' content='0;url=search-author.php?p_author=".urlencode($_POST["author"])."'>");
		}

		if(isset($_SESSION["sub_cat"]) AND $_POST["books"] == "" AND $_POST["author"] == "" AND $_SESSION["sub_cat"] != 'category')
		{
		exit ("<meta http-equiv='refresh' content='0;url=product-listing.php?s_id=".$_SESSION["sub_cat"]."'>");
		}
		}
		if(!isset($_SESSION["sub_cat"]) AND $_POST["books"] == "" AND $_POST["author"] == "" AND $_SESSION["sub_cat"] == 'category')
		{
		echo '<script>alert("Please select category to search")</script>';
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
		}
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product View</title>
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

<div class="leftbox">
<h1>Browse Books</h1>
</div>

<div class="left-innerbox" style="background:#eee; border:1px solid #ccc; margin-left:8px; padding:10px 2px 20px 0px; margin-top:-10px; margin-bottom:8px;">

<?php
if(isset($_POST["category"]))
{
$_SESSION["sub_cat"]	=	$_POST["category"];
}
else
{
$_SESSION["sub_cat"]	=	"category";
}
?>
<div class="bro-cat">Category:</div>
<form name="category_form" method="post">
<select name="category" onchange="this.form.submit()" class="bro-bk">
<option value="category">Category</option>
<?php
$query = mysql_query("SELECT * FROM sub_category ");

if(empty($query))
{
echo '<option value="">&nbsp;</option>';
}
else
{
while($r = mysql_fetch_array($query))
{
$sub_category		=	mb_convert_case($r['name'], MB_CASE_TITLE, "UTF-8");
$s_id				=	$r['unique_id'];

if(isset($_SESSION["sub_cat"]))
{
if($s_id	==	$_SESSION["sub_cat"])
{
echo '<option value="'.$s_id.'" selected="selected" >'.$sub_category.'</option>';
}
else
{
echo '<option value="'.$s_id.'">'.$sub_category.'</option>';
}
}
else
{
echo '<option value="'.$s_id.'">'.$sub_category.'</option>';
}

}
}

?>
</select>

</form>

<?php
/*if(isset($_POST["author"]))
{
$_SESSION["author_name"]		=		$_POST["author"];
//echo ">>>".$_SESSION["author_name"];
}*/
?>


<form name="search_by_category" method="post" action="#">
<div class="bro-cat">Books:</div>
<select name="books" id="books" class="bro-bk">
<option value="">Books</option>
<?php
if(isset($_POST["category"]))
{
$table					=	"product";
$fields					=	"*";
$where					=	"p_sub_category ='".$_POST["category"]."'";
$order 					= 	""; 
$limit 					= 	"";  
$desc					=	"";
$limitBegin				=	"0";
$monitoring 			=	false;
$database_query			=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
foreach($database_query as $r)
{
$name				=	$r['p_name'];
echo '<option value="'.$name.'">'.$name.'</option>';
}
}

?>
</select>

<div class="bro-cat">Author:</div>
<select name="author" id="author" class="bro-bk">
<option value="">Author</option>
<?php
if(isset($_POST["category"]))
{
$query = mysql_query("SELECT * FROM product where p_sub_category='".$_POST["category"]."'");

while($r = mysql_fetch_array($query))
{
echo '<option value="'.$r["p_author"].'">'.$r["p_author"].'</option>';
}
}

?>

</select>

<input type="submit" name="search_by_cat" value="Search" style=" background-image:url(images/footer-button.png);font-size:14px; margin-right:3px;color:#FFF; border:none; cursor:pointer;width:82px;
height:35px;float:right;" />
</form>
</div>

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

<div class="inner-bookslistview">

<div class="book-wrap">
<?php
$table			=	"product";
$table_name		=	"settings_store";
$fields			=	"*";
$where			=	"product_code='".$_GET["pcode"]."'";
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
	$p_pages		=	$row["p_pages"];
	$p_author 		=	$row["p_author"];
	$p_size			=	$row["p_size"];
	$p_price 		=	$row["p_price"];
	$p_inventory 	=	$row["p_inventory"];
	$p_status 		=	$row["p_status"];
	$p_id			=	$row["id"];
	$p_code			=	$row["product_code"];
	$p_description	=	$row["p_description"];
	$p_format		=	$row["p_format"];
	}
if($p_inventory > 0)
{
$inventory	=	"In Stock";
}
else
{
$inventory	=	"Out of Stock";
}
?>

<div class="book-box"><img src="<?php echo $p_image_link; ?>" width="250px" height="380px"/></div>

<div class="book-description">

<div class="book-head1">

<h1><?php echo $p_name; ?></h1>
<p><?php echo $p_author; ?></p>
</div>

<div class="book-rating1">
<p class="book">
Availability	:	<?php echo $inventory; ?><br />
No of Pages		:	<?php echo $p_pages; ?> <br />
Size			:	<?php echo $p_size; ?> <br />
Binding			:	<?php echo $p_format; ?><br />
Price			:	<?php echo $currency." ".$p_price; ?>
</p>

<h2>Quick Overview</h2>
<p><?php echo $p_description; ?></p>
</div>

 <div class="cart-button"><a href="cart.php?action=add&id=<?php echo $p_code; ?>" >Add to Cart</a></div>

<div class="buttonarea1"><p><a href="wishlist.php?action=add&id=<?php echo $p_code; ?>" ><img src="images/wistlist-pic.png" class="pic-cl" />Add To Wish List </a></p></div>

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
