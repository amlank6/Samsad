<?php
require("app/pages/head.php");
$database = new Database_Framework();
$con = $database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();
if (isset($_POST["delete"]))
{
    if (isset($_POST["check"]))
    {
        foreach ($_POST["check"] as $value)
        {
            $table_name = "sub_category";
            $where = "unique_id='" . $value . "'";
            $database->delete_data($table_name, $where);
        }
        echo '<script>alert("Selected catagory has been deleted")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=category.php'>");
    }
    else
    {
        echo '<script>alert("Please select catagory to delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=category.php'>");
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
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false"
                 onmousedown="return false;"/>
        </div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:550px;">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-th-list" aria-hidden="true"></i></i> CATEGORY</h2>
                </div>
            </div>

            <div class="row">
                <form name="category_form" action="#" method="post">
                    <table class="table table-striped table-bordered" width="98%">
                        <thead>
                        <tr style="text-align: center;">
                            <th scope="col" class="rounded-company"></th>
                            <th scope="col" class="rounded">Category Name</th>
                            <th scope="col" class="rounded-q4">Action</th>
                        </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                        <?php
                        $first_level_cats = mysql_query("SELECT * FROM category ");
                        while ($row = mysql_fetch_array($first_level_cats))
                        {

                            $category_name1 = "";
                            $sub_category = "";
                            $sub = "";
                            $category_id = $row['id'];
                            $category_name = $row['name'];
                            $second_level_cats = mysql_query("SELECT * FROM sub_category WHERE cat_id = '$category_id' ");

                            if (empty($second_level_cats))
                            {
                                echo '<td>&nbsp;</td>';
                                echo '<td>&nbsp;';
                                echo '>';
                                echo '&nbsp;';
                                echo '</td>';
                                echo '<td>&nbsp;</td>';
                                echo '</tr>';
                            }
                            else
                            {
                                while ($r = mysql_fetch_array($second_level_cats))
                                {
                                    echo '<tr>';

                                    $category_name1 = $category_name;
                                    $sub_category = $r['name'];
                                    $s_id = $r['id'];
                                    $s_uid = $r['unique_id'];

                                    echo '<td><input type="checkbox" name="check[]" value="' . $s_uid . '"/></td>';
                                    echo '<td>' . $category_name1;
                                    echo '&nbsp<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp';
                                    echo $sub_category;
                                    echo '</td>';
                                    echo '<td style="text-align: center;"><a class="btn btn-sm btn-info" href="edit-category.php?sub_uid=' . $s_uid . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>';
                                    echo '</tr>';

                                }
                                echo '<tr>';
                                echo '<td colspan="4">&nbsp;</td>';
                                echo '</tr>';
                                echo '<tr align="right">';
                                echo '<td colspan="4">';
                                echo '<button name="delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>&nbsp';
                                echo '<a href="add-new-category.php" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add New Sub Category
		<span class="bt_blue_r"></span></a>';
                                echo '</td>';
                                echo '</tr>';
                            }

                        }


                        ?>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>

        <div class="clear"></div>
    </div>

    <?php require("design/footer.php"); ?>

</div>
</body>
</html>