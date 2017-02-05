<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Mail Logs</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                               onmousedown="return false;"/></div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:400px; overflow:auto">

            <br/>

            <div class="page-header">
                <h2><i class="fa fa-envelope" aria-hidden="true"></i> EMAIL LOGS</h2>
            </div>

            <table id="rounded-corner" width="98%">
                <thead>
                <tr align="center">
                    <th scope="col" class="rounded-company"></th>
                    <th scope="col" class="rounded">To</th>
                    <th scope="col" class="rounded">Subject</th>
                    <th scope="col" class="rounded">Date</th>
                    <th scope="col" class="rounded-q4">Number Of Mails</th>

                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                <tr>

                </tr>
                <tr align="center">
                    <td><input type="checkbox" name=""/></td>
                    <td>sandipa@magicnines.com</td>
                    <td>Transection Details</td>
                    <td>18/07/2013</td>
                    <td>1</td>
                </tr>

                </tr>
                <tr align="center">
                    <td><input type="checkbox" name=""/></td>
                    <td>sandipa@magicnines.com</td>
                    <td>Transection Details</td>
                    <td>18/07/2013</td>
                    <td>1</td>
                </tr>

                <tr>
                    <td colspan="8">
                        <a href="#" class="bt_red"><span class="bt_red_lft"></span><strong>Delete Mail</strong><span
                                    class="bt_red_r"></span></a>
                        <a href="#" class="bt_blue"><span class="bt_blue_lft"></span><strong>View Mail</strong><span
                                    class="bt_blue_r"></span></a>
                    </td>
                </tr>

                </tbody>
            </table>

        </div>   <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>

</div>
</body>
</html>