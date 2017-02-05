<?php
session_start();
if(isset($_SESSION['cart']))
{
	$cart = $_SESSION['cart'];
}
else
{
	$cart="";
}
$action = $_GET['action'];


switch ($action) 
{
	case 'add':
	if ($cart)
	{
	$item	=	$_GET['id'];
	$check	=	strpos($cart,$item);
	if($check	===	false)
	{
	$cart .= ','.$_GET['id'];
	}
	else
	{
	echo '<script>alert("Item is present in your cart");</script>';
	}
	} 
	else 
	{ 
	$cart = $_GET['id'];
	}
	break;
	
	case 'delete':
	if ($cart)
	{
	$items = explode(',',$cart);
	$newcart = '';
	
	foreach ($items as $item)
	{
	if ($_GET['id'] != $item) 
	{
	if ($newcart != '')
	{
	$newcart .= ','.$item;
	} else 
	{
	$newcart = $item;
	}
	}
	}
	$cart = $newcart;
	}
	break;

	case 'update':
	if ($cart) 
	{
	$newcart = '';
	foreach ($_POST as $key=>$value) 
	{
	if (stristr($key,'qty')) 
	{
	$id = str_replace('qty','',$key);
	$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
	$newcart = '';
	foreach ($items as $item)
	{
	if ($id != $item) 
	{
	if ($newcart != '') 
	{
	$newcart .= ','.$item;
	} else {
	$newcart = $item;
	}
	}
	}
	for ($i=1;$i<=$value;$i++)
	{
	if ($newcart != '') 
	{
	$newcart .= ','.$id;
	} else
	{
	$newcart = $id;
	}
	}
	}
	}
	}
	$cart = $newcart;
	break;
}

$_SESSION['cart'] = $cart;
exit ("<meta http-equiv='refresh' content='0;url=shopping-cart-list.php'>");
?>