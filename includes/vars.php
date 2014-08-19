<?php
$dbserver = 'localhost';
$dbusername = 'root';
$dbpassword = 'admin';
$dbname = 'flash';

@include("includes/users.php");
@include("../includes/users.php");


$currentyear="2069";
if (strstr($_SERVER["PHP_SELF"],"flash2/")!==false) $currentyear = 2068;
if (strstr($_SERVER["PHP_SELF"],"flash1/")!==false) $currentyear = 2069;
