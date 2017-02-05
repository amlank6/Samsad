<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("header.php");
    require_once("database/databaseConnectionPDO.php");
    ?>

    <title>Dashboard</title>
</head>

<body>

<div style="padding-top: 30px;" class="container">

    <?php
    $specialCustomerMaster = $_SESSION['specialCustomerMaster'];
    $type = $_SESSION['type'];
    $credit = $_SESSION['credit'];

    if ($type == "Canvasser")
    {
        $canvasser = $_SESSION["canvasser"];
    }
    else if ($type == "Bookseller")
    {
        $bookSeller = $_SESSION["bookSeller"];
    }
    else
    {
        $school = $_SESSION["school"];
    }
    ?>

    <h1>Welcome
        <?php

        if ($type == "Canvasser")
        {
            echo $canvasser->name;
        }
        else if ($type == "Bookseller")
        {
            echo $bookSeller->storeName;
        }
        else
        {
            echo $school->schoolName;
        }
        ?>
    </h1>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <?php
                $pageName = basename(__FILE__);
                require_once("sideBar.php");
                ?>
            </div>
            <div style="background-color: whitesmoke;height: 600px;padding: 10px;" class="main_container col-md-10">

                <h3>Booklist</h3>
                <table id="product" style="background-color: white" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $products = Product::find();
                    ?>
                    <?php
                    foreach ($products as $row)
                    {
                        ?>
                        <tr>
                            <td><?php echo $row->product_code ?></td>
                            <td><?php echo $row->p_name; ?></td>
                            <td><?php echo $row->p_author; ?></td>
                            <td><?php echo $row->p_price; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>


</div> <!-- /container -->
</body>
<script>
    $(document).ready(function ()
    {
        var table = $('#product').DataTable();
    });
</script>
</html>