<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("header.php");
    require_once("database/databaseConnectionPDO.php")
    ?>
    <!-- Custom styles for Sign In Page -->
    <link href="assets/css/signin.css" rel="stylesheet">
    <title>Log In | Special Customers</title>
</head>

<body>

<div style="padding-top: 60px;" class="container">

    <?php
    if(isset($_POST['submit']))
    {
        SpecialCustomerMaster::authenticate($_POST['username'],$_POST['password'],$_POST['type']);
    }
    ?>

    <form class="form-signin" action="" method="post">
        <img style="padding: 20px;" src="images/logo.png" alt="Samsad Logo">
        <label for="username">Email address: </label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

        <label for="type">Select Your Category:</label>
        <select id="type" name="type" class="form-control">
            <option>Canvasser</option>
            <option>School</option>
            <option>Bookseller</option>
        </select>


        <br/>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->
</body>
</html>
