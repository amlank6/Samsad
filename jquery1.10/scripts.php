<link rel="stylesheet" href="jquery-ui.css" />
<script src="jquery-1.9.1.js"></script>
<script src="jquery-ui.js"></script>

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
$(function() {
$("#search_input").autocomplete({
source: "source.php",
minLength: 1
});});

$(function() {
$("#search_input2").autocomplete({
source: "source2.php",
minLength: 1
});});
</script>