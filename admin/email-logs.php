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
    <title>Email Logs</title>

    <?php
    require_once('design/header_script.php');
    ?>

    <?php
    require("script1.php");
    ?>

</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;"/>
        </div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:400px; overflow:auto">

            <br/>

            <div class="page-header">
                <h2><i class="fa fa-envelope" aria-hidden="true"></i> EMAIL LOGS</h2>
            </div>
            <br/>


            <form name="shipment_details_form" action="#" method="post">
                <table class="table table-stripped">
                    <thead>
                    <tr align="center">
                        <th scope="col" class="rounded-company"></th>
                        <th scope="col" class="rounded">Send Total</th>
                        <th scope="col" class="rounded">Send Time</th>
                        <th scope="col" class="rounded-q4">Send To</th>
                    </tr>
                    </thead>
                    <tfoot>

                    </tfoot>


                    <tbody>
                    <?php
                    $tableName = "logs_email";
                    $query = "SELECT COUNT(*) as num FROM $tableName ";
                    $query1a = "SELECT * FROM $tableName ";
                    $targetpage = "email-logs.php";
                    $limit = 4;
                    require("app/framework/pagination.php");

                    $i = 0;
                    while ($row = mysql_fetch_array($result))
                    {
                        $i++;
                        echo '<tr align="center">';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $row["send_total"] . '</td>';
                        echo '<td>' . date("l d-M-Y", $row["send_time"]) . '</td>';
                        echo '<td>' . $row["send_to"] . '</td>';
                        echo '</tr>';
                    }
                    ?>

                    </tbody>
                </table>
                <?php
                if (empty($paginate))
                {
                    $paginate = "";
                }
                echo "<br /><center>" . $paginate . "</center>";
                ?>
            </form>

            <!-- </div>   <!--end of center content -->

            <div class="clear"></div>
        </div> <!--end of main content-->

        <?php require("design/footer.php"); ?>


    </div>
</body>
</html>