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


                <br/>

                <?php
                if ($type == "Canvasser")
                {
                    ?>

                    <div class="col-md-12">
                        <h3>Profile</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Basic</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Customer</b></td>
                                        <td><?php echo $specialCustomerMaster->type; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td><?php echo $specialCustomerMaster->username; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Other Details</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Number Of Schools</b></td>
                                        <td><?php echo $canvasser->numberOfSchools; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Area Of Operation</b></td>
                                        <td><?php echo $canvasser->areaOfOperation; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contact Details</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td><?php echo $canvasser->name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Number</b></td>
                                        <td><?php echo $canvasser->contactNumber; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Id</b></td>
                                        <td><?php echo $canvasser->emailId; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Address</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>Street Address</b></td>
                                        <td><?php echo $canvasser->streetAddress; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>State</b></td>
                                        <td><?php echo $canvasser->state; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Postal Code</b></td>
                                        <td><?php echo $canvasser->postalCode; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                }

                else if ($type == "Bookseller")
                {
                    ?>

                    <div class="col-md-12">
                        <h3>Profile</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Basic</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Customer</b></td>
                                        <td><?php echo $specialCustomerMaster->type; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td><?php echo $specialCustomerMaster->username; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Other Details</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Registered Since</b></td>
                                        <td><?php echo $bookSeller->registeredSince; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Area Of Operation</b></td>
                                        <td><?php echo $bookSeller->areaOfOperation; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contact Details</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>Store Name</b></td>
                                        <td><?php echo $bookSeller->storeName; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Person Name</b></td>
                                        <td><?php echo $bookSeller->contactPersonName; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Number</b></td>
                                        <td><?php echo $bookSeller->contactNumber; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Id</b></td>
                                        <td><?php echo $bookSeller->emailId; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Address</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>Street Address</b></td>
                                        <td><?php echo $bookSeller->streetAddress; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>State</b></td>
                                        <td><?php echo $bookSeller->state; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Postal Code</b></td>
                                        <td><?php echo $bookSeller->postalCode; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php

                }

                else if ($type == "School")
                {
                    ?>

                    <div class="col-md-12">
                        <h3>Profile</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Basic</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Customer</b></td>
                                        <td><?php echo $specialCustomerMaster->type; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td><?php echo $specialCustomerMaster->username; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Other Details</h4>
                                <table style="background-color: white" class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td><b>Managing Committee</b></td>
                                        <td><?php echo $school->managingCommittee; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Medium</b></td>
                                        <td><?php echo $school->medium; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>No. Of Students</b></td>
                                        <td><?php echo $school->noOfStudents; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contact Details</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>School Name</b></td>
                                        <td><?php echo $school->schoolName; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Head Name</b></td>
                                        <td><?php echo $school->headName; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Number</b></td>
                                        <td><?php echo $school->contactNumber; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Id</b></td>
                                        <td><?php echo $school->emailId; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Address</h4>
                                <table style="background-color: white" class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><b>Street Address</b></td>
                                        <td><?php echo $school->streetAddress; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>State</b></td>
                                        <td><?php echo $school->state; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Postal Code</b></td>
                                        <td><?php echo $school->postalCode; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>


            </div>
        </div>
    </div>


</div> <!-- /container -->
</body>
</html>