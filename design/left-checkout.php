<article class="leftbox">
<div class="left-cartbox">
<h2>cart</h2>
<p>No Products</p>

<div class="cart-formbox">
<div class="cart-left">Total Items</div>
<div class="cart-right">
<?php 
if (!isset($_SESSION['cart']) OR empty($_SESSION['cart'])) 
	{
	echo '(0)';
	} 
	else 
	{
	$cart	=	$_SESSION['cart'];
	$items = explode(',',$cart);
	$s = (count($items) > 1) ? 's':'';
	echo '('.count($items).')';
	}
?>
</div>
</div>

<div class="cart-formbox1">
<div class="cart-left">Recent Item(s)</div>
<div class="cart-right1">
<?php 
if (!isset($_SESSION['cart']) OR empty($_SESSION['cart'])) 
	{
	echo '(0)';
	} 
	else 
	{
	$cart	=	$_SESSION['cart'];
	$items = explode(',',$cart);
	$s = (count($items) > 1) ? 's':'';
	//echo end($items);
	
	$table			=	"product";
	$fields			=	"*";	
	$where			=	"product_code = '".end($items)."'";
	$order 			= 	"id"; 
	$limit 			= 	"";  	// 	Display Only 10 Rows
	$desc			=	"";	//	0 Means Ascending Order 1 Means Descending Order
	$limitBegin		=	"0";	//	Display Rows From O	
	$monitoring 	= 	false;	//	Flase Means Do Not Display Query
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	$product_name	=	"";
	foreach($database_query as $row)
	{
	$product_name 			=	$row["p_name"];
	}
	echo $product_name;
	}
	
?>

</div>
</div>

<div class="checkout-button"><a href="shopping-cart-list.php">check out</a></div>

</div>
</article>