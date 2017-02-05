
<link rel="stylesheet" href="css/mooslide.css" type="text/css" media="screen" />
    <!-- Mootools - the core -->
	<script type="text/javascript" src="js/mootools12.js"></script>
    <!-- MooSlide (show/hide login form) -->
	<script type="text/javascript" src="js/mooSlide2-moo12.js"></script>
	<script language="javascript" type="text/ecmascript">
	window.addEvent('domready',function(){
		var myLogin = new mooSlide2({ slideSpeed: 1500, fadeSpeed: 500,  toggler:'login', content:'loginPanel', height:250, close: false, effects:Fx.Transitions.Bounce.easeOut , from:'top'});
		//optional: AutoStart the slider on page load:
		//MyLogin.run();
	    $('close').addEvent('click', function(e){
			e = new Event(e);
			myLogin.clearit();
			e.stop();
		});
	});
	</script>



<a href="index.php"><div class="logo"></div></a>
<div class="right-headpanel">
<div class="head-menu">
<!--
<ul>
<li>24x7 Customer Support  - </li>
<li><a href="contact.php">Contact Us</a></li>
<li>|</li>
<li><a href="account-settings.php">Account</a></li>
<li>|</li>
<li><a href="#">Wishlist</a></li>
<li>|</li>
<li><a href="account-login.php">Login </a></li>
</ul>
</div>

<div class="head-menu1">
<ul>
<li><a href="#">e-Gift Voucher</a> </li>
<li>|</li>
<li><a href="#">Wallet</a></li>
<li>|</li>
<li><a href="shopping-cart-list.php">Digital Cart

</a></li>
<li>|</li>
<li><a href="#">Wish List</a></li>
</ul>
-->
</div>

<div class="head-buttonarea">
<!--<div class="head-button">
<a href="shopping-cart-list.php"><img src="images/cart.png" alt=""></a>
<a href="shopping-wish-list.php">View Wish List</a>
</div>-->
<?php
if(isset($_SESSION["registered_user"]))
{
	echo '<div style="float:right; position:relative; bottom:30px; right:20px;">Welcome '.$_SESSION["registered_user"].'&nbsp;|&nbsp<a href="logout.php">Logout</a></div><br />';
	
}
?>
<div class="head-button"><?php if(!isset($_SESSION["registered_user"]))echo '<a href="account-login.php"  id="login">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</a>'; ?><a href="user-registration.php">&nbsp;Register&nbsp;</a><a href="shopping-wish-list.php">Wish List</a><a href="shopping-cart-list.php">View cart</a></div>
<!--<div class="head-button"></div>
<div class="head-button"></div>
<div class="head-button"></div>-->

<!--<div class="head-button"><a href="account-login.php">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</a></div>
<div class="head-button"><a href="user-registration.php">&nbsp;Register&nbsp;</a></div>
<div class="head-button"><a href="shopping-wish-list.php">Wish List</a></div>
<div class="head-button"><a href="shopping-cart-list.php">View cart</a></div>-->


</div>

</div>