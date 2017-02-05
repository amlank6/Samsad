<?php

require("libfuncs.php3");

$WorkingKey = "7afo9398wf465fo900" ; //put in the 32 bit working key in the quotes provided here
$Merchant_Id= $_POST['Merchant_Id'];
$Amount= $_REQUEST['Amount'];
$Order_Id= $_REQUEST['Order_Id'];
$Merchant_Param= $_REQUEST['Merchant_Param'];
$Checksum= $_REQUEST['Checksum'];
$AuthDesc=$_REQUEST['AuthDesc'];
$Checksum = verifyChecksum($Merchant_Id, $Order_Id , $Amount,$AuthDesc,$Checksum,$WorkingKey);

if($Checksum=="true" && $AuthDesc=="Y")
{
echo "<p><br>&nbsp;&nbsp;&nbsp;<center><strong>Thank you for your payment</strong></center></p>";
require("data-entry.php");
}

else if($Checksum=="true" && $AuthDesc=="B")
{
echo "<p><br>&nbsp;&nbsp;&nbsp;<center><strong>Thank you for shopping with us. We will keep you posted regarding the status of your order through e-mail</strong></center></p>";
require("data-entry.php");
}

else if($Checksum=="true" && $AuthDesc=="N")
{
echo "<p><br>&nbsp;&nbsp;&nbsp;<center><strong>Thank you for shopping with us. However,the transaction has been declined.</strong></center></p>";
}
else
{
echo "<p><br>&nbsp;&nbsp;&nbsp;<center><strong>Please contact site admininstrator</strong></center></p>";
}
?>

