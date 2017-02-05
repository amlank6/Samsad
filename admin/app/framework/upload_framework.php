<?php
function upload_file()
{
	$filename 			= $_FILES["file"]["name"];
	$ext 				= pathinfo($filename, PATHINFO_EXTENSION);
	$allowed 			= array('docx', 'doc', 'txt', 'pdf','jpg', 'jpeg');
	
	//$new_filename		=	substr(md5(uniqid(mt_rand(), true)), 0, 8);
	$upload_dir 		= "../upload/";
	//$new_filename 		= str_replace(' ','',$new_filename);
	//$new_filename   	= strtolower($new_filename);
	//$new_filename		= $new_filename.".".$ext; 
	if(empty($filename))
	{
		$filename	=	"";
		return $filename;
	}
	else
	{
		if(!in_array($ext,$allowed)) 
		{
		echo '<script>alert("File Type Not Allowed")</script>';
		exit ("<meta http-equiv='refresh' content='0;url=task_form.php'>");
		} 
    
		else 
		{
		move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir. $filename);
		return $filename;
		}
	}
}
?>




