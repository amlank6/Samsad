<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

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
<title>Samsad - Acheivements</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script src="SpryAssets1/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets1/SpryAccordion.css" rel="stylesheet" type="text/css" />

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
<li><a href="acheivements.php" class="active">Achievments</a></li>

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
<h1>Categories</h1>
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


<?php require("design/news-letter.php"); ?>
</div>

<div class="right-wrap">
<div class="inner-bookslist-three">
<div class="page-link">
<p>Home > Acheivements</p>
</div> 
<h1 class="head-one">Acheivements</h1>
<img class="cnt" src="images/achievment.jpg" />
<p id="gap">Since its inception in 1951 Shishu Sahitya Samsad has been in constant effort to reach its policy goal of publishing quality books both in form and content. In recognition of this effort the organisation has received numerous awards of which the following can be cited :
</p>
<ol type="1">
<li>Government of India awards for excellence in production for fourteen times.</li>
<li>Federation of Indian Publishers awards for excellence in production for more than fifteen times.</li>
<li>National award for the best book for children in 1995.</li>
<li>Other non-government agencies awards in West Bengal.</li>
</ol>

<div id="Accordion1" class="Accordion" tabindex="0">
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">For beautiful printing and publishing Government of India has awarded these books</div>
         <div class="AccordionPanelContent">
         <div class="awared">
<div class="awared-head">
<div class="row-one">Books</div>
<div class="row-two">Award</div>
<div class="row-three">Year</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Charer boi</div>
<div class="row-five">1st</div>
<div class="row-six">1955</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Nije Poro</div>
<div class="row-five">1st</div>
<div class="row-six">1956</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chabi Aka (Kho)</div>
<div class="row-five">1st</div>
<div class="row-six">1957</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chobite Prithivi (Prostor Joog)</div>
<div class="row-five">1st</div>
<div class="row-six">1961</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chutir Dine Megher Golpo</div>
<div class="row-five">2nd</div>
<div class="row-six">1955</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chtoder Balmiki Ramayan</div>
<div class="row-five">2nd</div>
<div class="row-six">1958</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Jiboner Jharapata</div>
<div class="row-five">2nd</div>
<div class="row-six">1958</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Nabin Rabir Alo</div>
<div class="row-five">2nd</div>
<div class="row-six">1961</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Ishper Golpo</div>
<div class="row-five">2nd</div>
<div class="row-six">1964</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Amra Bangali</div>
<div class="row-five">Award</div>
<div class="row-six">1956</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chenga Benga</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1956</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Ramayan Kritibash Birochit</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1957</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Khelar Pora</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1971</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Bhuddhist Monuments</div>
<div class="row-five">1st</div>
<div class="row-six">1973</div>
</div>

</div>
         </div>
       </div>
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">Book awarded for National Sishu Sahitya</div>
         <div class="AccordionPanelContent">
         
         <div class="awared1">
<div class="awared-head">
<div class="row-one">Books</div>
<div class="row-two">Award</div>
<div class="row-three">Year</div>
</div>

<div class="awared-head-sub" id="achi-line">
<div class="row-four">Gablur Bigyan Diary - Mahakasher katha</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1995</div>
</div>

</div>

<p>We have acheived this honour only by the love and affectionate we got, from our readers and well wishers. Today with all their support we published both english and bengali story books , novels ,classics, dictionaries and Children's books.</p>
<p>On behalf of Sahitya Samsad and Sishu Sahitya Samsad we thanks all our readers and suppoters.</p>

         </div>
       </div>
       
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">List of books awarded by Federation Of India</div>
         <div class="AccordionPanelContent">
         
         <div class="awared1">
<div class="awared-head">
<div class="row-one">Books</div>
<div class="row-two">Award</div>
<div class="row-three">Year</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Samartha ShobdoKosh</div>
<div class="row-five">1st</div>
<div class="row-six">1987</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Prakriti Parichay - 1</div>
<div class="row-five">2nd</div>
<div class="row-six">1987</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Akashbhora Surjo Tara</div>
<div class="row-five">1st</div>
<div class="row-six">1990</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chutir Gandha</div>
<div class="row-five">1st</div>
<div class="row-six">1992</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Nije Shikhi(2nd)</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1992</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Jatoker Golpo</div>
<div class="row-five">1st</div>
<div class="row-six">1994</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Swadeshio Bharat Bidya Shadhok</div>
<div class="row-five">2nd</div>
<div class="row-six">1994</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Jui Phuler Rumal</div>
<div class="row-five">1st</div>
<div class="row-six">1996</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chirokaler Shera(Upendrakishore)</div>
<div class="row-five">&nbsp;</div>
<div class="row-six">1996</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Samsad Number Book (1-50)</div>
<div class="row-five">2nd</div>
<div class="row-six">1997</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Sandesh Rohosho</div>
<div class="row-five">2nd</div>
<div class="row-six">1997</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Shahaj Pora (Prathom bhag)</div>
<div class="row-five">1st</div>
<div class="row-six">1998</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Chirokaler Shera (Lila Majumder)</div>
<div class="row-five">1st</div>
<div class="row-six">1998</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Tuntuni Are Bhagher Golpo</div>
<div class="row-five">1st</div>
<div class="row-six">2000</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Aonko Shijhi Aonko Kori-1</div>
<div class="row-five">1st</div>
<div class="row-six">2001</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Samsad Book of Rhymes</div>
<div class="row-five">2nd</div>
<div class="row-six">2001</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Kishore Sahitya sambhar-Premendra</div>
<div class="row-five">1st</div>
<div class="row-six">2004</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Phul O Phol</div>
<div class="row-five">1st</div>
<div class="row-six">2005</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Gagendranath -Kartoon O Sketch</div>
<div class="row-five">2nd</div>
<div class="row-six">2005</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Partition Of Bengal</div>
<div class="row-five">2nd</div>
<div class="row-six">2005</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Rabindranatha'r AtiyaSajan</div>
<div class="row-five">1st</div>
<div class="row-six">2006</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Bohuroopi</div>
<div class="row-five">2nd</div>
<div class="row-six">2006</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Charae Charae</div>
<div class="row-five">2nd</div>
<div class="row-six">2006</div>
</div>

<div class="awared-head-sub">
<div class="row-four">Catalogue</div>
<div class="row-five">2nd</div>
<div class="row-six">2006</div>
</div>

<div class="awared-head-sub" id="gap-three">
<div class="row-four">Japani Roopkatha</div>
<div class="row-five">1st</div>
<div class="row-six">2007</div>
</div>

</div>
         
         </div>
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
<script type="text/javascript" src="js/accordion-download.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.elastislide.js"></script>
<script type="text/javascript">
$('#carousel').elastislide({
				imageW 		: 123,
				margin		: 10,
				easing		: 'easeInBack'
			});
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>
