<?php

require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
$security		=	new  Security_Framework();
$rand		=	new Random_Variables();

	$cart = $_SESSION['cart'];
	$items = explode(',',$cart);
	$contents = array();
	foreach ($items as $item) 
	{
	$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
	}
	
	$val			=	$_SESSION['cart'];
	$items 			= 	explode(',',$val);
	
		$val1			=	$_SESSION['product_amount'];
		$amount 		= 	explode(',',$val1);

	$i = 1;
		
		$table			=	"customer_details";
		$query			=	mysql_query("SELECT * FROM customer_details WHERE  user_name='".$_SESSION["registered_user"]."' AND user_password='".$_SESSION["user_token"]."'");
		
		while($row	=	mysql_fetch_array($query))
		{
		$cx_no 			=	$row["unique_id"];
		}
		$transaction_id	=	$rand->unique_alpha(3).time();
	
	foreach($contents as $itemd => $qty)
	{
		$product_id		=	$itemd;
		$product_qty	=	$qty;
		$amt			=	$amount[$i++];
		$table2			=	"logs_transaction";
		$total_amount	=	$amt * $product_qty;
		$data	=	array(
		'id' 									=> 	"",
		'product_transaction_id' 				=> 	$transaction_id,
		'product_transaction_date' 				=> 	time(),
		'product_name' 							=> 	$product_id,
		'product_amount' 						=> 	$amt,
		'product_quantity'						=>	$product_qty,
		'total_amount'							=>	$total_amount,
		'product_transaction_status' 			=> 	'Un-shipped',
		'cx_id'									=>	$cx_no
		);
		$x = $database->insert_data($table2, $data);
	}

		$table3			=	"logs_transaction_amount";
		$data3	=	array(
		'id' 									=> 	"",
		'date' 									=> 	time(),
		'transaction_id' 						=> $transaction_id,
		'amount' 								=> 	$_SESSION["total_amount"],
		);
		$x = $database->insert_data($table3, $data3);
	
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");



?>

