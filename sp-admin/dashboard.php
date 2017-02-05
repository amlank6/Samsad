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
            <div style="background-color: whitesmoke;height: 500px" class="main_container col-md-10">

                <div class="col-md-8">
                    <h3><em>Recent Orders</em></h3>
                    <table style="background-color: white" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount To Be Paid</th>
                            <th>Est. DOD</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $specialCustomerMasterId = $specialCustomerMaster->id;
                        $specialCustomerMainOrders = SpecialCustomerMainOrder::findBySpecialCustomerMasterId($specialCustomerMasterId);

                        foreach ($specialCustomerMainOrders as $row)
                        {
                            ?>
                            <tr>

                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->amount_to_be_paid; ?></td>
                                <td><?php echo $row->estimated_date_of_delivery; ?></td>
                                <td>
                                    <?php
                                    if ($row->is_approved == 0)
                                    {
                                        ?>
                                        <span class="label label-warning">Pending</span>
                                        <?php
                                    }

                                    else
                                    {
                                        ?>
                                        <span class="label label-success">Approved</span>
                                        <?php
                                    }

                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>

                    </table>

                </div>
                <div class="col-md-4">
                    <h3>Info</h3>
                    <table style="background-color: white" class="table table-hover">

                        <tbody>
                        <?php
                        $specialCustomerMasterId = $specialCustomerMaster->id;
                        $specialCustomerMainOrders = SpecialCustomerMainOrder::findBySpecialCustomerMasterId($specialCustomerMasterId);


                        ?>
                        <tr>
                            <td><b>Credit Limit</b></td>
                            <td><?php echo $credit->creditLimit; ?> INR</td>
                        </tr>
                        <tr>
                            <td><b>Credit Period</b></td>
                            <td><?php echo $credit->creditPeriod; ?> Days</td>
                        </tr>
                        <tr>
                            <td><b>Discount Percentage</b></td>
                            <td><?php echo $credit->discountPercentage; ?> %</td>
                        </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>


</div> <!-- /container -->
</body>
</html>