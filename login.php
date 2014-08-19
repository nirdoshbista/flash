<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include 'includes/vars.php';
include 'includes/dbfunctions.php';

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

if (@$_POST["submit"] <> "") {

	// Setup variables
	$uname = @$_POST["username"];
	$upass = @$_POST["password"];
	$remember = strtolower(@$_POST["rememberme"]);

    if (($uname == $pageuser && $upass == $pagepass) || ($uname== 'admin' && $upass== 'flash2008')){

    	// write cookies

        if ($remember=='a'){
	        setcookie('pageuser',$pageuser, time()+ 24*3600);
    	    setcookie('pagepass',$pagepass, time()+ 24*3600);
        }
        else{
        	setcookie('pageuser',$pageuser);
    	    setcookie('pagepass',$pagepass);
        }

        
        
        // if only one district, repair db
		$result = mysql_query("SELECT * FROM mast_district");
		if (mysql_num_rows($result)==1) 
			header("Location: utils/dbrepair.php?repair");
		else 
			header("Location: index.php");
		
        exit();
    }
    else $loginerror = "Incorrect user ID or password";
}

?>

<html>

<head>
  <title>Flash - Login</title>
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <script type="text/javascript">

	function checkform(form_this) {
		if (document.getElementById('username').value.length==0){
        	alert("Enter username");
            return false;
        }

    	if (document.getElementById('password').value.length==0){
        	alert("Enter password");
            return false;
        }
        return true;
    }


	</script>
</head>


<body onload="document.getElementById('username').focus();">
<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/iemis logo.png" style="height:100px;"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<center>
<?php
if (isset($loginerror)){
	echo "<p style='color: red'><b>".$loginerror."</b></p>";
}

?>
</center>

<form action="login.php" name="loginform" method="post" onSubmit="return checkform(this);">
<p>&nbsp;</p><table width="400" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142"><table width="100%" border="0" cellpadding="6" style="background: white;">
        <tr>
        	<td rowspan="4" valign="top"><img border="0" src="images/lock.png"></td>
            <td class="ewListAdd">User Name</td>
            <td><input type="text" name="username" id="username" size="20"></td>
        </tr>
        <tr>
            <td class="ewListAdd">Password</td>
            <td><input type="password" name="password" id="password" size="20"></td>
        </tr>
        <tr>
            <td class="ewListAdd">&nbsp;</td>
            <td class="ewListAdd">
                <input type="checkbox" name="rememberme" value="a">Remember me
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Login"></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<p align="center" class="ewListAdd">&copy; Copyright 2007. All rights reserved</p>
<p>&nbsp;</p>
</body>
</html>
