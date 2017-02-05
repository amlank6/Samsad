<?php
/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 03-01-17
 * Time: 3:34 PM
 */

if (isset($_SESSION['specialCustomerMaster']))
{
    $specialCustomerMaster = $_SESSION['specialCustomerMaster'];
    $username = $specialCustomerMaster->username;

    $query = $GLOBALS['conn']->prepare("SELECT username FROM special_customers_master WHERE username = '$username' ");
    $query->execute(array('username' => $username));

    if ($query->rowCount() < 0)
    {
        header("location: index.php");
    }
}
else
{
    header("location: index.php");
}