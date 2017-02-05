<!----------------------------------colorbox ------------------------------------>
<script src="jquery1.10/jquery.min17.js"></script>
<link type="text/css" media="screen" rel="stylesheet" href="css/colorbox.css" />
<script src="colorbox/jquery.colorbox.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function($){
//Examples of how to assign the ColorBox event to elements
$("a[rel='example1']").colorbox();

$("a[rel='example2']").colorbox({transition:"fade"});
$("a[rel='example3']").colorbox({transition:"none", width:"740", height:"600"});
$("a[rel='example4']").colorbox({slideshow:true});
$(".example5").colorbox();
$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
$(".example7").colorbox({width:"66%", height:"79%", iframe:true});
$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
$(".example9").colorbox({
onOpen:function(){ alert('onOpen: colorbox is about to open'); },
onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
});

//Example of preserving a JavaScript event for inline calls.
$("#click").click(function(){ 
$('#click').css({"background-color":"#000", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
return false;
});
});
</script>
<!------------------------end colorbox------------------------------>