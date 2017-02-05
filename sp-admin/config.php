<?php
/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 03-01-17
 * Time: 5:01 PM
 */

ob_start();
session_start();

define('SITE_URL', "localhost/samsad");
//set timezone
date_default_timezone_set('Asia/Kolkata');
//load classes as needed
function __autoload($class)
{
    $class = strtolower($class);
    $classpath = 'app/class/' . $class . '.php';
    if (file_exists($classpath))
    {
        require_once $classpath;
    }
}