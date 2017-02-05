<?php

require("../app/framework/system.php");
require("../app/database/connection.php");
require("../app/framework/captcha.php");
require("../app/framework/cache.php");
require("../app/framework/date_time.php");
require("../app/framework/mail_framework.php");
require("../app/framework/rand.php");
require("../app/framework/rss.php");
require("../app/framework/security.php");
require("../app/framework/string.php");
require("../app/framework/upload_framework.php");

$database = new Database_Framework;
$database->connect_database();
$database->select_database();

$id = $_GET['id'];
$sql = "UPDATE logs_transaction_amount SET is_approved = 1 WHERE transaction_id = '$id'";


return $data = mysql_query($sql) ? "true" : "false";


?>