<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$rand = new Random_Variables();
$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["update"]))
{
    $table_name = "sub_category";
    $where = "unique_id='" . $_GET['sub_uid'] . "'";
    $data = array(
            'name' => $_POST["sub_category"],
            'cat_id' => $_POST["root_category"],
            'description' => $_POST["desc"]
    );

    $x = $database->update_data($table_name, $data, $where);
    if ($x == "1")
    {
        echo '<script>alert("Category update successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=category.php'>");
    }
}

if (isset($_POST["update1"]))
{
    $table_name = "sub_category";
    $where = "unique_id='" . $_GET['sub_uid'] . "'";
    $filename = $_FILES["file"]["name"];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed = array('jpg', 'jpeg', 'png');

    $upload_dir = "../product_images/";
    if (empty($filename))
    {
        $filename = "product_images/no_image.jpg";
    }
    else
    {
        if (!in_array($ext, $allowed))
        {
            echo '<script>alert("File Type Not Allowed")</script>';
            exit ("<meta http-equiv='refresh' content='0;url=category.php?p_uid=" . $_GET["p_uid"] . "'>");
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $filename);
        }
    }
    $new_file = "product_images/" . $filename;
    $data = array(
            'status' => $_POST["status"],
            'image' => $new_file
    );
    $x = $database->update_data($table_name, $data, $where);

    if ($x == "1")
    {
        echo '<script>alert("Data update Successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=category.php'>");
    }

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Category</title>
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
        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;"/>
        </div>


        <?php require("design/nav.php"); ?>

        <div class="center_content">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> EDIT CATEGORY</h2>
                </div>
            </div>

            <div class="row" style="padding-bottom: 20px;;">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">General</a></li>
                        <li><a href="#tabs-2">Data</a></li>
                    </ul>

                    <div id="tabs-1">
                        <form name="e_tabs_1_form" method="post" action="#">
                            <table id="rounded-corner" width="98%">
                                <tr>

                                <tr>
                                    <td>Root Category</td>
                                    <td><select name="root_category" class="form-inputbox">
                                            <?php

                                            $table = "category";
                                            $fields = "*";
                                            $where = "1=1";
                                            $order = "";
                                            $limit = "";
                                            $desc = "";
                                            $limitBegin = "0";
                                            $monitoring = false;
                                            $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                            foreach ($database_query as $row)
                                            {
                                                $c_id = $row["id"];
                                                $category_name = $row["name"];
                                                echo '<option value="' . $c_id . '">' . $category_name . '</option>';
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <?php
                                $sub_id = $_GET['sub_uid'];
                                $table = "sub_category";
                                $fields = "*";
                                $where = "unique_id='" . $sub_id . "'";
                                $order = "";
                                $limit = "";
                                $desc = "";
                                $limitBegin = "0";
                                $monitoring = false;
                                $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                foreach ($database_query as $row)
                                {
                                    $sub_cat = $row["name"];
                                    $sub_desc = $row["description"];
                                }
                                echo '<tr>';
                                echo '<td>Sub Category</td>';
                                echo '<td><input type="text" name="sub_category" value="' . $sub_cat . '" class="form-inputbox" ></td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td>Description</td>';
                                echo '<td><textarea type="text" name="desc" class="form-inputbox" style="width: 250px; height: 100px;" >' . $sub_desc . '</textarea></td>';
                                echo '</tr>';

                                ?>
                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="update" value="UPDATE"
                                               style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>

                    <div id="tabs-2">
                        <form name="e_tabs_2_form" method="post" action="#" enctype="multipart/form-data">
                            <table id="rounded-corner" width="98%">
                                <tr>
                                    <?php
                                    $sub_id = $_GET['sub_uid'];
                                    $table = "sub_category";
                                    $fields = "*";
                                    $where = "unique_id='" . $sub_id . "'";
                                    $order = "";
                                    $limit = "";
                                    $desc = "";
                                    $limitBegin = "0";
                                    $monitoring = false;
                                    $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                    foreach ($database_query as $row)
                                    {
                                        $status = $row["status"];
                                        if ($status == 0)
                                        {
                                            $s = "Enable";
                                        }
                                        else
                                        {
                                            $s = "Disabled";
                                        }
                                    }
                                    echo '<tr>';
                                    echo '<td>Previous Status';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $s;
                                    echo '</td>';
                                    echo '</tr>';
                                    ?>
                                    <td>Status</td>
                                    <td><select name="status" class="form-inputbox">
                                            <option value="0">Enabled</option>
                                            <option value="1">Disabled</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">Image &nbsp;<input type="file" name="file"/></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="update1" value="UPDATE"
                                               style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>
                </div>
            </div>


        </div>   <!--end of center content -->

        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>


</div>
</body>
</html>