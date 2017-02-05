<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();
if(isset($_POST["create_sub_admin"]))
{
	$table_name						=	"user_details";
	$data	=	array(
	'id'							=>"",
	'user_name'						=>	addslashes($_POST["user_name"]),
	'user_password'					=>	addslashes($_POST["user_password"]),
	'user_first_name'				=>	addslashes($_POST["fname"]),
	'user_last_name'				=>	addslashes($_POST["lname"]),
	'designation'					=>	$_POST["designation"]
	);
	$x = $database->insert_data($table_name, $data);
	
	if($x	==	'1')
	{
		echo '<script>alert("Sub Admin Created Successfully");</script>';
		exit ("<meta http-equiv='refresh' content='0;url=create-subadmin.php'>");
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Sub Admin</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>

<link rel="stylesheet" href="jquery-ui.css" />
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
var availableTags = [
"sandipa@magicnines.com",
"susmita@gmail.com",
"dolly@yahoo.com",
"suresh@gmail.com",
];
function split( val ) {
return val.split( /,\s*/ );
}
function extractLast( term ) {
return split( term ).pop();
}
$( "#tags" )
// don't navigate away from the field on tab when selecting an item
.bind( "keydown", function( event ) {
if ( event.keyCode === $.ui.keyCode.TAB &&
$( this ).data( "ui-autocomplete" ).menu.active ) {
event.preventDefault();
}
})
.autocomplete({
minLength: 0,
source: function( request, response ) {
// delegate back to autocomplete, but extract the last term
response( $.ui.autocomplete.filter(
availableTags, extractLast( request.term ) ) );
},
focus: function() {
// prevent value inserted on focus
return false;
},
select: function( event, ui ) {
var terms = split( this.value );
// remove the current input
terms.pop();
// add the selected item
terms.push( ui.item.value );
// add placeholder to get the comma-and-space at the end
terms.push( "" );
this.value = terms.join( ", " );
return false;
}
});
});
</script>
</head>
<body>
<div id="main_container">

<div class="header">
<div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;" /></div>


<?php require ("design/nav.php"); ?>

<div class="login_content" style="height:400px; width:430px; overflow:auto">

<br />
<h2><img src="images/admin.jpeg" alt="" title="" border="0" />&nbsp;Create Sub Admin</h2> 

<form name="create_subadmin_form" action="#" method="POST">
<table id="rounded-corner" width="98%">
<thead>
<tr>
<th scope="col" class="rounded-company">&nbsp;</th>
<th scope="col" class="rounded-q4">&nbsp;</th>
</tr>
</thead>
<tfoot></tfoot>
<tbody>

<tr>
<td for="tags">User Name</td>
<td  align="center"><input  name="user_name" id="user_name" class="form-inputbox" />
</td>
</tr>

<tr>
<td>Password</td>
<td  align="center"><input type="text" name="user_password" id="user_password" value="" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>First Name</td>
<td  align="center"><input type="text" name="fname" id="fname" value="" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Last Name</td>
<td  align="center"><input type="text" name="lname" id="lname" value="" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Designation</td>
<td align="center"><select name="designation" id="designation" class="form-inputbox">
<option value="">- Select -</option>
<option value="sub admin 1">1</option>
<option value="sub admin 2">2</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" align="right">
<input type="submit" name="create_sub_admin" value="Create Sub Admin " style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;" />
</td>
</tr>

</tbody>
</table>
</form>

</div>   <!--end of center content -->




<div class="clear"></div>
</div> <!--end of main content-->

<?php require("design/footer.php"); ?>


</div>		
</body>
</html>