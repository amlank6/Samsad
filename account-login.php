<?php
require("app/pages/head.php");
$database = new    Database_Framework();
$database->connect_database();
$database->select_database();
$security = new  Security_Framework();
$messege = "";

if (isset($_POST["login"]))
{
    $table_name = "customer_details";
    $user_name = addslashes($_POST['user_name']);
    $user_password = addslashes($security->encrypt($_POST['user_password']));
    $fields1 = "user_name='$user_name' AND user_password='$user_password'";
    $login_check = $database->count_rows($table_name, $fields1);


    if ($login_check == 1)
    {

        $_SESSION["registered_user"] = $user_name;
        $_SESSION["user_token"] = $user_password;
        if (isset($_SESSION["cart"]))
        {
            exit ("<meta http-equiv='refresh' content='0;url=reg_user_payment.php'>");
        } else
        {
            exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
        }
    } else
    {
        session_destroy();
        $messege = "Invalid Username or password.";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Samsad - LOGIN</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>

<body>
<div id="outer_wrap">

    <div class="head-wrap">
        <div class="main-content">
            <header>
                <? include("design/header.php") ?>
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
                    <? include("design/nav-searchbox.php") ?>
                </div>
            </div>


            <div class="wrap1">
                <div class="innerpage-content">

                    <!--<div class="page-link">
                    <p>Home > Registration </p>
                    </div>-->
                    <h1>Login</h1>

                    <div class="account-left">
                        <h3>New Customer</h3>

                        <p>By creating an account you will be able to shop faster, be up to date on an
                            order's status, and keep track of the orders you have previously made.</p>
                        <a href="user-registration.php" class="btn">Create Account</a>
                    </div>


                    <div class="sign-boxlog1">
                        <div class="sign-boxloghead2">Login to your account</div>
                        <form name="account_setting" method="post" action="#"
                              onsubmit="return validate_payment_step1()">

                            <input type="text" class="sign-name2" name="user_name" value="Username"
                                   onfocus="if(this.value==this.defaultValue)this.value='';"
                                   onblur="if(this.value=='')this.value=this.defaultValue;" tabindex="1"
                                   maxlength="25"/>

                            <input type="text" class="sign-name2" name="user_password" value="Password"
                                   onblur="this.value=!this.value?'Password':this.value;" onfocus="this.select()"
                                   onclick="if (this.value=='Password'){this.value=''; this.type='password'}"
                                   value="Password" size="20" tabindex="2" maxlength="25"/>

                            <div class="login-button3">
                                <input type="submit" name="login" class="btn" value="Login" tabindex="3"/>

                                <p><a href="forget-password.php">Forget your Password ?</a></p>
                            </div>

                            <div class="red-mbox" id="lig-box">
                                <h3><?php echo $messege; ?></h3>
                                <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </p>-->
                            </div>

                        </form>

                    </div>


                    <!--<div class="account-right">
                    <h3>Registered Customer</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                    <div class="sign-boxlog1">
                     <div class="sign-boxloghead2">Login to Your account</div>
                    <form name="account_setting" method="post" action="#" onsubmit="return validate_payment_step1()">

                    <input type="text" class="sign-name" name="user_name" value="Username" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" tabindex="1" />

                    <input type="text" class="sign-name" name="user_password" value="Password" onblur="this.value=!this.value?'Password':this.value;" onfocus="this.select()" onclick="if (this.value=='Password'){this.value=''; this.type='password'}" value="Password" size="20" tabindex="2"  />

                    <div class="login-button"><input type="submit" name="login" class="btn" value="Login" tabindex="3" /> <p><a href="forget-password.php" >Forget Your Password ?</a></p></div>

                    </form>

                    </div>

                    </div>-->


                </div>
            </div>
        </div>

        <div class="footer-wrap">
            <? include("design/footer.php") ?>
        </div>
    </div>
</body>
</html>
