<?php
require("app/pages/head.php");
$database = new Database_Framework();
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();


$table = "logs_transaction";
$fields = "*";
$where = "product_transaction_id='" . $_GET["id"] . "'";
$order = "id";
$limit = "";
$desc = "";
$limitBegin = "0";
$monitoring = false;
$database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);


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
        return $r["is_approved"];
    }
}

function get_product_name($pcode)
{
    $database = new Database_Framework();
    $database->connect_database();
    $database->select_database();
    $table = "product";
    $fields = "*";
    $where = "product_code='" . $pcode . "'";
    $order = "id";
    $limit = "";
    $desc = "";
    $limitBegin = "0";
    $monitoring = false;
    $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
    foreach ($database_query as $row)
    {
        return $row["p_name"];
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchase Details</title>
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
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                 onmousedown="return false;"/>
        </div>

        <?php require("design/nav.php"); ?>

        <div class="center_content">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> ORDER DETAILS</h2>
                </div>
            </div>

            <div class="row">
                <div class="form-group">

                    <input id="id" type="hidden" value="<?php echo $_GET['id'] ?>">
                    <label><strong>Approve Order:&nbsp&nbsp</strong></label>
                    <input name="my-checkbox" type="checkbox" onclick="approveOrder(<?php echo $_GET['id']; ?>)"
                           class="form-control pull-right" data-size="mini"
                            <?php if (get_approve_status($_GET['id']))
                            {
                                echo 'checked disabled ';
                            }
                            else
                            {
                                echo '';
                            } ?> >

                </div>
            </div>
            <br>
            <table class="table table-striped" width="98%">
                <thead>
                <tr align="center">

                    <th style="text-align: center;">Sr.No</th>
                    <th style="text-align: center;">Transaction ID</th>
                    <th style="text-align: center;">Product Name</th>
                    <th style="text-align: center;">Product Price</th>
                    <th style="text-align: center;">Total Price</th>
                    <th style="text-align: center;">Product Quantity</th>

                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                <tr>

                    <?php
                    $i = 0;
                    $tamt = 0;
                    foreach ($database_query as $row)
                    {
                        $product_name = get_product_name($row["product_name"]);

                        $i++;
                        echo "<tr>";
                        echo '<td align="center">' . $i . '</td>';
                        echo '<td align="center">' . $row["product_transaction_id"] . '</td>';
                        echo '<td align="center">' . $product_name . '</td>';
                        echo '<td align="center">' . $row["product_amount"] . '.00 Rs</td>';
                        echo '<td align="center">' . $row["product_amount"] * $row["product_quantity"] . '.00 Rs</td>';
                        $tamt1 = $row["product_amount"] * $row["product_quantity"];
                        $tamt = (int)$tamt + (int)$tamt1;
                        echo '<td align="center">' . $row["product_quantity"] . '</td>';
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo '<td align="center" colspan="6"><hr></td>';
                    echo "</tr>";

                    echo "<tr>";
                    echo '<td align="center">&nbsp;</td>';
                    echo '<td align="center"></td>';
                    echo '<td align="center"></td>';
                    echo '<td align="center"><strong>Total Amount</td>';
                    echo '<td align="center"><strong> Rs ' . $tamt . '.00<br />(Exclusive of VAT & Shipping Charges)</td>';
                    echo "<td></td>";
                    echo "</tr>";

                    ?>

                </tbody>

            </table>

        </div>   <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <script type="application/javascript">
        $("[name='my-checkbox']").bootstrapSwitch();

        $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function (event, state)
                {
                    console.log(this); // DOM element
                    console.log(event); // jQuery event
                    console.log(state); // true | false

                    var tmp = $('input[name="my-checkbox"]').is(':checked');
                    var id = $("#id").val();

                    if (tmp == true)
                    {
                        $.get('ajaxOperations/approveOrder.php?id=' + id, function (data)
                        {
                            if (data == 'true')
                            {
                                alert('UPDATED');
                            }
                            else if (data == 'false')
                            {
                                alert('NOT UPDATED');
                            }
                        });
                    }
                    else
                    {
                        alert('Cannot Be Deapproved after being approved');

                    }
                }
        );

    </script>
    <?php require("design/footer.php"); ?>

</div>
</body>
</html>