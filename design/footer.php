   <div class="footer-upwrap">
     <div class="main-content">
     
       <div class="footer-left">
        <h2>about us</h2>
        <p style="text-align:justify;">The Samsad story is now part of Bengal's cultural history. Mahendranath Dutt (2.8.1899-18.10.1987), the Founder, played a significant role in the country's freedom struggle, before carrying his vision into publishing in 1951 for a newly independent country.In the initial phase, he sought to reclaim for a postcolonial generation the Bengali language and literature in its historical bearings and in its living connections with a fast expanding political and cultural scenario. <a href="about-us.php">Read More</a></p>
       </div>
       
       <div class="footer-mid">
        <h2>send your feedback</h2>
<form name="feedback" action="feedback_mail.php" method="post">

<div class="footer-formbox"><input type="text" class="footer-input" value="Enter Your name"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" name="Name" /></div>

<div class="footer-formbox"><input type="text" class="footer-input" value="Enter Your Email Id"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" name="Email"/></div>

<div class="footer-textbox"><textarea name="tetarea" class="footer-inputarea" value="Comments"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" value="Comments">Comments</textarea></div>

<div class="red-mbox1">
<?php 
if(isset($_SESSION["xyz_email"]))
{
$messege	=	$_SESSION["xyz_email"];
} 
else
{
$messege	=	"";
}
?>
<h3><?php echo $messege; ?></h3>

</div>

<div class="footer-buttonarea"><input type="submit" class="footer-button" value="Submit" /></div>

</form>
       </div>
       
       <div class="footer-last">
        <h2>contact us</h2>
        <p class="head">SHISHU SAHITYA SAMSAD (P) LTD</span></p>
        <p>32A, Acharya Prafulla Chandra Road Kolkata-700 009
         <br />West Bengal, India<br /><br /></p>

      <p>Phone : <span class="phone">91 (33) 2350-7669/3195</span></p>
      <p>Fax :   <span class="fax">91 (33) 2360-3508</span></p>
      <p>E-mail :  contact@samsadbooks.com  <span class="email">ss_samsad@yahoo.in</span></p>
       </div>
     
     </div>
   </div>
   
   <div class="footer-bottomwrap">
     <div class="main-content">
       
       <div class="footer-bottomleft">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about-us.php">About   us </a></li>
          <!-- <li><a href="product-listing.php">Books</a> </li> -->
          <li><a href="acheivements.php">Achievments</a></li>
          <li><a href="contact.php">Contact us</a></li>
        </ul>
       </div>
       
       <div class="footer-bottomright">
        <p>copyright &copy; 2013 | All Rights Reserved | <a href="privacy-policy.php" target="_blank">Privacy Policy</a> | <a href="return-policy.php" target="_blank"> Return Policy</a></p>
       </div>
     </div>
   </div>