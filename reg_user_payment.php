<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$rand = new Random_Variables();
$security = new Security_Framework();
$security->check_page_access();

if (isset($_POST["make_pay"]))
{
    if (!empty($_SESSION['cart']))
    {
        $cart = $_SESSION['cart'];
        $items = explode(',', $cart);
        $contents = array();
        foreach ($items as $item)
        {
            $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
        }

        $val = $_SESSION['cart'];
        $items = explode(',', $val);

        $val1 = $_SESSION['product_amount'];
        $amount = explode(',', $val1);

        $i = 1;

        $table = "customer_details";
        $query = mysql_query("SELECT * FROM customer_details WHERE  user_name='" . $_SESSION["registered_user"] . "' AND user_password='" . $_SESSION["user_token"] . "'");

        while ($row = mysql_fetch_array($query))
        {
            $cx_no = $row["unique_id"];
        }
        $transaction_id = $rand->unique_alpha(3) . time();

        foreach ($contents as $itemd => $qty)
        {
            $product_id = $itemd;
            $product_qty = $qty;
            $amt = $amount[$i++];
            $table2 = "logs_transaction";
            $data = array(
                'id' => "",
                'product_transaction_id' => $transaction_id,
                'product_transaction_date' => time(),
                'product_name' => $product_id,
                'product_amount' => $amt,
                'product_quantity' => $product_qty,
                'product_transaction_status' => 'Un-shipped',
                'cx_id' => $cx_no
            );
            $x = $database->insert_data($table2, $data);
        }

        $table3 = "logs_transaction_amount";
        $data3 = array(
            'id' => "",
            'date' => time(),
            'transaction_id' => $transaction_id,
            'amount' => $_SESSION["total_amount"],
        );
        $x = $database->insert_data($table3, $data3);

        /*
        foreach($contents as $itemd => $qty)
        {
            foreach($amount as $amt)
            {
            $val1			=	$_SESSION['product_amount'];
            $amount 		= 	explode(',',$val1);
            echo "PID 	=	".$product_id	=	$itemd;
            echo "<br />";
            echo "pqty	=	".$product_qty	=	$qty;
            echo "<br />";
            echo $amt;
            echo "<br />";
            }
        }
        */


    }
    /*
        $count			=	count($amount);

        for($i=1;$i<$count;$i++)
            {
            $table			=	"customer_details";
            $table2			=	"logs_transaction";
            $query			=	mysql_query("SELECT * FROM customer_details WHERE  user_name='".$_SESSION["registered_user"]."' AND user_password='".$_SESSION["user_token"]."'");

            while($row	=	mysql_fetch_array($query))
            {
            $cx_no 			=	$row["unique_id"];
            }
            //echo ">>".$cx_no.">>".$amt.">>";
            $data	=	array(
            'id' 									=> 	"",
            'product_transaction_id' 				=> 	$rand->unique_alpha(3).time(),
            'product_transaction_date' 				=> 	time(),
            'product_name' 							=> 	$itemd,
            'product_amount' 						=> 	$amount[$i],
            'product_quantity'						=>	$qty,
            'product_transaction_status' 			=> 	'Un-shipped',
            'cx_id'									=>	$cx_no
            );
            $x = $database->insert_data($table2, $data);
            }
            }


        echo "<br />";
        }
        */


    
    echo '<script> alert("Transaction Successfull");</script>';
    exit ("<meta http-equiv='refresh' content='0;url=index.php'>");

    //}

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Samsad - Payment</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script language="javascript" type="text/javascript" src="app/js/payment-step1.js"></script>

    <?php include("script1.php"); ?>
</head>

<body>
<script>
    "'article aside footer header nav section time'".replace(/\w+/g, function (n)
    {
        document.createElement(n)
    })
</script>

<div id="outer_wrap">

    <div class="head-wrap">
        <div class="main-content">
            <header>
                <?php include("design/header.php"); ?>
            </header>
        </div>
    </div>

    <div class="inner-wrap">
        <div class="main-content">

            <div class="nav-area">
                <div class="navigationarea">
                    <nav>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <div class="nav-sep1"></div>
                            <li><a href="about-us.php">About Us</a></li>
                            <div class="nav-sep1"></div>
                            <?php
                            require("category-menu.php");
                            ?>
                            <div class="nav-sep1"></div>
                            <li><a href="acheivements.php">Achievments</a></li>
                            <div class="nav-sep1"></div>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="nav-rightarea">
                    <?php include("design/nav-searchbox.php"); ?>
                </div>
            </div>

            <div class="wrap1">

                <div class="left-wrap">

                    <section class="left-upwrap">

                        <?php
                        require("design/left-checkout.php");
                        ?>

                        <article class="leftbox1">
                            <h1>Sub Categories</h1>

                            <div class="online-link">
                                <?php
                                require("design/left-category.php");
                                ?>
                            </div>
                        </article>


                        <!--<article class="leftbox">
                        <div class="left-cartbox">
                        <h3>compare products</h3>
                        <p class="com">You have no products to compare</p>

                        </div>
                        </article>-->
                    </section>

                    <section class="leftbottom-wrap">

                        <article class="leftbox1">
                            <div class="online-link">

                                <div class="link1">
                                    <div class="link1-pic"><img src="images/shop-online.png"/></div>
                                    <p><a href="#">How to buy offline ? </a></p>
                                </div>

                                <div class="link1">
                                    <div class="link1-pic"><img src="images/e-book-purchase.png"/></div>
                                    <p><a href="#">Purchase e-books</a></p>
                                </div>

                                <div class="link1">
                                    <div class="link1-pic"><img src="images/brochure-icon.png"/></div>
                                    <p><a href="#">Download Brochures</a></p>
                                </div>

                            </div>
                        </article>


                    </section>
                </div>


                <div class="right-wrap">
                    <div class="inner-bookslist-one">
                        <div class="page-link">
                            <p>&nbsp;</p>
                        </div>
                        <form name="payment_form" method="post" action="#">
                            <h1>Welcome <?php echo $_SESSION["registered_user"]; ?> to payment procedure</h1>

                            <input type="submit" name="make_pay" value="Make Payment"
                                   style="margin-top:50px; margin-left:220px"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-wrap">
            <?php include("design/footer.php"); ?>
        </div>
    </div>
</body>
</html>
