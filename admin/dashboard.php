<?php
require("app/pages/head.php");

$database = new Database_Framework;
$database->connect_database();
$database->select_database();

$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["search"]))
{
    $tableName = "logs_transaction";

    if ($_POST["user_name"] != "all")
    {
        $from = strtotime($_POST["From"]);
        $to = strtotime($_POST["To"]);

        $query = "SELECT COUNT(*) as num FROM $tableName WHERE product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "' GROUP BY product_transaction_id ";
        $query1a = "SELECT * FROM $tableName WHERE product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "' GROUP BY product_transaction_id ";
        $fields = "product_transaction_date BETWEEN " . $from . " AND " . $to . " AND cx_id = '" . $_POST["user_name"] . "'";
        $count = $database->count_rows($tableName, $fields);
    }
    if ($_POST["user_name"] == "all")
    {
        $from = strtotime($_POST["From"]);
        $to = strtotime($_POST["To"]);

        $query = "SELECT COUNT(*) as num FROM $tableName WHERE product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "' GROUP BY product_transaction_id ";
        $query1a = "SELECT * FROM $tableName WHERE product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "' GROUP BY product_transaction_id ";
        $fields = "product_transaction_date BETWEEN '" . $from . "' AND '" . $to . "'";
        $count = $database->count_rows($tableName, $fields);
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

function get_approve_status($tid)
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
        if ($r["is_approved"] == 0)
            return "Not Approved";
        else
            return "Approved";
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>

    <?php
    require_once('design/header_script.php');
    ?>
    <style>
        th {
            text-align: center;
        }
    </style>
    <script>
        $(function ()
        {
            $("#From").datepicker({dateFormat: 'MM d, yy'});
        });
    </script>

    <script>
        <!--
        $(function ()
        {
            $("#To").datepicker({dateFormat: 'MM d, yy'});
        });

        function MM_findObj(n, d)
        { //v4.01
            var p, i, x;
            if (!d) d = document;
            if ((p = n.indexOf("?")) > 0 && parent.frames.length)
            {
                d = parent.frames[n.substring(p + 1)].document;
                n = n.substring(0, p);
            }
            if (!(x = d[n]) && d.all) x = d.all[n];
            for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
            for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
            if (!x && d.getElementById) x = d.getElementById(n);
            return x;
        }

        function MM_validateForm()
        { //v4.0
            var i, p, q, nm, test, num, min, max, errors = '', args = MM_validateForm.arguments;
            for (i = 0; i < (args.length - 2); i += 3)
            {
                test = args[i + 2];
                val = MM_findObj(args[i]);
                if (val)
                {
                    nm = val.name;
                    if ((val = val.value) != "")
                    {
                        if (test.indexOf('isEmail') != -1)
                        {
                            p = val.indexOf('@');
                            if (p < 1 || p == (val.length - 1)) errors += '- ' + nm + ' must contain an e-mail address.\n';
                        } else if (test != 'R')
                        {
                            num = parseFloat(val);
                            if (isNaN(val)) errors += '- ' + nm + ' must contain a number.\n';
                            if (test.indexOf('inRange') != -1)
                            {
                                p = test.indexOf(':');
                                min = test.substring(8, p);
                                max = test.substring(p + 1);
                                if (num < min || max < num) errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
                            }
                        }
                    } else if (test.charAt(0) == 'R') errors += '- ' + nm + ' is required.\n';
                }
            }
            if (errors) alert('The following error(s) occurred:\n' + errors);
            document.MM_returnValue = (errors == '');
        }
        //-->
    </script>
</head>
<body>
<div id="main_container">

    <div class="header">

        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                 onmousedown="return false;"/>
        </div>

        <?php require("design/nav.php"); ?>

        <div class="center_content">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> DASHBOARD</h2>
                </div>
            </div>

            <div class="row" style="text-align: center;">
                <form class="form-inline" action="#" method="post" name="name1"
                      onsubmit="MM_validateForm('From','','R','To','','R');return document.MM_returnValue">
                    <div class="form-group">
                        <label for="From">From: </label>
                        <input type="text" class="form-control" name="From" id="From" placeholder="DD/MM/YYY">
                    </div>
                    <div class="form-group">
                        <label for="To">To: </label>
                        <input type="text" class="form-control" name="To" id="To" placeholder="DD/MM/YYYY">
                    </div>
                    <div class="form-group">
                        <label for="Customer">Customer: </label>
                        <select name="user_name" class="form-control">
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
                    </div>
                    <button type="submit" class="btn btn-success" name="search"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i> Search
                    </button>
                </form>
            </div>


            <div style="padding-top: 40px;" class="row">
                <table class="table table-striped" width="98%">
                    <thead>
                    <tr align="center">
                        <th>&nbsp;</th>
                        <th>Transaction ID</th>
                        <th>Customer Name</th>
                        <th>Transaction Date</th>
                        <th>Transaction Amount</th>
                        <th>Transaction Status</th>
                        <th>Customer Details</th>
                        <th>Purchase Details</th>
                        <th>Approved</th>

                    </tr>
                    </thead>
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
                            echo '<td><a href ="show-detail.php?id=' . $row["cx_id"] . '"><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i></a></td>';
                            echo '<td><a href ="purchase-detail.php?id=' . $row["product_transaction_id"] . '"><i class="fa fa-money fa-2x" aria-hidden="true"></i></a></td>';
                            echo '<td>' . get_approve_status($row["product_transaction_id"]) . '</td>';
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
                    ?>
                    </tbody>
                </table>

            </div>
            <?php
            if (empty($paginate))
            {
                $paginate = "";
            }
            echo "<br /><center>" . $paginate . "</center>";
            ?>
            <!--end of center content -->
        </div>

    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>
</div>

</body>
</html>