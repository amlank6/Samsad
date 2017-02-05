<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();

$table = "user_details";
$fields = "*";
$where = "user_name	='" . $_SESSION["user_name"] . "'";
$order = "id";
$limit = "";    // 	Display Only 10 Rows
$desc = "";        //	0 Means Ascending Order 1 Means Descending Order
$limitBegin = "0";    //	Display Rows From O
$monitoring = false;    //	False Means Do Not Display Query
$database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

foreach ($database_query as $row)
{
    $old_password = $row["user_password"];
}

if (isset($_POST["change_password"]))
{
    $old = $_POST["Old-Password"];
    if ($old == $old_password)
    {
        $new1 = $_POST["New-Password"];
        $new2 = $_POST["Confirm-Password"];
        $new3 = $new1;
        if ($new1 == $new2)
        {
            $table_name = "user_details";
            $where = "user_name	='" . $_SESSION["user_name"] . "'";
            $data = array('user_password' => $new3);
            $flag = $database->update_data($table_name, $data, $where);
            echo '<script> alert("Password changed successfully");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=change-password.php'>");
        }
        else
        {
            echo '<script> alert("New & Retype Password not same");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=change-password.php'>");
        }
    }
    else
    {
        echo '<script> alert("Please provide your correct current password");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=change-password.php'>");
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Change Password</title>
    <?php
    require_once('design/header_script.php');
    ?>
    <link rel="stylesheet" href="jquery/jquery-ui.css"/>
    <script src="jquery/jquery-ui.js"></script>
    <script>
        <!--
        $(function ()
        {
            $("#datepicker").datepicker();
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
        <div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                               onmousedown="return false;"/></div>


        <?php require("design/nav.php"); ?>

        <div class="login_content" style="height:400px; overflow:auto">

            <br/>

            <div class="page-header">
                <h2><i class="fa fa-bar-chart" aria-hidden="true"></i> CHANGE PASSWORD</h2>
            </div>

            <form action="#" method="POST"
                  onsubmit="MM_validateForm('Old-Password','','R','New-Password','','R','Confirm-Password','','R');return document.MM_returnValue">
                <table id="rounded-corner" width="98%">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded-company">&nbsp;</th>
                        <th scope="col" class="rounded-q4">&nbsp;</th>
                    </tr>
                    </thead>
                    <tfoot></tfoot>
                    <tbody>

                    <tr>
                        <td>Old Password</td>
                        <td><input type="text" name="Old-Password" id="Old-Password" class="form-inputbox"/>
                        </td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td><input type="text" name="New-Password" id="New-Password" value="" class="form-inputbox"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="text" name="Confirm-Password" id="Confirm-Password" value=""
                                   class="form-inputbox"/>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="change_password"
                                                              value="Change Password"/>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </form>

        </div>   <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>


</div>
</body>
</html>