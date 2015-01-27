<?php
$dbserver = 'localhost';
$dbusername = 'root';
$dbpassword = 'admin';
$dbname = 'flash';
$achievementdb='achievement';

@include("includes/users.php");
@include("includes/currentyear.php");

// in case the page is running in secondary folder
@include("../includes/currentyear.php");
@include("../includes/users.php");
