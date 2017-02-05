<?php
require("app/pages/head.php");
$database = new Database_Framework;
$database->connect_database();
$database->select_database();
$security = new Security_Framework();
$security->check_page_access();

$table = "settings_email";
$fields = "*";
$where = "1=1";
$order = "";
$limit = "";
$desc = "";
$limitBegin = "0";
$monitoring = false;
$database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

foreach ($database_query as $row)
{
    $to = $row["email_id"];
}

if (isset($_POST["send_mail_selected"]))
{
    $mail_counter = 0;
    $i = $_POST["to"];
    switch ($i)
    {
        case 0:
            $send_to = "All Newsletter Subscribers";
            $table = "customer_details";
            $fields = "*";
            $where = "news_letter_suds = '0'";
            $order = "id";
            $limit = "";
            $desc = "";
            $limitBegin = "0";
            $monitoring = false;
            $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
            foreach ($database_query as $row)
            {
                $senders_id = $row["email_id"];
                $message_content =
                        '
	<html>
	<head></head>
	<body>
	<br/>
	<strong>Hello Users,</strong><br />
	<hr />
	<table>

	<tr>
	<td>Message :- &nbsp;</td>
	<td>' . $_POST["Message"] . '</td>

	</table>
	<hr />
	</body>
	</html>
	';
                $subject = $_POST["Subject"];
                $headers = array();
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-type: text/html; charset=iso-8859-1";
                $headers[] = "From: '" . $to . "'";
                $headers[] = "Cc: ";
                $headers[] = "Reply-To: '" . $to . "'";
                $headers[] = "X-Mailer: PHP/" . phpversion();
                $headers[] = $_POST["Message"];
                mail($senders_id, $subject, '', implode("\r\n", $headers));
                $mail_counter++;
            }
            $table_name = "logs_email";
            $data = array(
                    'send_total' => $mail_counter++,
                    'send_time' => time(),
                    'send_to' => $send_to
            );
            $database->insert_data($table_name, $data);

            echo '<script>alert("Mail has been sent to all Newsletter Subscribers");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=mail-newsletters.php'>");
            break;
        case 1:
            $send_to = "All Customers";
            $table = "customer_details";
            $fields = "*";
            $where = "news_letter_suds = '1'";
            $order = "id";
            $limit = "";
            $desc = "";
            $limitBegin = "0";
            $monitoring = false;
            $database_query = $database->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);
            foreach ($database_query as $row)
            {
                $senders_id = $row["email_id"];
                $message_content =
                        '
	<html>
	<head></head>
	<body>
	<br/>
	<strong>Hello Users,</strong><br />
	<hr />
	<table>

	<tr>
	<td>Message :- &nbsp;</td>
	<td>' . $_POST["Message"] . '</td>

	</table>
	<hr />
	</body>
	</html>
	';
                $subject = $_POST["Subject"];
                $headers = array();
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-type: text/html; charset=iso-8859-1";
                $headers[] = "From: '" . $to . "'";
                $headers[] = "Cc: ";
                $headers[] = "Reply-To: '" . $to . "'";
                $headers[] = "X-Mailer: PHP/" . phpversion();
                $headers[] = $_POST["Message"];
                mail($senders_id, $subject, '', implode("\r\n", $headers));
                $mail_counter++;
            }

            $table_name = "logs_email";
            $data = array(
                    'send_total' => $mail_counter++,
                    'send_time' => time(),
                    'send_to' => $send_to
            );
            $database->insert_data($table_name, $data);
            echo '<script>alert("Mail has been sent to all All Customers");</script>';
            exit ("<meta http-equiv='refresh' content='0;url=mail-newsletters.php'>");
            break;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Mail Newsletters</title>
    <?php
    require_once('design/header_script.php');
    ?>

    <script type="text/JavaScript">
        <!--
        function MM_findObj(n, d)
        { //v4.01
            var p, i, x;
            if (!d) d = document;
            if ((p = n.indexOf("?")) > 0 && parent.frames.length)
            {
                d = parent.frames[n.substring(p + 1)].document;
                n = n.substring(0, p);
            }
            if (!(x = d[n]) && d.all) x = d.all[n];
            for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
            for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
            if (!x && d.getElementById) x = d.getElementById(n);
            return x;
        }

        function MM_validateForm()
        { //v4.0
            var i, p, q, nm, test, num, min, max, errors = '', args = MM_validateForm.arguments;
            for (i = 0; i < (args.length - 2); i += 3)
            {
                test = args[i + 2];
                val = MM_findObj(args[i]);
                if (val)
                {
                    nm = val.name;
                    if ((val = val.value) != "")
                    {
                        if (test.indexOf('isEmail') != -1)
                        {
                            p = val.indexOf('@');
                            if (p < 1 || p == (val.length - 1)) errors += '- ' + nm + ' must contain an e-mail address.\n';
                        } else if (test != 'R')
                        {
                            num = parseFloat(val);
                            if (isNaN(val)) errors += '- ' + nm + ' must contain a number.\n';
                            if (test.indexOf('inRange') != -1)
                            {
                                p = test.indexOf(':');
                                min = test.substring(8, p);
                                max = test.substring(p + 1);
                                if (num < min || max < num) errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
                            }
                        }
                    } else if (test.charAt(0) == 'R') errors += '- ' + nm + ' is required.\n';
                }
            }
            if (errors) alert('The following error(s) occurred:\n' + errors);
            document.MM_returnValue = (errors == '');
        }
        //-->
    </script>
</head>
<body>
<div id="main_container">

    <div class="header">
        <div class="logo">
            <img src="images/logo.gif" alt="" title="" border="0" draggable="false" onmousedown="return false;"/>
        </div>


        <?php require("design/nav.php"); ?>

        <div class="center_content" style="height:500px;">

            <div class="row">
                <div class="page-header">
                    <h2><i class="fa fa-envelope" aria-hidden="true"></i> SEND MAIL</h2>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-offset-2 col-md-8">
                    <form action="#" method="POST" name="send_news_mail"
                          onsubmit="MM_validateForm('Subject','','R','Message','','R');return document.MM_returnValue">


                        <div class="form-group">
                            <label for="to">To </label>
                            <select name="to" class="form-control">
                                <option value="0">All Newsletter Subscribers</option>
                                <option value="1">All Customers</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Subject">Subject: </label>
                            <input type="text" class="form-control" name="Subject" value=""/>
                        </div>

                        <div class="form-group">
                            <label for="Message">Message: </label>
                        <textarea type="text" name="Message" value="" class="form-control"
                                  style="height: 100px;"></textarea>
                        </div>

                        <button class="pull-right btn btn-info" name="send_mail_selected"> Send</button>

                    </form>
                </div>
            </div>
        </div>   <!--end of center content -->


        <div class="clear"></div>
    </div> <!--end of main content-->

    <?php require("design/footer.php"); ?>


</div>
</body>
</html>