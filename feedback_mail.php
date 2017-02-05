<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();

	$table			=	"settings_email";
	$fields			=	"*";
	$where			=	"1=1";
	$order 			= 	"";
	$limit 			= 	"";
	$desc			=	"";
	$limitBegin		=	"0";
	$monitoring 	= 	false;
	$database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
	
	foreach($database_query as $row)
	{
		$to			=	$row["email_id"];
	}
	
	if(!empty($_POST["Name"]) AND $_POST["Name"] != "Enter Your name" and !empty($_POST["Email"]) AND filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL))
	{
	$message_content = 
	'
	<html>
	<head></head>
	<body>
	<br/>
	<strong>FEEDBACK DETAILS</strong><br />
	<hr />
	<table>

	<tr>
	<td>Customer Name :- &nbsp;</td>
	<td>'.$_POST["Name"].'</td>

	</tr>

	<tr>
	<td>Customer Email Id :- &nbsp;</td>
	<td>'.$_POST["Email"].'</td>
	</tr>

	<tr>
	<td>Comment :- &nbsp;</td>
	<td>'.$_POST["tetarea"].'</td>
	</tr>

	</table>
	<hr />
	</body>
	</html>
	';
		$subject	=	"Feedback Details";
		$headers	=	array();
		$headers[] 	=	"MIME-Version: 1.0";
		$headers[] 	=	"Content-type: text/html; charset=iso-8859-1";
		$headers[] 	=	"From: '".$_POST["Email"]."'";
		$headers[] 	=	"Cc: ";
		$headers[]	=	"Reply-To: '".$_POST["Email"]."'";
		$headers[] 	=	"X-Mailer: PHP/".phpversion();
		$headers[] 	=	$message_content;
		mail($to, $subject,'' , implode("\r\n", $headers));
		echo'<script>alert("Thank you for your feedback");</script>';
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
	else
	{
	$_SESSION["xyz_email"]	=	"Please Enter Email ID & Name";
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
	
	
?>