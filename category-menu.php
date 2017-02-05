<?php
	$database = new Database_Framework();
	$con=$database->connect_database();
	$database->select_database();
	
	$first_level_cats = mysql_query("SELECT * FROM category");
	echo '<li>';
	
	while($row = mysql_fetch_array($first_level_cats))
	{
	$category_id	=	$row['id'];
	$category_name	=	$row['name'];
	echo '<a href="#">'.$category_name.'</a>';
	$second_level_cats = mysql_query("SELECT * FROM sub_category WHERE cat_id = '$category_id' ");
	
	if(empty($second_level_cats))
	{
	break;
	}
	else
	{
	echo '<ul>';
	while($r = mysql_fetch_array($second_level_cats))
	{
	$sub_category		=	$r['name'];
	$s_id				=	$r['unique_id'];
	echo '<li><a href="product-listing.php?s_id=' .$s_id.'">'.$sub_category .'</a>';
	echo '<div class="subi-sepi">&nbsp;</div>';
	}
	echo '</li>';
	}
	echo '</ul>';
	}
	echo '</li>';
?>