<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Page</title>
<head>
<style type="text/css">
ul.pagination 
{
	font-family: "Arial", "Helvetica", sans-serif;
	font-size: 14px;
	height: 100%;
	list-style-type: none;
	margin: 20px 0 0 170px;
	overflow: hidden;
	padding: 0;
}
ul.pagination li.details 
{
	background-color: white;
	border-color: #C8D5E0;
	border-image: none;
	border-style: solid;
	border-width: 1px 1px 2px;
	color: #1E598E;
	font-weight: bold;
	padding: 8px 10px;
	text-decoration: none;
}
ul.pagination li.dot 
{
	padding: 3px 0;
}
ul.pagination li 
{
	float: left;
	list-style-type: none;
	margin: 0 3px 0 0;
}
ul.pagination li:first-child {
	margin-left: 0;
}
ul.pagination li a {
	color: black;
	display: block;
	padding: 7px 10px;
	text-decoration: none;
}
ul.pagination li a img {
	border: medium none;
}
ul.pagination li a.current {
	background-color: white;
	border-radius: 0 0 0 0;
	color: #333333;
}
ul.pagination li a.current:hover {
	background-color: white;
}
ul.pagination li a:hover {
	background-color: #C8D5E0;
}
ul.pagination li a {
	background-color: #F6F6F6;
	border-color: #C8D5E0;
	border-image: none;
	border-style: solid;
	border-width: 1px 1px 2px;
	color: #1E598E;
	display: block;
	font-weight: bold;
	padding: 8px 10px;
	text-decoration: none;
}

</style>
</head>
<body>
</body>
</html>


<?php
$total_pages 	= 	mysql_fetch_array(mysql_query($query));
$total_pages 	= 	$total_pages['num'];

$stages = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 0;
if($page){
$start = ($page - 1) * $limit; 
}else{
$start = 0;	
}	
// Get page data
$query1b 		= 	"LIMIT $start, $limit";
$query1		=	$query1a.$query1b;
$result = mysql_query($query1);

// Initial page num setup
if ($page == 0){$page = 1;}
$prev = $page - 1;	
$next = $page + 1;							
$lastpage = ceil($total_pages/$limit);		
$LastPagem1 = $lastpage - 1;					


$paginate = '';
if($lastpage > 1)
{	

$paginate .= "<ul class='pagination'>";
// Previous
if ($page > 1){
$paginate.= "<li><a href='$targetpage?page=$prev'>Previous</a></li>";
}else{
$paginate.= "<li><a class='current'>Previous</a></li>";	}



// Pages	
if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
{	
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page){
$paginate.= "<li><a class='current'>$counter</a></li>";
}else{
$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
}
}
elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
{
// Beginning only hide later pages
if($page < 1 + ($stages * 2))		
{
for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
{
if ($counter == $page){
$paginate.= "<li><a class='current'>$counter</a></li>";
}else{
$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
}
$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
}
// Middle hide some front and some back
elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
{
$paginate.= "<li><a href='$targetpage?page=1'>1</a></li>";
$paginate.= "<li><a href='$targetpage?page=2'>2</a></li>";
for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
{
if ($counter == $page){
$paginate.= "<li><a class='current'>$counter</a></li>";
}else{
$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}						
}
$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
}
else
{
$paginate.= "<li><a href='$targetpage?page=1'>1</a></li>";
$paginate.= "<li><a href='$targetpage?page=2'>2</a></li>";
for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page){
$paginate.= "<li><a class='current'>$counter</a></li>";
}else{
$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
}
}
}

if ($page < $counter - 1){ 
$paginate.= "<li><a href='$targetpage?page=$next'>Next</a></li>";
}else{
$paginate.= "<li><a class='current'>Next</a></li>";
}

$paginate.= "</div>";		
}
?>