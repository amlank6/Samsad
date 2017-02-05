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
$(function() {
$("#country").autocomplete({
source: "jquery1.10/country.php",
minLength: 3
});});

$(function() {
$("#city").autocomplete({
source: "jquery1.10/city.php",
minLength: 2
});});

$(function() {
$("#state").autocomplete({
source: "jquery1.10/state.php",
minLength: 2
});});

$(function() {
$("#postal_code").autocomplete({
source: "jquery1.10/pincode.php",
minLength: 4
});});
</script>