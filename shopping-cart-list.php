<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$total_amount1		=	'0';
$vat				=	'0';
$total_cost			=	'0';
$shipping_charges	=	'0';
$vat_amount			=	'0';
$vat1				=	'0';
$product_amount		=	"" ;
$quan				=	"";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Cart</title>
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
<?php include("design/header.php"); ?>
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
<?php include("design/nav-searchbox.php"); ?>
</div>
</div>

<div class="wrap1">

<div class="innerpage-content">

<section class="page-link">
<p>Home > Shopping cart</p>
</section>

<section class="shopping1">
<div class="shopping-cart"><h1 id="shopping">your shopping cart contents</h1></div>

<p>Please note that products with different delivery times may be shipped separately. </p>
</section>

<section class="shopping-cartbox">
<div class="shopping-head">
<div class="shopping-head1">PRODUCT description</div>
<div class="shopping-head2">quantity</div>
<div class="shopping-head2">unit price</div>
<div class="shopping-head4">Total amount</div>
</div>

<?php
	if(!empty($_SESSION['cart']))
	{
	$cart = $_SESSION['cart'];
	$items = explode(',',$cart);
	$contents = array();
	foreach ($items as $item) 
	{
	$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
	}
	
	$val			=	$_SESSION['cart'];
	$items 			= 	explode(',',$val);
	foreach($contents as $itemd => $qty)
	{
	echo "PID = ".$product_id	=	$itemd;
	echo "pqty	=	".$product_qty	=	$qty;
	echo "<br />";
	}
	
	foreach($contents as $itemd => $qty)
	{
	$table			=	"product";
	$table_name		=	"settings_store";
	$fields			=	"*";
	$where			=	"product_code='".$itemd."'";
	$where1			=	"1=1";
	$order 			= 	"";
	$limit 			= 	"";
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	= 	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	$database_query1	=$database->fetch_data($table_name, $fields, $where1, $order, $limit, $desc, $limitBegin, $monitoring);
	
	foreach($database_query as $row)
	{
		$p_image_link		=	$row["p_image_link"];
		$p_name				=	$row["p_name"];
		$p_author			=	$row["p_author"];
		$p_price			=	$row["p_price"];
		$p_id				=	$row["id"];
		$p_code				=	$row["product_code"];
		$total_amount		=	$p_price;
		$p_format			=	$row["p_format"];
		$p_pages			=	$row["p_pages"];
	}
	foreach($database_query1 as $row)
	{
		$taxable_value		=	$row["taxable_value"];
		$currency			=	$row["currency"];
		$shipping_charges	=	$row["shipping_charges"];
	}
	
echo '<div class="shopping-pan">';
echo '<div class="shopping-box1">';
echo '<div class="sho-book"><img src="'.$p_image_link.'" width="100%" /></div>';


echo '<div class="sho-bookname">'.$p_name.'</div>';

echo '<div class="sho-bookdetails1">';
echo '<div class="sho-bookde1">Author:</div>';
echo '<div class="sho-bookde2">'.$p_author.'</div>';
echo '</div>';

echo '<div class="sho-bookdetails">';
echo '<div class="sho-bookde1">Product Code:</div>';
echo '<div class="sho-bookde2">'.$p_code.'</div>';
echo '<input type="hidden" name="p_code" value="'.$p_code.'" />';
echo '</div>';

echo '<div class="sho-bookdetails">';
echo '<div class="sho-bookde1">Binding:</div>';
echo '<div class="sho-bookde2">'.$p_format.'</div>';
echo '</div>';

echo '<div class="sho-bookdetails">';
echo '<div class="sho-bookde1">No of pages:</div>';
echo '<div class="sho-bookde2">'.$p_pages.'</div>';
echo '</div>';
echo '</div>';

echo '<div class="shopping-box2">';
echo '<form action="cart.php?action=update" method="post" id="cart" >';
echo '<div class="quan-box"><input type="text" name="qty'.$itemd.'" value="'.$qty.'" size="3" maxlength="3"  class="quan-inputbox" /></div>';
echo '<div class="quan-textbox">';
echo '<div class="quan-text2"><input type="submit" name="update" class="quan-text1button" value="+Update" /></div>';

echo '<div class="quan-text1"><a href="cart.php?action=delete&id='.$itemd.'" class="quan-text1button" >DELETE</a></div>';

echo '</div>';
echo '</div>';
echo '<div class="shopping-box2"><p>'.$currency." ".$p_price.'</p></div>';

$total_amount	=	$p_price * $qty;

echo '<div class="shopping-box4"><p>'.$currency." ".$total_amount.'</p></div>';
echo '</form>';
echo '</div>';

$total_amount1					=	$total_amount1 + $total_amount;
$vat							=	$taxable_value;
$vat_amount						=	($taxable_value * $total_amount1) / 100;
$product_amount					.=	','.$p_price;
}

$total_cost						=	$total_amount1 + $vat1 + $shipping_charges;
$_SESSION["product_amount"]		=	$product_amount;
$_SESSION["total_amount"]		=	$total_cost;
}

else
{
echo '<div class="shopping-pan">';
echo '<div class="shopping-box1">';
echo '<div class="sho-bookname">You have no item selected</div>';
echo '<div class="sho-book"></div>';
echo '</div>';

echo '<div class="shopping-box2"><p>0</p></div>';
echo '<div class="shopping-box2"><p>0</p></div>';

echo '<div class="shopping-box4"><p>0</p></div>';
echo '</div>';

}
?>



<div class="shopping-pan">
<!--<div class="sho-left">
<p>Choose if you have a discount code or reward points you want 
to use or would like to estimate your delivery cost.</p>

<div class="sho-radio"><input type="radio" name="coupon" class="sho-radio1" />Use Coupon Code</div>
<div class="sho-radio"><input type="radio" name="coupon" />Use Gift Voucher</div>
<div class="sho-radio"><input type="radio" name="coupon" />Estimate Shipping & Taxes</div>
</div>-->

<div class="sho-right">
<div class="shoright-total">total cart</div>
<div class="shor-text">
<div class="shor-textl">Sub -Total :</div>
<div class="shor-textr"><input type="text" name="sub_total" value="<?php echo $total_amount1; ?>" readonly="readonly" class="shor-textrinput" /></div>
</div>

<div class="shor-text">
<div class="shor-textl">Shipping cost :</div>
<div class="shor-textr"><input type="text" name="shipping_cost" value="<?php echo $shipping_charges; ?>" readonly="readonly" class="shor-textrinput" /></div>
</div>

<div class="shor-text">
<div class="shor-textl">VAT (<?php echo $vat; ?>) :</div>
<div class="shor-textr"><input type="text" value="<?php echo $rounded = round($vat_amount, 2); ?>" readonly="readonly" class="shor-textrinput" /></div>
</div>

<div class="shor-text">
<div class="shor-textl">Total:</div>
<div class="shor-textr"><input type="text" readonly="readonly" value="<?php echo $rounded1 = round($total_cost, 2); ?>" class="shor-textrinput" /></div>
</div>
</div>
</div>

<?php
if(!empty($_SESSION['cart']))
{
echo '<div class="shopping-pan1">';
echo '<div class="sho-buttonarea">';
echo '<div class="sho-button"><a href="index.php">CONTINUE SHOPPING</a></div>';
if(isset($_SESSION["registered_user"]))
{
echo '<div class="sho-button1"><a href="reg_user_payment.php">proceed to checkout</a></div>';
}
else
{
echo '<div class="sho-button1"><a href="checkout.php">proceed to checkout</a></div>';
}
echo '</div>';
echo '</div>';
}

else
{
echo '<div class="shopping-pan1">';
echo '<div class="sho-buttonarea">';
echo '<div class="sho-button"></div>';
echo '<div class="sho-button"><a href="index.php">CONTINUE SHOPPING</a></div>';
echo '</div>';
echo '</div>';
}
?>
</section>

</div>

</div>
</div>

</div>

<div class="footer-wrap">
<?php include("design/footer.php"); ?>
</div>
</div>
</body>
</html>
