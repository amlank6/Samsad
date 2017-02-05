<?php
/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 27-12-16
 * Time: 3:26 PM
 */

global $conn;
$servername = "localhost";
$username = "root";
$password = "";
$GLOBALS['conn'];
try
{
    $GLOBALS['conn'] = new PDO("mysql:host=$servername;dbname=samsad_n", $username, $password);
    // set the PDO error mode to exception
    $GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $GLOBALS['connOld'] = new PDO("mysql:host=$servername;dbname=samsad", $username, $password);
    // set the PDO error mode to exception
    $GLOBALS['connOld']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //echo "Connected successfully";
} catch (PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>
