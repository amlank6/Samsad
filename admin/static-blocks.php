<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();


if (isset($_POST["best_seller_delete"]))
{
    if (isset($_POST["check"]))
    {
        foreach ($_POST["check"] as $value)
        {
            $table_name = "static_best_sellers";
            $where = "p_code='" . $value . "'";
            $x = $database->delete_data($table_name, $where);
        }
        if ($x = '1')
        {
            echo '<script>alert("Selected Book has been deleted")</script>';
            exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please select book to delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
}

if (isset($_POST["new_released_delete"]))
{
    if (isset($_POST["check1"]))
    {
        foreach ($_POST["check1"] as $value)
        {
            $table_name = "static_new_released";
            $where = "p_code='" . $value . "'";
            $x = $database->delete_data($table_name, $where);
        }
        if ($x = '1')
        {
            echo '<script>alert("Selected Book has been deleted")</script>';
            exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please Select Book to Delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
}

if (isset($_POST["book_of_the_month_delete"]))
{
    if (isset($_POST["check2"]))
    {
        foreach ($_POST["check2"] as $value)
        {
            $table_name = "static_book_month";
            $where = "p_code='" . $value . "'";
            $x = $database->delete_data($table_name, $where);
        }
        if ($x = '1')
        {
            echo '<script>alert("Selected Book has been deleted")</script>';
            exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
        }
    }
    else
    {
        echo '<script>alert("Please Select Book to Delete")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
}

if (isset($_POST["best_seller_add"]))
{
    $table = "static_best_sellers";
    $fields = "*";
    $where = "1=1";
    $data = array(
            'p_code' => $_POST["book_name"]
    );
    $column_check = $database->count_rows($table, $where);
    /*
    if($column_check >= 4)
    {
    echo '<script>alert("You already have 4 best sellers to put new books please delete old books");</script>';
    exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
    else
    {
    */
    $x = $database->insert_data($table, $data);
    if ($x = '1')
    {
        echo '<script>alert("Best Seller Book Added Successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
    //}
}

if (isset($_POST["new_released_add"]))
{
    $table = "static_new_released";
    $fields = "*";
    $where = "1=1";
    $data = array(
            'p_code' => $_POST["book_name"]
    );
    $column_check = $database->count_rows($table, $where);

    /*if($column_check >= 4)
    {
    echo '<script>alert("You already have 4 new released to put new books please delete old books");</script>';
    exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
    else
    {*/
    $x = $database->insert_data($table, $data);
    if ($x = '1')
    {
        echo '<script>alert("New Released Book Added Successfully");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
    //}
}

if (isset($_POST["book_of_the_month_add"]))
{
    $table = "static_book_month";
    $fields = "*";
    $where = "1=1";
    $data = array(
            'p_code' => $_POST["book_name"]
    );
    $column_check = $database->count_rows($table, $where);

    if ($column_check >= 1)
    {
        echo '<script>alert("You already have 1 Book of the month to put new book please delete old one");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
    }
    else
    {
        $x = $database->insert_data($table, $data);
        if ($x = '1')
        {
            echo '<script>alert("Book of the Month Added");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=static-blocks.php'>");
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Static Blocks</title>

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
                    <h2><i class="fa fa-envelope" aria-hidden="true"></i> STATIC BLOCKS</h2>
                </div>
            </div>

            <div class="row">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Best Seller</a></li>
                        <li><a href="#tabs-2">New Release</a></li>
                        <li><a href="#tabs-3">Book of the month</a></li>
                    </ul>

                    <div id="tabs-1">
                        <br>

                        <form style="text-align: center;" class="form-inline" name="p_tabs_1_form" method="post"
                              action="#">


                            <div class="form-group">
                                <label for="book_name">Book Name: </label>
                                <select name="book_name" id="book_name" class="form-control">
                                    <?php

                                    $first_level_cats = mysql_query("SELECT * FROM product ORDER BY p_name ASC");
                                    while ($row = mysql_fetch_array($first_level_cats))
                                    {
                                        $product_code = $row['product_code'];
                                        $p_name = $row['p_name'];
                                        echo '<option value="' . $product_code . '">' . $p_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-success" name="best_seller_add">Add Book</button>

                            <br/>
                            <table class="table table-striped" width="98%">
                                <br/>
                                <thead>
                                <tr align="center">
                                    <th scope="col" class="rounded-company">&nbsp;</th>
                                    <th scope="col" class="rounded">&nbsp;</th>
                                    <th scope="col" class="rounded">Book name</th>
                                    <th scope="col" class="rounded">Author Name</th>
                                    <th scope="col" class="rounded-q4">Book Price</th>


                                </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody>
                                <?php
                                $table = "static_best_sellers";
                                $fields = "*";
                                $where = "1=1";
                                $order = "id";
                                $limit = "";
                                $desc = "0";
                                $limitBegin = "0";
                                $monitoring = false;
                                $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                if (empty($database_query))
                                {
                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                }
                                else
                                {
                                    foreach ($database_query as $row)
                                    {
                                        $p_code = $row["p_code"];
                                        $p_id = $row["id"];
                                        $p_name = "";
                                        $p_author = "";
                                        $p_price = "";

                                        $query = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");
                                        while ($r = mysql_fetch_array($query))
                                        {
                                            $p_name = $r["p_name"];
                                            $p_author = $r["p_author"];
                                            $p_price = $r["p_price"];
                                            $p_uid = $r["unique_id"];

                                            echo '<tr align="center">';
                                            echo '<td><input type="checkbox" name="check[]" value="' . $p_code . '"/></td>';
                                            echo '<td>&nbsp;</td>';
                                            echo '<td>' . $p_name . '</td>';
                                            echo '<td>' . $p_author . '</td>';
                                            echo '<td>' . $p_price . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    echo '<tr>';
                                    echo '<td colspan="5">&nbsp;';
                                    echo '</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td colspan="6" align="right">';
                                    echo '<input type="submit" name="best_seller_delete" value="Delete Item" class="btn btn-danger" >';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                ?>

                                </tbody>
                            </table>

                            </table>
                        </form>
                    </div>

                    <div id="tabs-2">
                        <br>

                        <form style="text-align: center;" class="form-inline" name="p_tabs_2_form" method="post"
                              action="#">


                            <div class="form-group">
                                <label for="book_name">Book Name: </label>
                                <select name="book_name" id="book_name" class="form-control">
                                    <?php

                                    $first_level_cats = mysql_query("SELECT * FROM product ORDER BY p_name ASC");
                                    while ($row = mysql_fetch_array($first_level_cats))
                                    {
                                        $product_code = $row['product_code'];
                                        $p_name = $row['p_name'];
                                        echo '<option value="' . $product_code . '">' . $p_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-success" name="new_released_add">Add Book</button>

                            <br/>
                            <table class="table table-striped" width="98%">
                                <br/>
                                <thead>
                                <tr align="center">
                                    <th scope="col" class="rounded-company">&nbsp;</th>
                                    <th scope="col" class="rounded">&nbsp;</th>
                                    <th scope="col" class="rounded">Book name</th>
                                    <th scope="col" class="rounded">Author Name</th>
                                    <th scope="col" class="rounded-q4">Book Price</th>


                                </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody>
                                <?php
                                $table = "static_new_released";
                                $fields = "*";
                                $where = "1=1";
                                $order = "id";
                                $limit = "";
                                $desc = "0";
                                $limitBegin = "0";
                                $monitoring = false;
                                $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                if (empty($database_query))
                                {
                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                }
                                else
                                {
                                    foreach ($database_query as $row)
                                    {
                                        $p_code = $row["p_code"];
                                        $p_id = $row["id"];
                                        $p_name = "";
                                        $p_author = "";
                                        $p_price = "";

                                        $query = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");
                                        while ($r = mysql_fetch_array($query))
                                        {
                                            $p_name = $r["p_name"];
                                            $p_author = $r["p_author"];
                                            $p_price = $r["p_price"];
                                            $p_uid = $r["unique_id"];

                                            echo '<tr align="center">';
                                            echo '<td><input type="checkbox" name="check1[]" value="' . $p_code . '"/></td>';
                                            echo '<td>&nbsp;</td>';
                                            echo '<td>' . $p_name . '</td>';
                                            echo '<td>' . $p_author . '</td>';
                                            echo '<td>' . $p_price . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    echo '<tr>';
                                    echo '<td colspan="5">&nbsp;';
                                    echo '</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td colspan="6" align="right">';
                                    echo '<input type="submit" name="new_released_delete" value="Delete Item" class="btn btn-danger">';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                ?>

                                </tbody>
                            </table>

                            </table>
                        </form>
                    </div>

                    <div id="tabs-3">
                        <br>

                        <form style="text-align: center;" class="form-inline" name="p_tabs_3_form" method="post"
                              action="#">


                            <div class="form-group">
                                <label for="book_name">Book Name: </label>
                                <select name="book_name" id="book_name" class="form-control">
                                    <?php

                                    $first_level_cats = mysql_query("SELECT * FROM product ORDER BY p_name ASC");
                                    while ($row = mysql_fetch_array($first_level_cats))
                                    {
                                        $product_code = $row['product_code'];
                                        $p_name = $row['p_name'];
                                        echo '<option value="' . $product_code . '">' . $p_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-success" name="book_of_the_month_add">Add Book</button>

                            <br/>
                            <table class="table table-striped" width="98%">
                                <br/>
                                <thead>
                                <tr align="center">
                                    <th scope="col" class="rounded-company">&nbsp;</th>
                                    <th scope="col" class="rounded">&nbsp;</th>
                                    <th scope="col" class="rounded">Book name</th>
                                    <th scope="col" class="rounded">Author Name</th>
                                    <th scope="col" class="rounded-q4">Book Price</th>


                                </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody>
                                <?php
                                $table = "static_book_month";
                                $fields = "*";
                                $where = "1=1";
                                $order = "id";
                                $limit = "";
                                $desc = "0";
                                $limitBegin = "0";
                                $monitoring = false;
                                $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                if (empty($database_query))
                                {
                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                    echo '<tr align="center hight="10px">';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '<td>&nbsp;</td>';
                                    echo '</tr>';

                                }
                                else
                                {
                                    foreach ($database_query as $row)
                                    {
                                        $p_code = $row["p_code"];
                                        $p_id = $row["id"];
                                        $p_name = "";
                                        $p_author = "";
                                        $p_price = "";

                                        $query = mysql_query("SELECT * FROM product WHERE product_code='$p_code'");
                                        while ($r = mysql_fetch_array($query))
                                        {
                                            $p_name = $r["p_name"];
                                            $p_author = $r["p_author"];
                                            $p_price = $r["p_price"];
                                            $p_uid = $r["unique_id"];

                                            echo '<tr align="center">';
                                            echo '<td><input type="checkbox" name="check2[]" value="' . $p_code . '"/></td>';
                                            echo '<td>&nbsp;</td>';
                                            echo '<td>' . $p_name . '</td>';
                                            echo '<td>' . $p_author . '</td>';
                                            echo '<td>' . $p_price . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    echo '<tr>';
                                    echo '<td colspan="5">&nbsp;';
                                    echo '</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td colspan="6" align="right">';
                                    echo '<input type="submit" name="book_of_the_month_delete" value="Delete Item" class="btn btn-danger">';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                ?>

                                </tbody>
                            </table>

                            </table>
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