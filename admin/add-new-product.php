<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$rand = new Random_Variables();
$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["general"]))
{
    if (!empty($_POST["Name"]) and !empty($_POST["Author"]) and !empty($_POST["Price"]) and !empty($_POST["Inventory"]) and !empty($_POST["Sub-Category"]))
    {
        if (empty($_POST["p_code"]))
        {
            $p_code = $rand->unique_alpha(8);
        }
        else
        {
            $p_code = addslashes($_POST["p_code"]);
        }

        $filename = $_FILES["file"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = array('jpg', 'jpeg', 'png');

        $upload_dir = "../product_images/";

        if (empty($filename))
        {
            $file1 = "product_images/no_image.jpg";
        }
        else
        {

            if (!in_array($ext, $allowed))
            {
                echo '<script>alert("File Type Not Allowed")</script>';
                exit ("<meta http-equiv='refresh' content='0;url=add-new-product.php'>");
            }

            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $filename);
                $file1 = "product_images/" . $filename;
            }

        }

        $table_name = "product";
        $data = array(
                'id' => "",
                'unique_id' => $rand->rand_number(10),
                'product_code' => $p_code,
                'p_image_link' => addslashes($file1),
                'p_name' => addslashes($_POST["Name"]),
                'p_author' => addslashes($_POST["Author"]),
                'p_format' => $_POST["format"],
                'p_size' => $_POST["Size"],
                'p_weight'=> $_POST["Weight"],
                'p_pages' => addslashes($_POST["Pages"]),
                'p_price' => addslashes($_POST["Price"]),
                'p_inventory' => addslashes($_POST["Inventory"]),
                'p_status' => "0",
                'p_description' => addslashes($_POST["Description"]),
                'p_root_category' => $_POST["Root-Category"],
                'p_sub_category' => $_POST["Sub-Category"],
        );

        $x = $database->insert_data($table_name, $data);
        if ($x == "1")
        {
            echo '<script>alert("Product uploaded successfully");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=product.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please enter \nName \nAuthor \nPrice \nInventory \nSub Category ");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=add-new-product.php'>");
    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add New Product</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>
    <link rel="stylesheet" href="jquery/jquery-ui.css"/>
    <script src="jquery/jquery-1.9.1.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css"/>
    <script>
        <!--
        $(function ()
        {
            $("#tabs").tabs();
        });

        //-->
    </script>
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo"><img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                               onmousedown="return false;"/></div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:400px; overflow:auto">

            <br/>

            <h2>Add New Product</h2>

            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">General</a></li>
                </ul>

                <div id="tabs-1">
                    <form name="p_tabs_1_form" method="post" action="#" enctype="multipart/form-data">
                        <table id="rounded-corner" width="98%">

                            <tr>
                                <td>Product Code</td>
                                <td><input type="text" name="p_code" id="p_code" value="" class="form-inputbox"/></td>
                            </tr>

                            <tr>
                                <td>Product Name *</td>
                                <td><input type="text" name="Name" id="Name" value="" class="form-inputbox"/></td>
                            </tr>

                            <tr>
                                <td>Author *</td>
                                <td><input type="text" name="Author" id="Author" value="" class="form-inputbox"/></td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td><textarea type="text" name="Description" id="Description" cols="18"
                                              class="form-inputbox"
                                              style="width: 200px; height: 100px;">Description</textarea></td>
                            </tr>

                            <tr>
                                <td>Binding</td>
                                <td>
                                    <select name="format" id="format" class="form-inputbox">
                                        <option value="">- Select -</option>
                                        <option value="Paperback">Paperback</option>
                                        <option value="Hardback with jacket">Hardback with jacket</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Size</td>
                                <td><select name="Size" id="Size" class="form-inputbox">
                                        <option value="">- Select -</option>
                                        <option value="15 x 22 cm">15 x 22 cm</option>
                                        <option value="15 x 22 cm">16 x 21 cm</option>
                                        <option value="23 x 18 cm">23 x 18 cm</option>
                                        <option value="24 x 18 cm">24 x 18 cm</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Weight (Enter in Grams)</td>
                                <td><input type="text" name="Weight" id="Weight" class="form-inputbox" maxlength="10"/>
                                </td>
                            </tr>

                            <tr>
                                <td>No of Pages</td>
                                <td><input type="text" name="Pages" id="Pages" class="form-inputbox" maxlength="4"/>
                                </td>
                            </tr>

                            <tr>
                                <td>Amount *</td>
                                <td><input type="text" name="Price" id="Price" class="form-inputbox" maxlength="4"/>
                                </td>
                            </tr>

                            <tr>
                                <td>Inventory *</td>
                                <td><input type="text" name="Inventory" id="Inventory" class="form-inputbox"
                                           maxlength="4"/></td>
                            </tr>

                            <tr>
                                <td>Root Category</td>
                                <td><select name="Root-Category" id="Root-Category" class="form-inputbox">
                                        <?php
                                        $database1 = new Database_Framework();
                                        $con = $database1->connect_database();
                                        $database1->select_database();
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
                                        echo '<tr>';
                                        echo '<td>Sub Category *</td>';
                                        echo '<td><select name="Sub-Category" id="Sub-Category" class="form-inputbox">';
                                        echo '<option value="">- Select -</option>';

                                        $second_level_cats = mysql_query("SELECT * FROM sub_category where cat_id='$category_id' ");
                                        while ($row = mysql_fetch_array($second_level_cats))
                                        {
                                            $sub_category_id = $row['unique_id'];
                                            $sub_category_name = $row['name'];
                                            echo '<option value="' . $sub_category_id . '">' . $sub_category_name . '</option>';
                                        }

                                        echo '</select>';
                                        echo '</td>';
                                        echo '</tr>';
                                        ?>
                            <tr>
                                <td>Image &nbsp;</td>
                                <td><input type="file" name="file" id="file"/></td>
                            </tr>

                            <tr>
                                <td colspan="2" align="right">
                                    <input type="submit" name="general" value="Add Product"
                                           style="background: url(images/bt_blue_center.gif) repeat-x; background-position:center; cursor:pointer; border:none;color:#FFFFFF; text-shadow:1px 1px #3597bf; margin-top:11px; padding:0 15px; height:31px;border-radius:6px;">
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>

            </div>

        </div>   <!--end of center content -->

        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>


</div>
</body>
</html>