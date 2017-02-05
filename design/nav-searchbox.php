<?php
if(isset($_POST["search_head_books"]))
{
	if($_POST["browse_bok"] == "")
	{
	echo '<script>alert("Please enter book name");</script>';
	exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	}
	else
	{
	exit ("<meta http-equiv='refresh' content='0;url=search-book.php?p_name=".$_POST["browse_bok"]."'>");
	}
}
?>
<link rel="stylesheet" href="jquery1.10/jquery-ui.css" />
<script src="jquery1.10/jquery-1.9.1.js"></script>
<script src="jquery1.10/jquery-ui.js"></script>

 <style>
.ui-autocomplete {
max-height: 100px;
overflow-y: auto;
/* prevent horizontal scrollbar */
overflow-x: hidden;
}
/* IE 6 doesn't support max-height
* we use height instead, but this forces the menu to always be this tall
*/
* html .ui-autocomplete {
height: 100px;
}
</style>
<script type="text/javascript">
jQuery.noConflict()(function($) {
$("#browse_bok").autocomplete({
source: "jquery1.10/source.php",
minLength: 3
});});

</script>

<form name="browhead" method="post" action="#">
<div class="navright-text">Browse by books</div>
<div class="nav-formbox"><input name="browse_bok" id="browse_bok" type="text" class="nav-inputbox" value=""/></div>
<div class="search-buttonarea"><input name="search_head_books" type="submit" class="search-button" value=""/></div>
</form>