<?php
class plain_mail
{
	function mail($to, $from, $cc, $reply_to, $subject, $content)
	{
		$num			=	md5(time());
		if(!empty($_FILES["upload"]["name"]))
		{
			$upload_name	=	$_FILES["upload"]["name"];
			$upload_type	=	$_FILES["upload"]["type"];
			$upload_size	=	$_FILES["upload"]["size"];
			$upload_temp	=	$_FILES["upload"]["tmp_name"];
			$fp				=	fopen($upload_temp, "rb");
			$file			=	fread($fp, $upload_size);
			$file			=	chunk_split(base64_encode($file));
			//Normal headers
			$headers		 =	"From:".$from."\r\n";
			$headers		.=	"Cc: ".$cc."\r\n";
			$headers		.=	"Reply-To: ".$reply_to."\r\n";
			$headers		.=	"MIME-Version: 1.0\r\n";
			$headers		.=	"Content-Type: multipart/mixed; ";
			$headers		.=	"boundary=".$num."\r\n";
			$headers		.=	"--".$num."\r\n";
			$headers		.=	"X-Mailer: PHP v".phpversion()."\r\n";
			// With message
			$headers		.=	"Content-Type: text/html; charset=iso-8859-1\r\n";
			$headers		.=	"Content-Transfer-Encoding: 8bit\r\n";
			$headers		.=	"".$content."\n";
			$headers		.=	"--".$num."\n";
			// Attachment headers
			$headers		.=	"Content-Type:".$upload_type." ";
			$headers		.=	"name=\"".$upload_name."\"r\n";
			$headers		.=	"Content-Transfer-Encoding: base64\r\n";
			$headers		.=	"Content-Disposition: attachment; ";
			$headers		.=	"filename=\"".$upload_name."\"\r\n\n";
			$headers		.=	"".$file."\r\n";
			$headers		.=	"--".$num."\r\n";
			mail($to, $subject, '', $headers);
			fclose($fp);
		}
		else
		{
			//Normal headers
			$headers		 =	"From:".$from."\r\n";
			$headers		.=	"Cc: ".$cc."\r\n";
			$headers		.=	"Reply-To: ".$reply_to."\r\n";
			$headers		.=	"MIME-Version: 1.0\r\n";
			$headers		.=	"Content-Type: multipart/mixed; ";
			$headers		.=	"boundary=".$num."\r\n";
			$headers		.=	"--".$num."\r\n";
			$headers		.=	"X-Mailer: PHP v".phpversion()."\r\n";
			// With message
			$headers		.=	"Content-Type: text/html; charset=iso-8859-1\r\n";
			$headers		.=	"Content-Transfer-Encoding: 8bit\r\n";
			$headers		.=	"".$content."\n";
			$headers		.= "--".$num."\n";
			mail($to, $subject , '' ,$headers);
		}
	}
}
?>