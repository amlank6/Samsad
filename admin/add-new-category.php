<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();
$rand = new Random_Variables();
if (isset($_POST["add"]))
{
    if (!empty($_POST["sub_name"]))
    {
        $unique_id = $rand->rand_number(20);
        $table = "sub_category";
        $name = addslashes($_POST["sub_name"]);
        $cat_id = addslashes($_POST["cat_id"]);
        $desc = addslashes($_POST["desc"]);
        $data = array(
                'id' => "",
                'unique_id' => $unique_id,
                'name' => $name,
                'cat_id' => $cat_id,
                'description' => $desc,
                'image' => "product_images/no_image.jpg",
                'status' => "0"
        );
        $x = $database->insert_data($table, $data);
        if ($x == 1)
        {
            echo '<script>alert("Category Added Successfully");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=category.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please enter \n Sub Category ");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=add-new-category.php'>");
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add New Category</title>
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

        <div class="center_content" style="height:500px">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> ADD NEW CATEGORY</h2>
                </div>
            </div>

            <div class="row">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">General</a></li>
                    </ul>

                    <div id="tabs-1">
                        <form name="c_tabs_1_form" action="#" method="post">

                            <div class="form-group">
                                <label for="cat_id">Root Category: </label>
                                <select name="cat_id" class="form-control">
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

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_name">Sub Category: </label>
                                <input type="text" name="sub_name" class="form-control" value=""/>
                            </div>

                            <div class="form-group">
                                <label for="desc">Description: </label>
                                <textarea type="text" name="desc" cols="18" class="form-control"
                                          style="height: 100px;"></textarea>
                            </div>

                            <input type="submit" name="add" value="Add Category"
                                   class="btn btn-info"/>


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