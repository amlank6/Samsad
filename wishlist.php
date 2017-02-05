<?php
session_start();
if(isset($_SESSION['wishlist']))
{
	$wishlist = $_SESSION['wishlist'];
}
else
{
	$wishlist="";
}
$action = $_GET['action'];


switch ($action) 
{
	case 'add':
	if ($wishlist)
	{
	$item	=	$_GET['id'];
	$check	=	strpos($wishlist,$item);
	if($check	===	false)
	{
	$wishlist .= ','.$_GET['id'];
	}
	else
	{
	echo '<script>alert("Item is present in your wishlist");</script>';
	}
	} 
	else 
	{ 
	$wishlist = $_GET['id'];
	}
	break;
	
	case 'delete':
	if ($wishlist)
	{
	$items = explode(',',$wishlist);
	$newwishlist = '';
	
	foreach ($items as $item)
	{
	if ($_GET['id'] != $item) 
	{
	if ($new_wishlist != '')
	{
	$new_wishlist .= ','.$item;
	} else 
	{
	$new_wishlist = $item;
	}
	}
	}
	$wishlist = $new_wishlist;
	}
	break;

	case 'update':
	if ($wishlist) 
	{
	$new_wishlist = '';
	foreach ($_POST as $key=>$value) 
	{
	if (stristr($key,'qty')) 
	{
	$id = str_replace('qty','',$key);
	$items = ($newwishlist != '') ? explode(',',$newwishlist) : explode(',',$wishlist);
	$newwishlist = '';
	foreach ($items as $item)
	{
	if ($id != $item) 
	{
	if ($newwishlist != '') 
	{
	$newwishlist .= ','.$item;
	} else {
	$newwishlist = $item;
	}
	}
	}
	for ($i=1;$i<=$value;$i++)
	{
	if ($newwishlist != '') 
	{
	$newwishlist .= ','.$id;
	} else
	{
	$newwishlist = $id;
	}
	}
	}
	}
	}
	$wishlist = $newwishlist;
	break;
}

$_SESSION['wishlist'] = $wishlist;
exit ("<meta http-equiv='refresh' content='0;url=shopping-wish-list.php'>");
?>