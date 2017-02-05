<?php
/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 29-12-16
 * Time: 11:24 AM
 */

?>

<ul style="border-radius: 5px; background-color: whitesmoke;padding: 5px;" class="nav nav-pills nav-stacked">
    <li role="presentation" class="<?php if ($pageName == "dashboard.php") echo "active"; ?>"><a href="dashboard.php"><i
                    class="fa fa-tachometer" aria-hidden="true"></i>&nbsp&nbspDashboard</a>
    </li>
    <li role="presentation" class="<?php if ($pageName == "profile.php") echo "active"; ?>"><a href="profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp&nbspProfile</a>
    </li>
    <li role="presentation" class="<?php if ($pageName == "bookList.php") echo "active"; ?>"><a href="bookList.php"><i class="fa fa-book" aria-hidden="true"></i>&nbsp&nbspBook
            List</a></li>
    <li role="presentation" class="<?php if ($pageName == "orders.php") echo "active"; ?>"><a
                href="orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp&nbspOrders</a></li>
    <li role="presentation"  class="label-danger <?php if ($pageName == "logout.php") echo "active"; ?>"><a
                style="color:white;" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp&nbspLogout</a></li>
</ul>

