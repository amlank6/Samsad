<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();


if (isset($_POST["store_add"]))
{
    $table_name = "settings_store";
    $fields = "*";
    $where = "1=1";
    $data = array(
            'id' => "",
            'taxable' => $_POST["tax_status"],
            'taxable_value' => addslashes($_POST["tax_value"]),
            'currency' => $_POST["currency"],
            'shipping_charges' => addslashes($_POST["shipping_charges"])
    );

    $x = $database->update_data($table_name, $data, $where);
    if ($x = '1')
    {
        echo '<script>alert("Payment settings added successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
    }
}

if (isset($_POST["store_maintenace"]))
{
    $i = $_POST["maintenance_mode"];
    switch ($i)
    {
        case 0:
            $my_file = '../websitedown.true';
            $handle = fopen($my_file, 'w');
            chmod($my_file, 0777);
            fclose($handle);
            echo '<script>alert("Maintenance Mode Activated");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
            break;
        case 1:
            $my_file = '../websitedown.true';
            $my_new_file = '../websitedown.false';
            if (file_exists($my_file))
            {
                rename($my_file, $my_new_file);
            }
            echo '<script>alert("Maintenance Mode Deactivated");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
            break;
        default:
            exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
    }
}

if (isset($_POST["store_email"]))
{


    if (!empty($_POST["email_admin"]) AND filter_var($_POST["email_admin"], FILTER_VALIDATE_EMAIL) AND !empty($_POST["site_link"]))
    {
        $email = str_replace(" ", "", $_POST["email_admin"]);
        $table_name = "settings_email";
        $fields = "*";
        $where = "id='1'";
        $data = array('email_id' => addslashes($email));

        $link = str_replace(" ", "", $_POST["site_link"]);
        $table_name2 = "settings_link";
        $data2 = array('link' => addslashes($link));

        $x = $database->update_data($table_name, $data, $where);
        $y = $database->update_data($table_name2, $data2, $where);

        if ($x == '1' AND $y == '1')
        {
            echo '<script>alert("Account settings has been saved");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please enter valid Email ID & Site Link");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
    }

}

if (isset($_POST["payment_gateway"]))
{
    $table_name = "settings_payment_gateway";
    $fields = "*";
    $where = "id='1'";
    $data = array(
            'Merchant_ID' => addslashes($_POST["merchant_id"]),
            'Redirect_URL' => addslashes($_POST["redirect_url"]),
            'Working_KEY' => addslashes($_POST["working_key"])
    );

    $x = $database->update_data($table_name, $data, $where);
    if ($x = '1')
    {
        echo '<script>alert("Payment Gateway Details Saved");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=settings.php'>");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Settings</title>
    <?php
    require_once('design/header_script.php');
    ?>
    <link rel="stylesheet" href="jquery/jquery-ui.css"/>
    <script src="jquery/jquery-ui.js"></script>
    <script>
        $(function ()
        {
            $("#tabs").tabs();
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
            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-cog" aria-hidden="true"></i> SETTINGS</h2>
                </div>
            </div>

            <div class="row" style="padding-bottom: 20px;">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Account</a></li>
                        <li><a href="#tabs-2">System</a></li>
                        <li><a href="#tabs-3">Store</a></li>
                        <li><a href="#tabs-4">Payment Integration</a></li>
                    </ul>

                    <div id="tabs-1">
                        <form name="setting_account" method="post" action="#">

                            <div class="form-group">
                                <label for="From">Email: </label>
                                <input type="text" name="email_admin" id="email_admin" placeholder="Email"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="To">Site Link: </label>
                                <input type="text" name="site_link" id="site_link"
                                       placeholder="http://www.myholidaydeals.in/project/samsad/" class="form-control">
                            </div>


                            <input type="submit" name="store_email" value="Save Settings"
                                   class="btn btn-info"/>


                        </form>
                    </div>

                    <div id="tabs-2">
                        <form name="maintenance" method="post" action="#">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="maintenance_mode">Maintenance Mode: </label>
                                    <select name="maintenance_mode" id="maintenance_mode" class="form-control">
                                        <option value="0">Yes</option>
                                        <option value="1" SELECTED>No</option>
                                    </select>
                                </div>
                            </div>


                            <input type="submit" name="store_maintenace" value="Save"
                                   class="btn btn-info"/>
                        </form>
                    </div>

                    <div id="tabs-3">
                        <form name="tabs_3_form" method="post" action="#">

                            <?php
                            $table = "settings_store";
                            $fields = "*";
                            $where = "1=1";
                            $order = "id";
                            $limit = "";
                            $desc = "";
                            $limitBegin = "0";
                            $monitoring = false;
                            $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                            foreach ($database_query as $row)
                            {
                                $id = $row["id"];
                                $taxable = $row["taxable"];
                                $taxable_value = $row["taxable_value"];
                                $currency = $row["currency"];
                                $shipping_charges = $row["shipping_charges"];
                            }
                            ?>


                            <div class="form-group">
                                <label for="tax_status">Tax: </label>
                                <select name="tax_status" id="tax_status" class="form-control">
                                    <option value="0" <?php if ($taxable == "0")
                                    {
                                        echo "selected=\"selected\"";
                                    } ?>>Yes
                                    </option>
                                    <option value="1" <?php if ($taxable == "1")
                                    {
                                        echo "selected=\"selected\"";
                                    } ?>>No
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="From">Tax Value: </label>
                                <input type="text" name="tax_value" value="<?php echo $taxable_value; ?>"
                                       class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="currency">Currency: </label>
                                <select name="currency" id="currency" class="form-control">
                                    <option value="0" <?php if ($taxable == "0")
                                    {
                                        echo "selected=\"selected\"";
                                    } ?>>Yes
                                    </option>
                                    <option value="1" <?php if ($taxable == "1")
                                    {
                                        echo "selected=\"selected\"";
                                    } ?>>No
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shipping_charges">Shipping Charges: </label>
                                <input type="text" name="shipping_charges" id="shipping_charges"
                                       value="<?php echo $shipping_charges; ?>" class="form-control"/>
                            </div>


                            <input type="submit" name="store_add" value="Save"
                                   style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>


                        </form>
                    </div>

                    <div id="tabs-4">
                        <form name="gateway" method="post" action="#">

                            <?php
                            $table = "settings_payment_gateway";
                            $fields = "*";
                            $where = "id = '1'";
                            $order = "id";
                            $limit = "";
                            $desc = "";
                            $limitBegin = "0";
                            $monitoring = false;
                            $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                            foreach ($database_query as $row)
                            {
                                $Merchant_ID = $row["Merchant_ID"];
                                $Redirect_URL = $row["Redirect_URL"];
                                $Working_KEY = $row["Working_KEY"];
                            }
                            ?>

                            <div class="form-group">
                                <label for="merchant_id">Merchant Id: </label>
                                <input type="text" name="merchant_id" value="<?php echo $Merchant_ID; ?>"
                                       class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="redirect_url">Redirect Url: </label>
                                <input type="text" name="redirect_url" value="<?php echo $Redirect_URL; ?>"
                                       class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="working_key">Working Key: </label>
                                <input type="text" name="working_key" value="<?php echo $Working_KEY; ?>"
                                       class="form-control"/>
                            </div>

                            <input type="submit" name="payment_gateway" value="Save"
                                   style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>

                        </form>
                    </div>

                </div>
            </div>

        </div>    <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>

</div>
</body>
</html>