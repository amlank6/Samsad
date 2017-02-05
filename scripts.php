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
$("#search_input").autocomplete({
source: "jquery1.10/source.php",
minLength: 3
});});

jQuery.noConflict()(function($) {
$("#search_input2").autocomplete({
source: "jquery1.10/source2.php",
minLength: 3
});});
</script>