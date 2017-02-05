<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();


	$table			=	"customer_details";
	$fields			=	"*";
	$where			=	"unique_id='".$_GET["id"]."'";
	$order 			= 	"id"; 
	$limit 			= 	"";  
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	=	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show Details</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<?php
require("script1.php");
?>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>

<?php require ("design/nav.php"); ?>

<div class="center_content" >

<br />
<h2><img src="images/customer.png" alt="" title="" border="0" />&nbsp;Show Details</h2>


<br />
<table id="rounded-corner" width="98%">
<thead>
<tr align="center">

<th scope="col" class="rounded-company">Customer Name</th>
<th scope="col" class="rounded">Email Id</th>
<th scope="col" class="rounded">Phone No</th>
<th scope="col" class="rounded">Pincode</th>
<th scope="col" class="rounded">Address</th>
<th scope="col" class="rounded">State</th>
<th scope="col" class="rounded">Country</th>
<th scope="col" class="rounded">Newsletter Subscription</th>
<th scope="col" class="rounded-q4">Registered On</th>


</tr>
</thead>
<tfoot></tfoot>
<tbody>
<tr>

<?php

if(empty($database_query))
{
	echo '</tr>';
	echo '<tr align="center">';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '</tr>';
	
	echo '</tr>';
	echo '<tr align="center">';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '<td>&nbsp;</td>';
	echo '</tr>';
}
else
{
	foreach($database_query as $row)
	{
		$name				=	$row["name"];
		$unique_id			=	$row["unique_id"];
		$email_id			=	$row["email_id"];
		$contact_no			=	$row["contact_no"];
		$address			=	$row["address"];
		$city				=	$row["city"];
		$postal_code		=	$row["postal_code"];
		$country			=	$row["country"];
		$state				=	$row["state"];
		$registered_on		=	date('l,d F Y',$row["registered_on"]);
		$news_letter_suds	=	$row["news_letter_suds"];
		if($news_letter_suds	==	'0')
		{
			$news_letter_suds	=	'Yes';
		}
		else
		{
			$news_letter_suds	=	'No';
		}
	
	echo '<tr align="center">';
	echo '<td>'.$name.'</td>';
	echo '<td>'.$email_id.'</td>';
	echo '<td>'.$contact_no.'</td>';
	echo '<td>'.$postal_code.'</td>';
	echo '<td>'.$address.'</td>';
	echo '<td>'.$state.'</td>';
	echo '<td>'.$country.'</td>';
	echo '<td>'.$news_letter_suds.'</td>';
	echo '<td>'.$registered_on.'</td>';
	echo '</tr>';
	}
	echo '<tr>';
	echo '<td colspan="10" align="right" ></td>';
	echo '</tr>';
}
?>



</tbody>
</form>
</table>

</div>   <!--end of center content -->               




<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>

</div>
</body>
</html>