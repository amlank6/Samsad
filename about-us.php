<?php
require("app/pages/head.php");
$database	=	new	Database_Framework();
$database	->	connect_database();
$database	->	select_database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Samsad - About Us</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
<script>
"'article aside footer header nav section time'".replace(/\w+/g,function(n){document.createElement(n)})
</script>

<div id="outer_wrap">

<div class="head-wrap">
<div class="main-content">
<header>
<?php include("design/header.php");?>
</header>
</div>
</div>

<div class="inner-wrap">
<div class="main-content">

<div class="nav-area">

<div class="navigationarea">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<div class="nav-sep1"></div>
<li><a href="about-us.php" class="active">About Us</a></li>
<div class="nav-sep1"></div>
<?php
require("category-menu.php");
?>
<div class="nav-sep1"></div>
<li><a href="acheivements.php">Achievments</a></li>
<div class="nav-sep1"></div>
<li><a href="contact.php">Contact Us</a></li>
</ul>
</nav>
</div>

<div class="nav-rightarea">
<?php include("design/nav-searchbox.php");?>
</div>
</div>

<div class="wrap1">

<div class="innerpage-content">

<section class="page-link">
<p>Home > About Us</p>
</section>

<h1>About Us</h1>

  <div class="about-wrap">
    <div class="about-pic1"><img src="images/about-us-pics.jpg" width="290" /></div>
    <div class="about-rwrap">
    <h2>The Samsad story is now part of Bengal's cultural history</h2>
    <div class="about-sep1"></div>
    <p>The Samsad story is now part of 
    Bengal's cultural history Mahendranath Dutt (2.8.1899-18.10.1987), the Founder, played a significant role in the country's freedom 
    struggle, before carrying his vision into publishing in 1951 for a newly independent country</span>.<br /><br />In the initial phase, he 
    sought to reclaim for a postcolonial generation the Bengali language and literature in its historical bearings and in its living 
    connections with a fast expanding political and cultural scenario.</p></div>
  </div>
  
  <div class="about-sep"></div>
     
  <div class="about-wrap">         
   <div class="about-pic1"><img src="images/about-us-pics1.jpg"  width="290" /></div>
   <div class="about-rwrap">
   <h2> A series of dictionaries at different levels for Bengali</h2>
   <div class="about-sep1"></div>
   <p>The first publications included well annotated volumes of the 
   collected works of the makers of modern Bengali Literature in the second half of the nineteenth century, in reader-friendly format; 
   a series of dictionaries at different levels for Bengali,and for transactions between Bengali and English; and collections of 
   imaginatively illustrated nursery rhymes in Bengali.</p>
   </div>
  </div>
  
  <div class="about-sep"></div>
  
  <div class="about-wrap">         
   <div class="about-pic1"><img src="images/about-us-pics2.jpg"  width="290"/></div>
   <div class="about-rwrap">
   <h2>The three major lines of Samsad's publishing programme</h2>
   <div class="about-sep1"></div>
   <p>The three major lines of Samsad's publishing programme, defined at 
   once, have developed over the years to encompass an enormous body of publications, covering both language and specialized theme 
   dictionaries and encyclopaedias; children's books, including anthologies of the major writers for children in Bengali, authoritative 
   works of reference on Indian collected works of major writers in Bengali.</p></div>
  </div>
  
  <div class="about-sep"></div>
<!--<h3>Search Books</h3>

<div class="search-form">
<div class="category-select1">
<select class="category-selectbox">
<option selected="selected">Category</option>
<option>Children</option>
<option>Classic</option>
<option>Dictionaries</option>
<option>Reference Books </option>
</select>
</div>

<div class="search-textbox">
<input type="text" class="search-input" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;"  value="Enter Book Name"  />
</div>


<div class="category-select2">
<select class="category-selectbox">
<option selected="selected">Select Author Name</option>
<option>Children</option>
<option>Classic</option>
<option>Dictionaries</option>
<option>Reference Books </option>
</select>
</div>


</div>
<div class="search-buttoarea"><input type="submit" class="search-button" value="SEARCH" /></div>-->
</div>

</div>
</div>

</div>

<div class="footer-wrap">
<?php include("design/footer.php");?>
</div>
</div>
</body>
</html>
