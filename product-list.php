<?php
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

if(isset($_POST["search_input"]))
{
$table			=	"product";
$fields			=	"*";
$where			=	"p_name='".$_POST["search_input"]."'";
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
	echo '<a href="product-view.php" class="example7">';
	echo '<div class="main-box"> ';
	echo '<div class="book-pic"><img src="../admin/'.$p_image_link.'" alt="" title="" border="0" width="123" height="160" /></div>';
	echo '<div class="book-text">';
	echo '<h3>'.$p_name.'</h3>';
	echo '<p>'.$p_author.'</p>';
	echo '</div>';
	echo '</div></a>';
	echo '<div class="book-pricebox">';
	echo '<p>Rs.'.$p_price.'/-</p>';
	echo '<div class="book-cartbutton"><input type="submit" name="submit" class="book-cartbuttonbox" value="Add to Cart" /></div>';
	echo '</div></a>';
	echo '</article>';
	echo '<input type="hidden" name="code" value="'.$p_code.'" />';
	echo '<input type="hidden" name="name" value="'.$p_name.'" />';
	echo "</form>";
	}
	}
?>

