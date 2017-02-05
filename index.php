<?php
ob_start();
require("app/pages/head.php");
$database						=	new	Database_Framework();
$database						->	connect_database();
$database						->	select_database();

$cache							=	new cache_tools();
$check_cache					=	$cache->check_cache_lifetime();

if(isset($_POST["search"]))
{
	if(empty($_POST["search_input"]))
	{
	echo '<script>alert("Please enter book name");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=search-book.php?p_name=".$_POST["search_input"]."'>")	;
	}
}

if(isset($_POST["news_letter"]))
{
	
	$rand						= 	new Random_Variables();
	$table_name					=	"customer_details";
	$fields						=	"*";
	$where						=	"email_id='".$_POST["Email"]."'";
	$order 						= 	"id"; 
	$limit 						= 	"";  
	$desc						=	"";
	$limitBegin					=	"0";
	$monitoring 				=	false;
	$database_query				=	$database->fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	$count						=	$database->count_rows($table_name,$where);
	
	if($count	>	0)
	{
	$data	=	array(
	'news_letter_suds' 	=>	"1"
	);
	$where				=	"email_id='".$_POST["Email"]."'";
	$x					=	$database->update_data($table_name, $data, $where);

	if($x				==	"1")
	{
	echo'<script>alert("Thank you for subscribing newsletter");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
	}
	else
	{
	$data				=	array(
	'id'				=>	"",
	'unique_id' 		=>	$rand->unique_alpha(10),
	'name' 				=>	addslashes($_POST["Name"]),
	'email_id' 			=>	addslashes($_POST["Email"]),
	'contact_no' 		=>	"",
	'address' 			=>	"",
	'city' 				=>	"",
	'postal_code' 		=>	"",
	'country' 			=>	"",
	'state' 			=>	"",
	'registered_on'		=>	addslashes(time()),
	'news_letter_suds' 	=>	"1"
	);

	$x					=	$database	->insert_data($table_name, $data);
	if($x			==	"1")
	{
	echo'<script>alert("Thank you for subscribing newsletter");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
}
}


if(isset($_POST["search"]))
{
	if(empty($_POST["search_input"]))
	{
	echo '<script>alert("Please enter book name");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}

	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=search-book.php?p_name=".$_POST["search_input"]."'>");
	}
	}

	if(isset($_POST["search1"]))
	{
	if(empty($_POST["search_input2"]))
	{
	echo '<script>alert("Please enter author name");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}

	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=search-author.php?p_author=".$_POST["search_input2"]."'>");
	}
	}

if(isset($_POST["search_category"]))
{
	if(empty($_POST["category_input"]))
	{
	echo '<script>alert("Please enter category name");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}

	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=product-listing.php?s_id=".$_POST["category_input"]."'>");
	}
}

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



if($check_cache == 0)
{
$filename	=	"cache/".md5($cache->getUrl());
require($filename);
exit();
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Samsad</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />



<!--crawler-->
<!--<link rel="stylesheet" type="text/css" href="css/gallerystyle.css" />-->

<!-- Do not edit IE conditional style below -->
<!--[if gte IE 5.5]>
<style type="text/css">
#motioncontainer {
width:expression(Math.min(this.offsetWidth, maxwidth)+'px');
}
</style>
<![endif]-->
<!-- End Conditional Style -->

<!--<script type="text/javascript" src="js/motiongallery.js"></script>-->
<!--crawler end-->




<!----------------------------------colorbox ------------------------------------>
<!--<script src="jquery1.10/jquery.min17.js"></script>
<link type="text/css" media="screen" rel="stylesheet" href="css/colorbox.css" />
<script src="colorbox/jquery.colorbox.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function($){

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

$("#click").click(function(){ 
$('#click').css({"background-color":"#000", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
return false;
});
});
</script>-->
<!------------------------end colorbox------------------------------>



<!--start banner slider-->

<!--<link rel="stylesheet" type="text/css" href="javascript/slider/themes/default/jquery.slider.css" />-->
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="javascript/slider/themes/default/jquery.slider.ie6.css" />
<!--[endif]-->

<!--  <script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/slider/jquery.slider.min.js"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".slider").slideshow({
width      : 667,
height     : 277,
/* transition : 'fade'*/
transition : 'fade'
});
});


</script>-->

<!--end banner slider-->



<?php 
require("scripts.php");
?>

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />


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
<article class="leftbox">
<?php
$table			=	"static_book_month";
$table_name		=	"settings_store";
$fields			=	"*";
$where			=	"1=1";
$order 			= 	"id"; 
$limit 			= 	"";  
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	=	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
$database_query1	=$database->fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

if(empty($database_query))
{
echo '</article>';
}
else
{
foreach($database_query1 as $x)
{
$currency			=	$x["currency"];
}
foreach($database_query as $row)
{
$p_code	=	$row["p_code"];
$p_id	=	$row["id"];
$p_name 		=	"";
$p_author 		=	"";
$p_price 		=	"";

$query = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");
while($r = mysql_fetch_array($query))
{

$p_name 		=	$r["p_name"];
$p_code			=	$r["product_code"];
$p_author 		=	$r["p_author"];
$p_price 		=	$r["p_price"];
$p_uid			=	$r["unique_id"];
$image_link		=	$r["p_image_link"];
$p_description	=	$r["p_description"];
$sub_desc		=	substr ( $p_description , 0,72 );
}

echo '<h1>book of the month</h1>';
echo '<div class="left-innerbox">';
echo '<div class="leftbook-pic"><img src="'.$image_link.'"  width="100%" height="100%" /></div>';
echo '<h2>'.$p_name.' </h2>';
echo '<p class="subtext">'.$p_author.'</p>';
echo '<p>'.$sub_desc.'<br /><a href="product-view.php?pcode='.$p_code.'">Read More</a></p>';
echo '<div class="left-pricebox">'.$currency." ".$p_price.'</div>';
echo '</div>';
echo '</article>';
}
}
?>
<div class="leftbox">
<h1>Browse Books</h1>
</div>

<div class="left-innerbox" style="background:#eee; border:1px solid #ccc; margin-left:8px; padding:10px 2px 20px 0px; margin-top:-10px;">

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
<h1>Search Books</h1>
<div class="left-innerbox">
<div id="TabbedPanels1" class="TabbedPanels">
<ul class="TabbedPanelsTabGroup">
<li class="TabbedPanelsTab" tabindex="0">Book Names</li>
<!--<li class="TabbedPanelsTab" tabindex="0">Category</li>-->
<li class="TabbedPanelsTab" tabindex="0">Author</li>
</ul>

<div class="TabbedPanelsContentGroup">
<div class="TabbedPanelsContent">

<form name="book_name_form" method="post" action="#">
<div class="news-formbox1">
<input type="text" name="search_input" id="search_input" class="news-inputbox" value="" /></div>
<div class="footer-buttonarea">
<input class="footer-button" name="search" type="submit" value="Search" /></div>
</form>

</div>


<div class="TabbedPanelsContent">

<form name="author_form" method="post" action="#">
<div class="news-formbox1">

<input type="text" class="news-inputbox" value="" name="search_input2" id="search_input2" /></div>

<div class="footer-buttonarea">
<input class="footer-button" name="search1" type="submit" value="Search" />
</div>
</form>

</div>

</div>
</div>

</div>
</article>

<article class="leftbox1" id="gap-left">
<h1>Categories</h1>
<div class="online-link">
<?php
require("design/left-category.php");
?>
</div> 
</article>
</section>

<!--<section class="leftbottom-wrap1">
<div class="leftbox">
<h1>subscribe To our newsletter</h1>
<div class="left-innerbox">
<p class="newsletter">Subscribe to our newsletter to get update news & special offers of our company</p>

<form action="#" method="post" name="news_letter_form" onsubmit="MM_validateForm('Name','','R','Email','','RisEmail');return document.MM_returnValue">
<div class="news-formbox"><input type="text" class="news-inputbox" name="Name" value="Enter Your name"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>

<div class="news-formbox"><input type="text" class="news-inputbox" name="Email" value="Enter Your Email Id"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>

<div class="news-button"><input type="submit" name="news_letter" class="news-buttonbox" value="subscribe" /></div>
</form>
</div>
</div>

</section>-->


<?php require("design/news-letter.php"); ?>
</div>

<div class="right-wrap">

<div class="slider">

<div class="banner"><img src="images/index-banner.png" alt="FOUNTAINHEAD | Resource Centre" width="667" height="277"/></div>

<div class="banner"><img src="images/index-banner2.png" alt="FOUNTAINHEAD | Resource Centre" width="667" height="277"/></div>

<div class="banner"><img src="images/index-banner3.png" alt="FOUNTAINHEAD | Resource Centre" width="667" height="277"/></div>

</div>

<section class="home-bookslide2">
<h2>bestsellers</h2>

<ul class="carousel11">     
<form name="book_form" action="#" method="post">
<li>	
<?php
$table			=	"static_best_sellers";
$table_name		=	"settings_store";
$fields			=	"*";
$where			=	"1=1";
$order 			= 	"id";
$limit 			= 	"";
$desc			=	"";
$limitBegin		=	"0";
$monitoring 	= 	false;
$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
$database_query1	=$database->fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

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
$p_code			=	$row["p_code"];
$p_id			=	$row["id"];
$p_name 		=	"";
$p_author 		=	"";
$p_price 		=	"";
$p_inventory	=	"";
$p_status		=	"";
$first_level_cats = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");

while($r = mysql_fetch_array($first_level_cats))
{
$p_uid			=	$r["unique_id"];
$p_image_link	=	$r["p_image_link"];
$p_name 		=	$r["p_name"];
$p_author 		=	$r["p_author"];
$p_price 		=	$r["p_price"];
$p_inventory 	=	$r["p_inventory"];
$p_status 		=	$r["p_status"];

if($p_status == 'Disable' || $p_inventory == '0')
{
continue;
}
else
{
echo '<article class="home-bookbox"><a href="product-view.php?pcode=' .$p_code.'"> ';
echo '<div class="main-box"> ';
echo '<div class="book-pic"><img src="'.$p_image_link.'" alt="" title="" border="0" width="123" height="160" /></div>';
echo '<div class="book-text">';
echo '<h3>'.$p_name.'</h3>';
echo '</div>';
echo '</div></a>';
echo '<div class="book-pricebox">';
echo '<p>'.$currency." ".$p_price.'</p>';
echo '<div class="book-cartbutton"><a href="cart.php?action=add&id='.$p_code.'" >Add to Cart</a></div>';
echo '</div></a>';

}
}
echo '</article></li>';
echo '</form>';
}
}
?>

</ul>

<a class="prev2" href="#" style="display: block;"></a>
<a class="next2" href="#" style="display: block;"></a>
</section>


<section class="home-bookslide1">
<h2>New Releases</h2>

<ul class="carousel1">
<li>
<form name="book_form" action="#" method="post">
<?php
	$table			=	"static_new_released";
	$table_name		=	"settings_store";
	$fields			=	"*";
	$where			=	"1=1";
	$order 			= 	"id"; 
	$limit 			= 	"";  
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	=	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	
	$database_query1	=$database->fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	
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
	$p_code	=	$row["p_code"];
	$p_id	=	$row["id"];
	$p_name 		=	"&nbsp;";
	$p_author 		=	"";
	$p_price 		=	"";
	 
	$first_level_cats = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");
	while($r = mysql_fetch_array($first_level_cats))
	{
	
	$p_name 		=	$r["p_name"];
	$p_author 		=	$r["p_author"];
	$p_price 		=	$r["p_price"];
	$p_uid			=	$r["unique_id"];
	$p_image_link	=	$r["p_image_link"];
	$p_inventory 	=	$r["p_inventory"];
	$p_status 		=	$r["p_status"];
	
	if($p_status == 'Disable' || $p_inventory == '0')
	{
		continue;
	}
	else
	{
	
	echo '<article class="home-bookbox">';
	echo '<a href="product-view.php?pcode='.$p_code.'">';
	echo '<div class="main-box"> ';
	echo '<div class="book-pic"><img src="'.$p_image_link.'" alt="" title="" border="0" width="123" height="160" /></div>';
	echo '<div class="book-text">';
	echo '<h3>'.$p_name.'</h3>';
	echo '</div>';
	echo '</div></a>';
	echo '<div class="book-pricebox">';
	echo '<p>'.$currency." ".$p_price.'</p>';
	echo '<div class="book-cartbutton"><a href="cart.php?action=add&id='.$p_code.'" >Add to Cart</a></div>';
	echo '</div></a>';
	echo '</article>';
	echo '<input type="hidden" name="code" value="'.$p_code.'" />';
	echo '<input type="hidden" name="name" value="'.$p_name.'" />';
	echo "</form>";
	}
	}
	echo '</article></li>';
	echo '</form>';
}
}
?>
</article></li>
</ul>

<a class="prev" href="#" style="display: block;"></a>
<a class="next" href="#" style="display: block;"></a>
</section>

<section class="home-bookslide3">

<h2>List of Awarded Books</h2>

<div class="panel">
  <div class="container">
      <div style="height:200px;" class="wt-scroller">
        	<div style="margin-left: 0px; margin-right: -10px; height: 200px;" class="prev-btn"></div>          
        	<div style="height: 300px;" class="slides">
            	<ul style="width: 3612px;">
                	<li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/1s.jpg" alt="" width="70" height="93"></a>
                                    
                    </li>
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/2s.jpg" alt=""  width="70" height="93"></a>                 	    
                    </li>
                    
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/3s.jpg" alt="" width="70" height="93"></a>
                                    
                    </li>
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/4s.jpg" alt=""  width="70" height="93"></a>                 	    
                    </li>
                    
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/5s.jpg" alt="" width="70" height="93"></a>
                                    
                    </li>
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/6s.jpg" alt=""  width="70" height="93"></a>                 	    
                    </li>
                    
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/7s.jpg" alt="" width="70" height="93"></a>
                                    
                    </li>
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/8s.jpg" alt=""  width="70" height="93"></a>                 	    
                    </li>
                    
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/9s.jpg" alt="" width="70" height="93"></a>
                                    
                    </li>
                    <li>
                        <a href="#" rel="scroller" target="temp_win"><img style="opacity: 1;" src="images/awarded-books/10s.jpg" alt=""  width="70" height="93"></a>                 	    
                    </li>
                    
                    
                </ul>
        	</div>          	
     		<div style="margin-left: 0px; margin-right: 0px; height:100px;"  class="next-btn"></div>
        	<div style="width:100%; height:0; padding: 0px 0px;" class="lower-panel"></div>
		</div>   
    </div>
	
</div>
</section>

</div>


</div>
</div>

</div>


<div class="footer-wrap">
<?php include("design/footer.php");?>
</div>
</div>



<!-------------------------- product slider---------------------------->

<link rel="stylesheet" href="css/pro-slider.css">
<!-- <link rel="stylesheet" href="css/slider.css">-->
<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/sForm.js"></script>
<script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="js/tms-0.4.1.js"></script>
<script>
$(window).load(function(){
$('.slider')._TMS({
show:0,
pauseOnHover:false,
prevBu:'.prev',
nextBu:'.next',
playBu:false,
duration:700,
preset:'fade', 
pagination:true,//'.pagination',true,'<ul></ul>'
pagNums:false,
slideshow:7000,
numStatus:false,
banners:false,
waitBannerAnimation:false,
progressBar:false
})  
});

$(window).load (
function(){$('.carousel1').carouFredSel({auto: false,prev: '.prev',next: '.next',  items: {
visible : {min: 1,
max: 4
},

height: 'auto',
width: 130,

}, responsive: false, 

scroll: 1, 

mousewheel: false,

swipe: {onMouse: false, onTouch: false}});


});  

$(window).load (
function(){$('.carousel11').carouFredSel({auto: false, prev: '.prev2',next: '.next2',  items: {
visible : {min: 1,
max: 4
},

height: 'auto',
width: 130,

},

responsive: false, 

scroll: 1, 

mousewheel: false,

swipe: {onMouse: false, onTouch: false}});


});          

</script>

<!--[if lt IE 8]>
<div style=' clear: both; text-align:center; position: relative;'>
<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
</a>
</div>
<![endif]-->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">

<![endif]-->


<!--start banner slider-->

<link rel="stylesheet" type="text/css" href="javascript/slider/themes/default/jquery.slider.css" />
<!--[if IE 6]>-->
<link rel="stylesheet" type="text/css" href="javascript/slider/themes/default/jquery.slider.ie6.css" />
<!--[endif]-->

<!--<script type="text/javascript" src="javascript/jquery.min.js"></script>-->
<script type="text/javascript" src="javascript/slider/jquery.slider.min.js"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".slider").slideshow({
width      : 667,
height     : 277,
/* transition : 'fade'*/
transition : 'fade'
});
});


</script>


<!-------------------- Scroller with lightbox ------------------------------->

    <!--<link rel="stylesheet" type="text/css" href="assets/preview.css">-->
	<link rel="stylesheet" type="text/css" href="assets/wt-lightbox.css">
    <link rel="stylesheet" type="text/css" href="assets/wt-scroller.css">
 	<!--<script type="text/javascript" src="assets/jquery-1.js"></script>-->
    <script type="text/javascript" src="assets/jquery-ui-1.js"></script>
    <script type="text/javascript" src="assets/jquery_002.js"></script>
    <script type="text/javascript" src="assets/jquery.js"></script>
    <script type="text/javascript" src="assets/preview.js"></script>
    <!--[if lt IE 9]>
  	<style>
    	.panel {
	    	border-left:1px solid #444;
			border-right:1px solid #444;
        }
    </style>
    <![endif]-->   

<!-------------------- Scroller with lightbox ------------------------------->

<!--<script>


<!--end banner slider-->
<!-------------------------- Product slider---------------------------->
<!--<link rel="stylesheet" href="css/responsiveslides.css">
<link rel="stylesheet" href="css/themes.css">
<script src="js/jquery.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script>
// You can also use "$(window).load(function() {"
$(function () {

$("#slider2").responsiveSlides({
auto: true,
pager: false,
nav: true,
speed: 500,
maxwidth: 700,
namespace: "transparent-btns"
});

});
</script>-->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>




</body>
</html>

<?php
/* if($check_cache == 1)
{
$cache->create_cache();
}

unset($_SESSION["xyz_email"]);*/
?>