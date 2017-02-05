<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("header.php");
    require_once("database/databaseConnectionPDO.php");
    require_once("loginCheck.php");
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


    <?php
    if (isset($_POST['submit']))
    {
        $school = $_POST['school'];
        $estimatedDateOfDelivery = $_POST['estimatedDateOfDelivery'];
        $bookCount = $_POST['bookCount'];
        $bookList = array();
        $specialCustomerType = $type;

        for ($k = 1; $k <= $bookCount; $k = $k + 1)
        {
            if (isset($_POST['checkbox_' . $k]))
            {
                $productCode = $_POST['checkbox_' . $k];
                $productAmount = $_POST['product_amount_' . $k];
                $quantity = $_POST['quantity_' . $k];

                $book = array("productCode" => $productCode,"productAmount" => $productAmount, "quantity" => $quantity);
                array_push($bookList, $book);
            }
        }

        SpecialCustomerMainOrder::placeOrder($school, $estimatedDateOfDelivery, $bookList, $specialCustomerType);
        print_r($bookList);
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
            <div style="background-color: whitesmoke;height: 770px" class="main_container col-md-10">
                <form method="post">
                    <div class="col-md-12">

                        <div class="row">
                            <h3>Requisition Form</h3>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="school">For School</label>
                                        <input type="text" class="input-sm form-control" id="school" name="school"
                                               placeholder="School's Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estimatedDateOfDelivery">Estimated Date Of Delivery</label>
                                        <input type="date" name="estimatedDateOfDelivery" id="estimatedDateOfDelivery"
                                               class="input-sm form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h3>Booklist</h3>
                            <table id="product" style="background-color: white"
                                   class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $products = Product::find();
                                ?>
                                <?php
                                $i = 0;
                                foreach ($products as $row)
                                {
                                    $i = $i + 1;
                                    ?>
                                    <tr>
                                        <td><input name="checkbox_<?php echo $i; ?>" type="checkbox"
                                                   value="<?php echo $row->product_code; ?>"></td>
                                        <td><?php echo $row->p_name; ?></td>
                                        <td><?php echo $row->p_author; ?></td>
                                        <td><?php echo $row->p_price; ?></td>
                                        <input name="product_amount_<?php echo $i; ?>" type="hidden"
                                               value="<?php echo $row->p_price; ?>">
                                        <td><input name="quantity_<?php echo $i; ?>" type="number"></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>


                    </div>
                    <input type="hidden" name="bookCount" value="<?php echo $i; ?>">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </form>
            </div>
        </div>

    </div>


</div> <!-- /container -->
<script>
    $(document).ready(function ()
    {
        var table = $('#product').DataTable();
    });
</script>
</body>
</html>