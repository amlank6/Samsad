<div class="right_header">Welcome Admin | <?php echo date('d-F-Y ', time()); ?> | <a href="logout.php">Logout<img
                src="images/user_logout.png" alt="" title="" border="0" draggable="false" onmousedown="return false;"/></a>
</div>
</div>

<div class="main_content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ADMIN PANEL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "dashboard")  echo "active" ; else echo ""; ?>">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "user-details")  echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">User Management <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="user-details.php">User Details</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "category" || basename($_SERVER["SCRIPT_FILENAME"], '.php') == "product")  echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Catalog <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="category.php">Category</a></li>
                            <li><a href="product.php">Product</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "mail-newsletters")  echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">CRM <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="mail-newsletters.php">Newsletters</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "static-blocks")  echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">CMS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="static-blocks.php">Static Blocks</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "payments" || basename($_SERVER["SCRIPT_FILENAME"], '.php') == "email-logs")  echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Logs <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Payments</a></li>
                            <li><a href="email-logs.php">E-Mails</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == "settings" || basename($_SERVER["SCRIPT_FILENAME"], '.php') == "create-subadmin" || basename($_SERVER["SCRIPT_FILENAME"], '.php') == "cache-managment" || basename($_SERVER["SCRIPT_FILENAME"], '.php') == "change-password")   echo "active" ; else echo ""; ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">System <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="settings.php">Settings</a></li>
                            <li><a href="create-subadmin.php">Create Sub Admin</a></li>
                            <li><a href="cache-managment.php">Cache Management</a></li>
                            <li><a href="change-password.php">Change Password</a></li>
                        </ul>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

