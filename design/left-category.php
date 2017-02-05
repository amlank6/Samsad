<?php
$query = mysql_query("SELECT * FROM sub_category ");
		$sub_category	=	"";
		while($r = mysql_fetch_array($query))
		{
		$sub_category	=	$r['name'];
		$s_id			=	$r['unique_id'];
		$image			=	$r['image'];

echo '<div class="link2">';
echo '<div class="link2-pic"><img src="'.$image.'" width="37px" height="37px" /></div>';
echo '<div class="link2-sep"><img src="images/link-sep.png" /></div>';
echo '<p><a href="product-listing.php?s_id='.$s_id.'">'.$sub_category.'</a></p>';
echo '</div>';
}
?>
