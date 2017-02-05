<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["search"]))
{
    if (empty($_POST["search_customer"]))
    {
        echo '<script>alert("Please Select Customer Name")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=user-details.php'>");
    }
    else
    {
        /*$table			=	"customer_details";
        $fields			=	"*";
        $where			=	"name='".$_POST["search_customer"]."'";
        $order 			= 	"id";
        $limit 			= 	"";
        $desc			=	"";
        $limitBegin		=	"0";
        $monitoring 	=	false;
        $database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
        */
        //// +++= PAGINATION VARIABLES DECLARED =+++ ///
        $tableName = "customer_details";
        $query = "SELECT COUNT(*) as num FROM $tableName ";
        $query1a = "SELECT * FROM $tableName WHERE name='" . $_POST["search_customer"] . "'";
        $targetpage = "user-details.php";
        $limit = "10";
        require("app/framework/pagination.php");
        ///////////////////////////////////////////////
    }
}
else
{
    /*$table			=	"customer_details";
    $fields			=	"*";
    $where			=	"1=1";
    $order 			= 	"id";
    $limit 			= 	"";
    $desc			=	"";
    $limitBegin		=	"0";
    $monitoring 	=	false;
    $database_query	=	$database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
*/
//// +++= PAGINATION VARIABLES DECLARED =+++ ///
    $tableName = "customer_details";
    $query = "SELECT COUNT(*) as num FROM $tableName ";
    $query1a = "SELECT * FROM $tableName ";
    $targetpage = "user-details.php";
    $limit = "10";
    require("app/framework/pagination.php");
    ///////////////////////////////////////////////
}
if (isset($_POST["delete"]))
{
    if (isset($_POST["check"]))
    {
        foreach ($_POST["check"] as $value)
        {
            $table_name = "customer_details";
            $where = "unique_id='" . $value . "'";
            $database->delete_data($table_name, $where);
        }
        echo '<script>alert("Selected user has been deleted")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=user-details.php'>");
    }
    else
    {
        echo '<script>alert("Please select customer name to delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=user-details.php'>");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
                    <h2><i class="fa fa-user-circle" aria-hidden="true"></i> USER DETAILS</h2>
                </div>
            </div>

            <div class="row" style="text-align: center;">
                    <form class="form-inline" name="user_details_form" method="post" action="#">

                        <div class="form-group">
                            <label for="search_customer">Enter Name: </label>
                            <input type="text" class="form-control" name="search_customer" id="search_customer"
                                   placeholder="Customer Name">
                        </div>


                        <button type="submit" class="btn btn-success" name="search"><i class="fa fa-search"
                                                                                       aria-hidden="true"></i> Search
                        </button>

            </div>

            <div class="row"  style="padding-top: 40px;">
                <table class="table table-striped table-bordered" width="98%">
                    <thead>
                    <tr align="center">
                        <th scope="col" class="rounded-company"></th>
                        <th scope="col" class="rounded">Customer Name</th>
                        <th scope="col" class="rounded">Email Id</th>
                        <th scope="col" class="rounded">Phone No</th>
                        <th scope="col" class="rounded">Pincode</th>
                        <th scope="col" class="rounded">Address</th>
                        <th scope="col" class="rounded">State</th>
                        <!--<th scope="col" class="rounded">Country</th>-->
                        <th scope="col" class="rounded">Newsletter Subscription</th>
                        <!--<th scope="col" class="rounded-q4">Registered On</th>-->
                    </tr>
                    </thead>
                    <tfoot></tfoot>
                    <tbody>
                    <tr>

                        <?php

                        /*if(empty($database_query))
                        {
                            echo '</tr>';
                            echo '<tr align="center">';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '</tr>';

                            echo '</tr>';
                            echo '<tr align="center">';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '<td>&nbsp;</td>';
                            echo '</tr>';
                        }
                        else
                        {
                            */

                        while ($row = mysql_fetch_array($result))
                        {
                            $name = $row["name"];
                            $unique_id = $row["unique_id"];
                            $email_id = $row["email_id"];
                            $contact_no = $row["contact_no"];
                            $address = $row["address"];
                            $city = $row["city"];
                            $postal_code = $row["postal_code"];
                            $country = $row["country"];
                            $state = $row["state"];
                            $registered_on = date('l,d F Y', $row["registered_on"]);
                            $news_letter_suds = $row["news_letter_suds"];
                            if ($news_letter_suds == '0')
                            {
                                $news_letter_suds = 'Yes';
                            }
                            else
                            {
                                $news_letter_suds = 'No';
                            }

                            echo '<tr align="center">';
                            echo '<td><input type="checkbox" name="check[]" value="' . $unique_id . '" /></td>';
                            echo '<td>' . $name . '</td>';
                            echo '<td>' . $email_id . '</td>';
                            echo '<td>' . $contact_no . '</td>';
                            echo '<td>' . $postal_code . '</td>';
                            echo '<td>' . $address . '</td>';
                            echo '<td>' . $state . '</td>';
                            //echo '<td>'.$country.'</td>';
                            echo '<td>' . $news_letter_suds . '</td>';
                            //echo '<td>'.$registered_on.'</td>';
                            echo '</tr>';
                        }
                        echo '<tr>';
                        echo '<td colspan="10" align="right" >';
                        echo '<button name="delete" value="Delete Item" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete Item</button>';
                        echo '</tr>';
                        //}
                        ?>


                    </tbody>
                    </form>
                </table>
                <?php echo "<br /><br /><center>" . $paginate . "</center>"; ?>
            </div>
        </div>

        <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>

</div>
</body>
</html>