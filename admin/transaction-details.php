<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["search"]))
{
    if (empty($_POST["datepicker"]) OR empty($_POST["datepicker1"]) OR empty($_POST["user_name"]))
    {
        echo '<script>alert("Please Select Date & User Name");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=dashboard.php'>");
    }

    else
    {
        $tableName = "logs_transaction";

        if ($_POST["user_name"] != "all")
        {
            $from = strtotime($_POST["datepicker"]);
            $to = strtotime($_POST["datepicker1"]);

            $query = "SELECT COUNT(*) as num FROM $tableName WHERE product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "'";
            $query1a = "SELECT * FROM $tableName WHERE product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "'";
            $fields = "product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "'";
            $count = $database->count_rows($tableName, $fields);
        }
        if ($_POST["user_name"] == "all")
        {
            $from = strtotime($_POST["datepicker"]);
            $to = strtotime($_POST["datepicker1"]);

            $query = "SELECT COUNT(*) as num FROM $tableName WHERE product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "'";
            $query1a = "SELECT * FROM $tableName WHERE product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "'";
            $fields = "product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "'";
            $count = $database->count_rows($tableName, $fields);
        }
    }
}
else
{
    $tableName = "logs_transaction";
    $query = "SELECT COUNT(*) as num FROM $tableName GROUP BY product_transaction_id ";
    $query1a = "SELECT * FROM $tableName GROUP BY product_transaction_id ";
    $fields = "1=1";
    $count = $database->count_rows($tableName, $fields);
}
?>

<?php
function get_cx_name($cx_id)
{
    $database = new Database_Framework;
    $database->connect_database();
    $database->select_database();
    $table = "customer_details";
    $fields = "*";
    $where = "unique_id='" . $cx_id . "'";
    $order = "id";
    $limit = "";
    $desc = "";
    $limitBegin = "0";
    $monitoring = false;
    $database_query1 = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

    foreach ($database_query1 as $r)
    {
        $name = ucfirst($r["name"]);
        return $name;
    }
}

function get_transaction_amt($tid)
{
    $database = new Database_Framework;
    $database->connect_database();
    $database->select_database();
    $table = "logs_transaction_amount";
    $fields = "*";
    $where = "transaction_id='" . $tid . "'";
    $order = "id";
    $limit = "";
    $desc = "";
    $limitBegin = "0";
    $monitoring = false;
    $database_query1 = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

    foreach ($database_query1 as $r)
    {
        return $r["amount"];
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transaction Details</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>

    <link rel="stylesheet" href="jquery/jquery-ui.css"/>
    <script src="jquery/jquery-1.9.1.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css"/>

    <script>
        $(function ()
        {
            $("#datepicker").datepicker({dateFormat: 'MM d, yy'});
        });
    </script>

    <script>
        $(function ()
        {
            $("#datepicker1").datepicker({dateFormat: 'MM d, yy'});
        });

    </script>
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                               onmousedown="return false;"/></div>


        <?php require("design/nav.php"); ?>

        <div class="center_content">

            <br/>

            <h2><img src="images/order.png" alt="" title="" border="0"/>&nbsp;Transaction Details</h2>

            <center>
                <table id="rounded-corner" width="95%">
                    <form name="name" method="post" action="#">
                        <tr>
                            <td>
                                <b>From:</b>
                            </td>
                            <td>
                                <input type="text" name="datepicker" id="datepicker" value="" class="form-inputbox"/>
                            </td>
                            <td>
                                <b>To:</b>
                            </td>
                            <td>
                                <input type="text" name="datepicker1" id="datepicker1" value="" class="form-inputbox"/>
                            </td>
                            <td>
                                <b>User Name:</b>
                            </td>
                            <td>
                                <select name="user_name" class="form-inputbox">
                                    <option value="all">ALL</option>
                                    <?php
                                    $table = "customer_details";
                                    $fields = "*";
                                    $where = "1=1";
                                    $order = "id";
                                    $limit = "";
                                    $desc = "";
                                    $limitBegin = "0";
                                    $monitoring = false;
                                    $database_query1 = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                    foreach ($database_query1 as $r)
                                    {
                                        $name = ucfirst($r["name"]);
                                        $id = $r["unique_id"];
                                        echo '<option value="' . $id . '">' . $name . '</option>';
                                    }

                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="6"><input type="submit" name="search" value="Search"
                                                   style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>
                            </td>
                        </tr>
                </table>
            </center>

            <br/>
            <br/>
            <br/>
            <table id="rounded-corner" width="98%">
                <thead>
                <tr align="center">
                    <th scope="col" class="rounded-company">&nbsp;</th>
                    <th scope="col" class="rounded">Transaction ID</th>
                    <th scope="col" class="rounded">Customer Name</th>

                    <th scope="col" class="rounded">Transaction Date</th>
                    <th scope="col" class="rounded">Transaction Amount</th>
                    <th scope="col" class="rounded">Transaction Status</th>
                    <th scope="col" class="rounded-q4">Edit Status</th>

                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                <?php
                if ($count > 0)
                {
                    $targetpage = "dashboard.php";
                    $limit = 10;
                    require("app/framework/pagination.php");

                    $i = 0;
                    while ($row = mysql_fetch_array($result))
                    {
                        $i++;
                        echo '<tr align="center">';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $row["product_transaction_id"] . '</td>';
                        echo '<td>' . get_cx_name($row["cx_id"]) . '</td>';
                        echo '<td>' . DATE('l, d-M-Y', $row["product_transaction_date"]) . '</td>';
                        echo '<td>' . get_transaction_amt($row["product_transaction_id"]) . '</td>';
                        echo '<td>' . $row["product_transaction_status"] . '</td>';
                        echo '<td><a href="edit-status.php?p_id=' . $row["product_transaction_id"] . '"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>';
                        echo '</tr>';
                    }
                }
                else
                {
                    echo '<tr align="center">';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</td>';
                    echo '<td>&nbsp;</a></td>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';

                }
                echo '</tbody>';
                echo '</form>';
                echo '</table>';
                if (empty($paginate))
                {
                    $paginate = "";
                }
                echo "<br /><center>" . $paginate . "</center>";
                ?>

                <!--end of center content -->


                <div class="clear"></div>
        </div> <!--end of main content-->

        <?php require("design/footer.php"); ?>

    </div>
</body>
</html>