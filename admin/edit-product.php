<?php

require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$rand = new Random_Variables();
$security = new Security_Framework();
$security->check_page_access();
$id = $_GET["p_uid"];
$table = "product";
$fields = "*";
$where = "unique_id='" . $_GET["p_uid"] . "'";
$order = "id";
$limit = "";
$desc = "";
$limitBegin = "0";
$monitoring = false;
$database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
foreach ($database_query as $row)
{
    $p_image_link = $row["p_image_link"];
    $p_uid = $row["unique_id"];
    $p_code = $row["product_code"];
    $p_name = $row["p_name"];
    $p_author = $row["p_author"];
    $p_price = $row["p_price"];
    $p_inventory = $row["p_inventory"];
    $p_status = $row["p_status"];
    $p_unique_id = $row["unique_id"];
    $p_description = $row["p_description"];
    $p_root_category = $row["p_root_category"];
    $p_sub_category = $row["p_sub_category"];
    $p_pages = $row["p_pages"];
    $p_size = $row["p_size"];
    $p_weight = $row["p_weight"];
    $p_binding = $row["p_format"];
}

if (isset($_POST["general"]))
{
    $table_name = "product";
    $where = "unique_id='" . $_GET["p_uid"] . "'";
    $data = array(
            'product_code' => addslashes($_POST["p_code"]),
            'p_name' => addslashes($_POST["p_name"]),
            'p_author' => addslashes($_POST["p_author"]),
            'p_description' => addslashes($_POST["p_description"]),
            'p_root_category' => $_POST["p_root_category"],
            'p_sub_category' => $_POST["p_sub_category"]
    );
    $x = $database->update_data($table_name, $data, $where);
    if ($x == "1")
    {
        echo '<script>alert("Updated successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=edit-product.php?p_uid=" . $_GET["p_uid"] . "&p_sub_cat=" . $_GET["p_sub_cat"] . "'>");
    }
}

if (isset($_POST["data1"]))
{
    $table_name = "product";
    $where = "unique_id='" . $_GET["p_uid"] . "'";
    $data = array(
            'p_size' => addslashes($_POST["p_size"]),
            'p_weight' => addslashes($_POST["p_weight"]),
            'p_pages' => addslashes($_POST["p_pages"]),
            'p_format' => $_POST["p_format"],
            'p_inventory' => addslashes($_POST["p_inventory"]),
            'p_price' => addslashes($_POST["p_price"]),
            'p_status' => $_POST["p_status"]
    );
    $x = $database->update_data($table_name, $data, $where);
    if ($x == "1")
    {
        echo '<script>alert("Update Successfull");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=edit-product.php?p_uid=" . $_GET["p_uid"] . "&p_sub_cat=" . $_GET["p_sub_cat"] . "'>");
    }
}

if (isset($_POST["image1"]))
{

    $filename = $_FILES["file"]["name"];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed = array('jpg', 'jpeg', 'png');

    $upload_dir = "../product_images/";
    if (empty($filename))
    {
        echo '<script>alert("Please select image");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=edit-product.php?p_uid=" . $_GET["p_uid"] . "&p_sub_cat=" . $_GET["p_sub_cat"] . "'>");
    }
    else
    {
        if (!in_array($ext, $allowed))
        {
            echo '<script>alert("File Type Not Allowed")</script>';
            exit ("<meta http-equiv='refresh' content='0;url=product.php?p_uid=" . $_GET["p_uid"] . "'>");
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $filename);
        }
    }
    $table_name = "product";
    $where = "unique_id='" . $_GET["p_uid"] . "'";
    $new_file = "product_images/" . $filename;
    $data = array(
            'p_image_link' => $new_file,
    );
    $x = $database->update_data($table_name, $data, $where);

    if ($x == "1")
    {
        echo '<script>alert("Image update Successfull");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=product.php?p_uid=" . $_GET["p_uid"] . "'>");
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Product</title>
    <?php
    require_once('design/header_script.php');
    ?>

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
                    <h2><i class="fa fa-archive" aria-hidden="true"></i> EDIT PRODUCT</h2>
                </div>
            </div>

            <div style="padding-bottom: 20px;" class="row">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">General</a></li>
                        <li><a href="#tabs-2">Data</a></li>
                        <li><a href="#tabs-3">Image</a></li>
                    </ul>

                    <div id="tabs-1">
                        <form name="p_tabs_1_form" method="post" action="#">
                            <table id="rounded-corner" width="98%">
                                <?php
                                echo '<tr>';
                                echo '<td>Product Code</td>';
                                echo '<td><input type="text" name="p_code" id="p_code" value="' . $p_code . '" class="form-inputbox" /></td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td>Product Name</td>';
                                echo '<td><input type="text" name="p_name" id="p_name" value="' . $p_name . '" class="form-inputbox" /></td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td>Author Name</td>';
                                echo '<td><input type="text" name="p_author" id="p_author" value="' . $p_author . '" class="form-inputbox" /></td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td>Description</td>';
                                echo '<td><textarea type="text" name="p_description" id="p_description" cols="18" class="form-inputbox" style="width: 250px; height: 100px;" >' . $p_description . '</textarea></td>';
                                echo '</tr>';

                                ?>

                                <tr>
                                    <td>Root Category</td>
                                    <td><select name="p_root_category" id="p_root_category" class="form-inputbox">
                                            <?php

                                            $first_level_cats = mysql_query("SELECT * FROM category ");
                                            while ($row = mysql_fetch_array($first_level_cats))
                                            {
                                                $category_id = $row['id'];
                                                $category_name = $row['name'];
                                                echo '<option value="' . $category_id . '">' . $category_name . '</option>';
                                            }
                                            echo '</select>';
                                            echo '</td>';
                                            echo '</tr>';
                                            echo '<td>Sub Category</td>';
                                            echo '<td><select name="p_sub_category" id="sub_catrgory" class="form-inputbox">';

                                            $second_level_cats = mysql_query("SELECT * FROM sub_category where cat_id='$category_id' ");

                                            while ($row = mysql_fetch_array($second_level_cats))
                                            {
                                                $sub_category_id = $row['unique_id'];
                                                $sub_category_name = $row['name'];
                                                echo '<option value="' . $sub_category_id . '">' . $sub_category_name . '</option>';
                                            }
                                            $sub_cats = mysql_query("SELECT * FROM sub_category where unique_id='" . $_GET["p_sub_cat"] . "'");

                                            while ($row = mysql_fetch_array($sub_cats))
                                            {
                                                $sub_category_name = $row['name'];
                                            }

                                            echo '</select>';
                                            echo '</td>';
                                            echo '</tr>';

                                            echo '<tr>';
                                            echo '<td>Previous Subcategory';
                                            echo '</td>';
                                            echo '<td>' . $sub_category_name;
                                            echo '</td>';
                                            echo '</td>';
                                            echo '</tr>';
                                            ?>

                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="general" value="Update"
                                               style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;">
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>

                    <div id="tabs-2">
                        <form name="p_tabs_2_form" method="post" action="#">
                            <table id="rounded-corner" width="98%">

                                <tr>
                                    <td>No of Pages</td>
                                    <td><input type="text" name="p_pages" id="p_pages" value="<?php echo $p_pages; ?>"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Size</td>
                                    <td>
                                        <select name="p_size" class="form-inputbox">
                                            <option value="" <?php if ($p_size == "")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>&nbsp;</option>
                                            <option value="24 x 18 cm" <?php if ($p_size == "24 x 18 cm")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>24 x 18 cm
                                            </option>
                                            <option value="23 x 18 cm" <?php if ($p_size == "23 x 18 cm")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>23 x 18 cm
                                            </option>
                                            <option value="15 x 22 cm" <?php if ($p_size == "15 x 22 cm")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>15 x 22 cm
                                            </option>
                                            <option value="16 x 21 cm" <?php if ($p_size == "16 x 21 cm")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>16 x 21 cm
                                            </option>
                                            <option value="18.5 x 24 cm" <?php if ($p_size == "18.5 x 24 cm")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>18.5 x 24 cm
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Weight (Grams)</td>
                                    <td><input type="text" name="p_weight" id="p_weight" value="<?php echo $p_weight; ?>"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Binding</td>
                                    <td><select name="p_format" class="form-inputbox">
                                            <option value="" <?php if ($p_binding == "")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>&nbsp;</option>
                                            <option value="paperback" <?php if ($p_binding == "paperback")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>Paperback
                                            </option>
                                            <option value="hardback_with_jacket" <?php if ($p_binding == "hardback_with_jacket")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>Hardback with jacket
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <?php
                                echo '<tr>';
                                echo '<td>Price</td>';
                                echo '<td><input type="text" name="p_price" id="p_price" value="' . $p_price . '" /></td>';
                                echo '</tr>';
                                ?>

                                <tr>
                                    <td>Inventory</td>
                                    <td><input type="text" name="p_inventory" id="p_inventory"
                                               value="<?php echo $p_inventory; ?>"/></td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td><select name="p_status" class="form-inputbox">
                                            <option value="0" <?php if ($p_status == "0")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>Enable
                                            </option>
                                            <option value="1" <?php if ($p_status == "1")
                                            {
                                                echo "selected=\"selected\"";
                                            } ?>>Disable
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="data1" value="UPDATE"
                                               style="background: url(images/bt_green_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #8fa42b; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;"/>

                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>

                    <div id="tabs-3">
                        <form name="p_tabs_3_form" method="post" action="#" enctype="multipart/form-data">
                            <table id="rounded-corner" width="98%">
                                <tr>
                                    <td>Image &nbsp;<input type="file" name="file"/></td>
                                    <td colspan="2" align="right">
                                        <input type="submit" name="image1" value="UPDATE"
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