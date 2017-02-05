<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$rand = new Random_Variables();
$security = new  Security_Framework();

if (isset($_POST["create"]))
{
    $table = "customer_details";
    $where = "email_id='" . $_POST["email_id"] . "'";
    $count1 = $database->count_rows($table, $where);
    $rand = new Random_Variables();

    if ($count1 > 0)
    {
        echo '<script>alert("Email ID already exists, Please check your email id");</script>';
        exit ("<meta http-equiv='refresh' content='0;url=user-registration.php'>");
    }

    $rand = new Random_Variables();
    $table_name = "customer_details";

    if (isset($_POST["check"]))
    {
        $address = $_POST["address"];
    }
    else
    {
        $address = $_POST["address1"];
    }
    $name = str_replace(" ", "", $_POST["name"]);
    $user_name = substr($name, 0, 7);

    $password = "garden";
    //$password = $user_name . $rand->rand_number(5);

    $data = array(
            'id' => "",
            'unique_id' => $rand->unique_alpha(10),
            'name' => addslashes($_POST["name"]),
            'email_id' => addslashes($_POST["email_id"]),
            'contact_no' => addslashes($_POST["contact_no"]),
            'address' => addslashes($_POST["address"]),
            'city' => addslashes($_POST["city"]),
            'postal_code' => addslashes($_POST["postal_code"]),
            'country' => addslashes($_POST["country"]),
            'state' => addslashes($_POST["state"]),
            'shipping_address' => addslashes($address),
            'registered_on' => addslashes(time()),
            'news_letter_suds' => addslashes($_POST["news_letter_suds"]),
            'user_name' => addslashes($user_name),
            'user_password' => addslashes($security->encrypt($password))
    );


    $x = $database->insert_data($table_name, $data);

    $to = $_POST["email_id"];

    $message_content =
            '
	<html>
	<head></head>
	<body>
	<br/>
	<strong>Login Details</strong><br />
	<hr />
	<table>

	<tr>
	<td>User Name :- &nbsp;</td>
	<td>' . $user_name . '</td>

	</tr>

	<tr>
	<td>Password :- &nbsp;</td>
	<td>' . $password . '</td>
	</tr>

	</table>
	<hr />
	</body>
	</html>
	';
    $subject = "Samsad Account Details";
    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: " . $_POST["email_id"];
    $headers[] = "Cc: ";
    $headers[] = "Reply-To: " . $_POST["email_id"];
    $headers[] = "X-Mailer: PHP/" . phpversion();
    $headers[] = $message_content;
    mail($to, $subject, '', implode("\r\n", $headers));
    echo '<script>alert("Samsad Account details has been forwarded to your email id \nPlease check your email id ");</script>';
    exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
}

if (isset($_POST["news_letter"]))
{
    $rand = new Random_Variables();
    $table_name = "customer_details";
    $fields = "*";
    $where = "1=1";
    $order = "id";
    $limit = "";
    $desc = "";
    $limitBegin = "0";
    $monitoring = false;
    $database_query = $database->fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
    foreach ($database_query as $row)
    {
        $email = $row["email_id"];
        if ($email == $_POST["Email"])
        {
            $data = array(
                    'news_letter_suds' => "1"
            );
            $where = "email_id='" . $_POST["Email"] . "'";
            $x = $database->update_data($table_name, $data, $where);

            if ($x == "1")
            {
                echo '<script>alert("Thank you for subscribing newsletter");</script>';
                exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
            }
        }
        else
        {
            $data = array(
                    'id' => "",
                    'unique_id' => $rand->unique_alpha(10),
                    'name' => addslashes($_POST["Name"]),
                    'email_id' => addslashes($_POST["Email"]),
                    'contact_no' => "",
                    'address' => "",
                    'city' => "",
                    'postal_code' => "",
                    'country' => "",
                    'state' => "",
                    'registered_on' => addslashes(time()),
                    'news_letter_suds' => "1"
            );

            $x = $database->insert_data($table_name, $data);
            if ($x == "1")
            {
                echo '<script>alert("Thank you for subscribing newsletter");</script>';
                exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
            }
        }
    }
}

if (isset($_POST["search_by_cat"]))
{
    if ($_SESSION["sub_cat"] == 'category')
    {
        echo '<script>alert("Please select category to search")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
    }

    if ($_POST["books"] != "" AND $_POST["author"] != "")
    {
        exit ("<meta http-equiv='refresh' content='0;url=search-list-book.php?p_name=" . urlencode($_POST["books"]) . "&author=" . urlencode($_POST["author"]) . "'>");
    }

    else
    {
        if ($_POST["books"] != "")
        {
            exit ("<meta http-equiv='refresh' content='0;url=search-book.php?p_name=" . urlencode($_POST["books"]) . "'>");
        }

        if ($_POST["author"] != "")
        {
            exit ("<meta http-equiv='refresh' content='0;url=search-author.php?p_author=" . urlencode($_POST["author"]) . "'>");
        }

        if (isset($_SESSION["sub_cat"]) AND $_POST["books"] == "" AND $_POST["author"] == "" AND $_SESSION["sub_cat"] != 'category')
        {
            exit ("<meta http-equiv='refresh' content='0;url=product-listing.php?s_id=" . $_SESSION["sub_cat"] . "'>");
        }
    }
    if (!isset($_SESSION["sub_cat"]) AND $_POST["books"] == "" AND $_POST["author"] == "" AND $_SESSION["sub_cat"] == 'category')
    {
        echo '<script>alert("Please select category to search")</script>';
        exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Samsad - Account Settings</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script language="javascript" type="text/javascript" src="app/js/payment-step1.js"></script>

    <?php include("script1.php"); ?>

    <!----------------------------------colorbox ------------------------------------>

    <link type="text/css" media="screen" rel="stylesheet" href="css/colorbox.css"/>
    <script type="text/javascript" src="js/download-colorbox.js"></script>
    <script type="text/javascript" src="js/jquery.colorbox.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            //Examples of how to assign the ColorBox event to elements
            $("a[rel='example1']").colorbox();

            $("a[rel='example2']").colorbox({transition: "fade"});
            $("a[rel='example3']").colorbox({transition: "none", width: "740", height: "600"});
            $("a[rel='example4']").colorbox({slideshow: true});
            $(".example5").colorbox();
            $(".example6").colorbox({iframe: true, innerWidth: 425, innerHeight: 344});
            $(".example7").colorbox({width: "66%", height: "79%", iframe: true});
            $(".example8").colorbox({width: "80%", height: "80%", iframe: true,});
            $(".example9").colorbox({
                onOpen: function ()
                {
                    alert('onOpen: colorbox is about to open');
                },
                onLoad: function ()
                {
                    alert('onLoad: colorbox has started to load the targeted content');
                },
                onComplete: function ()
                {
                    alert('onComplete: colorbox has displayed the loaded content');
                },
                onCleanup: function ()
                {
                    alert('onCleanup: colorbox has begun the close process');
                },
                onClosed: function ()
                {
                    alert('onClosed: colorbox has completely closed');
                }
            });

            //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function ()
            {
                $('#click').css({
                    "background-color": "#000",
                    "color": "#fff",
                    "cursor": "inherit"
                }).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>

    <!----------------------------------colorbox ------------------------------------>
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
                            <h1>Categories</h1>

                            <div class="online-link">
                                <?php
                                require("design/left-category.php");
                                ?>
                            </div>
                        </article>

                        <div class="leftbox">
                            <h1>Browse Books</h1>
                        </div>

                        <div class="left-innerbox"
                             style="background:#eee; border:1px solid #ccc; margin-left:8px; padding:10px 2px 20px 0px; margin-top:-10px; margin-bottom:8px;">

                            <?php
                            if (isset($_POST["category"]))
                            {
                                $_SESSION["sub_cat"] = $_POST["category"];
                            }
                            else
                            {
                                $_SESSION["sub_cat"] = "category";
                            }
                            ?>
                            <div class="bro-cat">Category:</div>
                            <form name="category_form" method="post">
                                <select name="category" onchange="this.form.submit()" class="bro-bk">
                                    <option value="category">Category</option>
                                    <?php
                                    $query = mysql_query("SELECT * FROM sub_category ");

                                    if (empty($query))
                                    {
                                        echo '<option value="">&nbsp;</option>';
                                    }
                                    else
                                    {
                                        while ($r = mysql_fetch_array($query))
                                        {
                                            $sub_category = mb_convert_case($r['name'], MB_CASE_TITLE, "UTF-8");
                                            $s_id = $r['unique_id'];

                                            if (isset($_SESSION["sub_cat"]))
                                            {
                                                if ($s_id == $_SESSION["sub_cat"])
                                                {
                                                    echo '<option value="' . $s_id . '" selected="selected" >' . $sub_category . '</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="' . $s_id . '">' . $sub_category . '</option>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<option value="' . $s_id . '">' . $sub_category . '</option>';
                                            }

                                        }
                                    }

                                    ?>
                                </select>

                            </form>

                            <?php
                            /*if(isset($_POST["author"]))
                            {
                            $_SESSION["author_name"]		=		$_POST["author"];
                            //echo ">>>".$_SESSION["author_name"];
                            }*/
                            ?>


                            <form name="search_by_category" method="post" action="#">
                                <div class="bro-cat">Books:</div>
                                <select name="books" id="books" class="bro-bk">
                                    <option value="">Books</option>
                                    <?php
                                    if (isset($_POST["category"]))
                                    {
                                        $table = "product";
                                        $fields = "*";
                                        $where = "p_sub_category ='" . $_POST["category"] . "'";
                                        $order = "";
                                        $limit = "";
                                        $desc = "";
                                        $limitBegin = "0";
                                        $monitoring = false;
                                        $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
                                        foreach ($database_query as $r)
                                        {
                                            $name = $r['p_name'];
                                            echo '<option value="' . $name . '">' . $name . '</option>';
                                        }
                                    }

                                    ?>
                                </select>

                                <div class="bro-cat">Author:</div>
                                <select name="author" id="author" class="bro-bk">
                                    <option value="">Author</option>
                                    <?php
                                    if (isset($_POST["category"]))
                                    {
                                        $query = mysql_query("SELECT * FROM product where p_sub_category='" . $_POST["category"] . "'");

                                        while ($r = mysql_fetch_array($query))
                                        {
                                            echo '<option value="' . $r["p_author"] . '">' . $r["p_author"] . '</option>';
                                        }
                                    }

                                    ?>

                                </select>

                                <input type="submit" name="search_by_cat" value="Search" style=" background-image:url(images/footer-button.png);font-size:14px; margin-right:3px;color:#FFF; border:none; cursor:pointer;width:82px;
height:35px;float:right;"/>
                            </form>
                        </div>


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

                    <?php require("design/news-letter.php"); ?>
                </div>


                <div class="right-wrap">
                    <div class="inner-bookslist-one" id="user-reg">
                        <div class="page-link">
                            <p>Home > Registration </p>
                        </div>
                        <h1>Welcome to User Registration</h1>

                        <p class="head">Please fill form to register </p>

                        <div class="sign-box">
                            <div class="sign-head"><h4>Your Personal Details</h4></div>
                            <div class="sign-middle">
                                <form name="account_setting" method="post" action="#"
                                      onsubmit="return validate_payment_step1()">

                                    <div class="form-pan">
                                        <div class="formbox1">
                                            <div class="namebox1">Full Name*</div>
                                            <input type="text" class="sign-name" name="name" id="name" maxlength="35"/>
                                        </div>

                                        <div class="formbox1">
                                            <div class="namebox1">Email Id*</div>
                                            <input type="text" class="sign-name" name="email_id" id="email_id"
                                                   maxlength="35"/>
                                        </div>

                                        <div class="formbox1">
                                            <div class="namebox1">Contact No*</div>
                                            <input type="text" class="sign-name" name="contact_no" id="contact_no"
                                                   value="" maxlength="12"/>
                                        </div>
                                    </div>

                                    <div class="user"><img src="images/personal-details.png"></div>
                            </div>


                            <div class="sign-footer">&nbsp;</div>
                        </div>

                        <div class="sign-box">
                            <div class="sign-head"><h4>Your Full Address </h4></div>
                            <div class="sign-middle">


                                <div class="formbox2">
                                    <div class="namebox1">Address*</div>
                                    <textarea name="address" id="address" class="sign-area"></textarea>
                                </div>

                                <div class="form-pan">
                                    <div class="formbox1">
                                        <div class="namebox1">City*</div>
                                        <input type="text" class="sign-name" name="city" id="city" maxlength="15"/>
                                    </div>

                                    <div class="formbox1">
                                        <div class="namebox1">Postal Code*</div>
                                        <input type="text" class="sign-name" name="postal_code" id="postal_code"
                                               maxlength="6"/>
                                    </div>

                                    <div class="formbox1">
                                        <div class="namebox1">Country*</div>
                                        <input type="text" class="sign-name" name="country" id="country"
                                               maxlength="15"/>
                                    </div>

                                    <div class="formbox1">
                                        <div class="namebox1">State*</div>
                                        <input type="text" class="sign-name" name="state" id="state" maxlength="15"/>
                                    </div>
                                </div>

                                <div class="user"><img src="images/adress-pic.png"/></div>
                            </div>
                            <div class="sign-footer">&nbsp;</div>
                        </div>


                        <div class="sign-box">
                            <div class="sign-head"><h4>Shipping Address</h4></div>
                            <div class="sign-middle">
                                <input name="check1" id="check" type="checkbox" value=""
                                       style="margin-left:15px;"/><span style="color:#000;"> Check if shipping address is same as above.</span><br/><br/>

                                <div class="formbox2">
                                    <div class="namebox1">Address*</div>
                                    <textarea name="address1" id="address1" class="sign-area"></textarea>
                                </div>
                            </div>


                            <div class="sign-footer">&nbsp;</div>
                        </div>

                        <div class="sign-box">
                            <div class="sign-head-1"><h4>Newsletter Subscription</h4></div>
                            <div class="sign-middle">
                                <div class="sign-rdo">Subscribe</div>
                                <div class="sign-rdo-1"><input name="news_letter_suds" type="radio" value="0" checked/>

                                    <p>Yes</p></div>
                                <div class="sign-rdo-1"><input name="news_letter_suds" type="radio" value="1"/>

                                    <p>No</p></div>
                            </div>
                            <div class="sign-footer">&nbsp;</div>
                        </div>

                        <p class="privacy">I have read & agree to the <a href="terms-condition.php" class="example8">Terms
                                & Conditions</a><br/><br/></p>
                        <!--<a href="#"><div class="sunny">Create new account</div></a>-->

                        <input type="submit" name="create" value="Create new account" class="sunny"/>
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
