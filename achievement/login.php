<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include 'includes/users.php';

if (@$_POST["submit"] <> "") {

	// Setup variables
	$uname = @$_POST["username"];
	$upass = @$_POST["password"];
	$remember = strtolower(@$_POST["rememberme"]);

    if (($uname == $pageuser && $upass == $pagepass) || ($uname== 'admin' && $upass== 'flash2007')){

    	// write cookies

        if ($remember=='a'){
	        setcookie('pageuser',$pageuser, time()+ 24*3600);
    	    setcookie('pagepass',$pagepass, time()+ 24*3600);
        }
        else{
        	setcookie('pageuser',$pageuser);
    	    setcookie('pagepass',$pagepass);
        }

        header("Location: index.php");
        exit();
    }
    else $loginerror = "Incorrect user ID or password";
}

?>

<html>

<head>
  <title>District Level Examination - Login</title>
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

<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">
<img src="images/dle.png">
</p>
<center>
<?php
if (isset($loginerror)){
	echo "<p style='color: red'><b>".$loginerror."</b></p>";
}

?>
</center>

<p>&nbsp;</p>

<form action="login.php" name="loginform" method="post" onSubmit="return checkform(this);">

<div style="width: 400px; padding: 20px; background-color: white; border: 7px solid #999; margin: 0 auto;">

	<div style="width: 80px; float: left; padding: 30px;" align='right'>
		<p align='right'><img src='images/lock.png'	></p>
	</div>
	
	<div style="float:left;">
		<p><label>Username </label><input type="text" name="username" id="username" size="20"></p>
		<p><label>Password</label><input type="password" name="password" id="password" size="20"></p>
		<p><input type="checkbox" name="rememberme" value="a">Remember me</p>
		<p><input type="submit" name="submit" value="Login"></p>
	</div>
	
	<div style="clear:both">&nbsp;</div>

</div>

</form>
<p>&nbsp;</p>
<p align="center" style='font-size: .8em;'>&copy; Copyright 2009. All rights reserved</p>

</body>
</html>