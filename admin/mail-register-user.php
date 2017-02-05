<?php
require("app/pages/head.php");
$database	=	new Database_Framework;
$database	->	connect_database();
$database	->	select_database();
$security	=	new Security_Framework();
$security	->	check_page_access();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mail to registered user</title>
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

<div class="login_content" style="height:400px; width:430px; overflow:auto;">

<br />
<h2><img src="images/mail.jpg" alt="" title="" border="0" />Mail to registered user</h2> 

<form action="#" method="POST">
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
<td for="tags">To </td>
<td>
<input id="tags" class="form-inputbox" />
</td>
</tr>

<tr>
<td>CC</td>
<td><input type="text" name="courier_id" value="" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Subject</td>
<td><input type="text" name="address" value="" cols="16" class="form-inputbox"/>
</td>
</tr>

<tr>
<td>Message</td>
<td><textarea type="text" name="courier_name" value="" class="form-inputbox" style="width: 250px; height: 100px;" ></textarea>
</td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="send_mail" value="Send Mail" style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;" />
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