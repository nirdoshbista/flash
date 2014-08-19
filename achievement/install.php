<html>
<head>
<title>Achievement Installation</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<pre>
Installing Achievement Database ... 
<?php

require_once('includes/vars.php');

$mysql_path = "..\\..\\..\\mysql\\bin\\mysql.exe";
$sqlpath = "achievementblank.sql";

$mysql_command =sprintf("$mysql_path -v -h%s -u%s -p%s  < %s",
        $dbserver, $dbusername, $dbpassword, $sqlpath);
        
echo shell_exec($mysql_command);
echo "Done";
echo "<script>window.location='index.php';</script>";
?>
</pre>
</body>
</html>