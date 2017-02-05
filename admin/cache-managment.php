<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();
$cache1 = new cache_tools();

if (isset($_GET["flush"]))
{
    $cache1->delete_cache();
    echo '<script>alert("Cache flush successfull");</script>';
    exit ("<meta http-equiv='refresh' content='0;url=cache-managment.php'>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cache Managment</title>
    <?php
    require_once('design/header_script.php');
    ?>
    <link rel="stylesheet" href="jquery/jquery-ui.css"/>
    <script src="jquery/jquery-ui.js"></script>
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
                <h2><i class="fa fa-microchip" aria-hidden="true"></i> SETTINGS</h2>
            </div>

            <table id="rounded-corner" width="98%">
                <thead>
                <tr align="center">
                    <th scope="col" class="rounded-company"></th>
                    <th scope="col" class="rounded">Cache Type</th>
                    <th scope="col" class="rounded">Cache Description</th>
                    <th scope="col" class="rounded">Cache Created</th>
                    <th scope="col" class="rounded-q4">Cache Status</th>

                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                <?php
                $i = 0;
                $filename = "../cache/" . md5("index.php");
                if (file_exists($filename))
                {
                    $i++;
                    echo '<tr align="center">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>Block HMTL Output</td>';
                    echo '<td>Page Block HTML</td>';
                    echo '<td>' . date("d F Y -  h:i:s.", filemtime($filename)) . '</td>';
                    echo '<td>ENABLED</td>';
                    echo '</tr>';
                    $i++;
                    echo '<tr align="center">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>Collections Data</td>';
                    echo '<td>Collections Data Files</td>';
                    echo '<td>' . date("d F Y -  h:i:s", filemtime($filename)) . '</td>';
                    echo '<td>ENABLED</td>';
                    echo '</tr>';
                }
                else
                {
                    $i++;
                    echo '<tr align="center">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>Block HMTL Output</td>';
                    echo '<td>Page Block HTML</td>';
                    echo '<td></td>';
                    echo '<td>Disabled</td>';
                    echo '</tr>';
                    $i++;
                    echo '<tr align="center">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>Collections Data</td>';
                    echo '<td>Collections Data Files</td>';
                    echo '<td></td>';
                    echo '<td>Disabled</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td colspan="5" align="right">
                        <br/>

                        <form name="flush_cache" action="#" method="GET">
                            <input type="submit" name="flush" value="Flush Cache Storage"
                                   style="background: url(images/button_bg.png) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #c24739; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>
                        </form>
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