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
            <div style="background-color: whitesmoke;height: 500px"class="main_container col-md-10">

                <div class="col-md-12">
                    <br>
                    <div class="pull-right">
                        <button onclick="location.href = 'createOrder.php'" class="btn btn-success">Place Order</button>
                    </div>
                    <h3>Orders</h3>
                    <table style="background-color: white" class="table table-hover">
                        <thead>
                        <tr>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Transaction Id</th>
                            <th rowspan="2">School</th>
                            <th rowspan="2">Est. Delivery Dt.</th>
                            <th colspan="3" style="text-align: center;">Amt. Break</th>
                            <th rowspan="2">Amt. To Be Paid</th>
                            <th rowspan="2">Status</th>

                        </tr>
                        <tr>

                            <th>Prdt. Amt.</th>
                            <th>Dlry Chrg.</th>
                            <th>Dis. Amt.</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $specialCustomerMasterId = $specialCustomerMaster->id;
                        $specialCustomerMainOrders = SpecialCustomerMainOrder::findBySpecialCustomerMasterId($specialCustomerMasterId);
                        $count = 0;
                        ?>
                        <?php
                        foreach ($specialCustomerMainOrders as $row)
                        {
                            $count = $count + 1;
                            ?>
                            <tr>

                                <td><?php echo $row->date; ?></td>
                                <td><a href="sub_order.php?specialCustomerMainOrderId=<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModal<?php echo $count;?>"><?php echo $row->id; ?></a></td>
                                <td><?php echo $row->school; ?></td>
                                <td><?php echo $row->estimated_date_of_delivery; ?></td>
                                <td style="text-align: right"><?php echo $row->total_amount; ?></td>
                                <td style="text-align: right"><?php echo $row->delivery_charge; ?></td>
                                <td style="text-align: right"><?php echo $row->discount_amount; ?></td>
                                <td style="text-align: right"><?php echo $row->amount_to_be_paid; ?></td>
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
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $count;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <div class="row">



            <!-- Modal -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>


</div> <!-- /container -->
</body>
</html>