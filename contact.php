<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

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


<?php
if(isset($_POST["smail"]))
{
$name 		= 	$_POST["Name"];
$phone		=	$_POST["Phone"];
$email		=	$_POST["Email"];	
$message	=	$_POST["Message"];	

$to					=		"contact@samsadbooks.com";
$message_content	= 
'
<html>
<head></head>
<body>
<br/>
<hr />
<strong>Contacting Details</strong><br />
<hr />
<table>

<tr>
<td>Name &nbsp;</td>
<td> :- &nbsp;</td>
<td>'.$name.'</td>
</tr>

<tr>
<td>Contact No &nbsp;</td>
<td> :- &nbsp;</td>
<td>'.$phone.'</td>
</tr>

<tr>
<td>Email ID &nbsp;</td>
<td> :- &nbsp;</td>
<td>'.$email.'</td>
</tr>

<tr>
<td>Message &nbsp;</td>
<td> :- &nbsp;</td>
<td>'.$message.'</td>
</tr>

</table>
<hr />
</body>
</html>
';

$subject	=	"Samsad Contact Us";
$headers	=	array();
$headers[] 	=	"MIME-Version: 1.0";
$headers[] 	=	"From: ".$_POST["Email"];
$headers[] 	=	"Cc: ";
$headers[]	=	"Reply-To: ".$_POST["Email"];
$headers[] 	=	"X-Mailer: PHP/".phpversion();
$headers[] 	=	$message_content;
mail($to, $subject,'' , implode("\r\n", $headers));
echo'<script>alert("Thank you, We will contact you soon");</script>';
exit ("<meta http-equiv='refresh' content='0;url=contact.php'>");
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - Contact</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!------------google-map-------------->
<link href="css/google-map.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true" /></script>
<script type="text/javascript">
<!--
function initialize() {
var latlng = new google.maps.LatLng(22.592727,88.375313);
var myOptions = {
zoom: 17,
center: latlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById("map"),
myOptions);
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<!------------google-map-------------->
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
<li><a href="contact.php" class="active">Contact Us</a></li>
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
</div>


<div class="right-wrap"> 
<div class="inner-bookslist-one"> 
<div class="page-link">
<p>Home > Contact Us</p>
</div> 
<h1 class="head-one">Contact Us</h1>
<img class="cnt" src="images/contactus.jpg" />
<div class="map-box">
<div id="map">&nbsp;</div>
</div> 
<div class="contact-box">
<div class="contact-left">
<h5>Office Address</h5>
<p><span style="font-size:15px;">SHISHU SAHITYA SAMSAD P LTD</span></p>
<p>32A, Acharya Prafulla Chandra Road<br />
Kolkata-700 009 West Bengal, India</p>

<p id="gap-six"><img src="images/phone-icon.png" align="left" />Phone :   91 (33) 2350-7669/3195</p>
<p><img src="images/fax-icon.png" align="left" />&nbsp;Fax :       <span style="margin-left:18px;">91 (33) 2360-3508</span></p>
<p><img src="images/mail-icon.png" align="left" />&nbsp;E-mail :  contact@samsadbooks.com</p> 
<p id="gap-five">ss_samsad@yahoo.in</p>

</div>

<div class="contact-right">
<form name="sendmail" action="#" method="POST" onsubmit="MM_validateForm('Name','','R','Phone','','Num','Email','','RisEmail','Message','','R');return document.MM_returnValue">
<h5>Contact Us</h5>
<input type="text" class="cont-nme"  name="Name" value="Full Name"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />

<input type="text" class="cont-nme"  name="Phone" value="Contact No"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />

<input type="text" class="cont-nme"  name="Email" value="Email Id"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />

<textarea class="cont-ar" name="Message" value="Message " onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Feedback</textarea>
<input type="submit" name="smail" class="sunny-one" value="Send" />
</form>


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
<script>initialize();</script>
</body>
</html>
