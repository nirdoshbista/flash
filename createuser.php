<?php


$str = '';


if ($_POST['uname']!=''){
	
	if ($_POST['upass']!=''){
		$fptr=fopen("includes/users.php","w");
		
		
		fwrite($fptr,'<?php'."\n");
		
		fwrite($fptr, $str);
		
		fwrite($fptr,'$pageuser="'.$_POST['uname']."\";\n");
		fwrite($fptr,'$pagepass="'.$_POST['upass']."\";\n");
		fwrite($fptr,'$computerid="'.$_POST['cid']."\";\n");
	
		fclose($fptr);
		
		header("Location: index.php");
		
		
	}

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Create User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
.lb{
	color:  #505050;
	margin: 2px;
	text-decoration:none;
	background:#e0e0e0;
	padding:6px 12px 6px 12px;
	clear: none;
	float:left;
}

.lb:hover{
	background:#d0d0d0;
}
</style>
<script>
function checkpwd(){
	if (document.forms[0]['uname'].value==''){
		alert("Enter username.");
		document.forms[0]['uname'].focus();
		return false;
	}	
	
	if (document.forms[0]['upass'].value==''){
		alert("Enter password.");
		document.forms[0]['upass'].focus();
		return false;
	}	
	
	if (document.forms[0]['upass'].value!=document.forms[0]['upass1'].value){
		alert("Two passwords dont match.");
		document.forms[0]['upass'].value="";
		document.forms[0]['upass1'].value="";
		
		document.forms[0]['upass'].focus();
		return false;
	}
	
	if (document.forms[0]['cid'].value==''){
		alert("Computer identifier cant be empty.");
		document.forms[0]['cid'].focus();
		return false;
	}
	
	return true;
	
}

function fixcid(){
	var str = document.forms[0]['cid'].value;
	str=str.replace(/[^a-zA-Z0-9]/g,"");
	document.forms[0]['cid'].value = str;
}

</script>
</head>

<body onload="document.forms[0]['uname'].focus();">
<div style="position:absolute; top:10px; right:10px;"><a href="logout.php">Logout</a></div>
<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/flash.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>



<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return checkpwd();">

<center>

<h2>Create User</h2>
<p>&nbsp;</p>
<h3 style="color:blue;"><?php

require_once "includes/vars.php";

if (isset($pageuser)){
	echo 'Please enter your username and password below.';
}
else echo 'You are using this program for the first time. So, please create a user before you can continue..';

?>

</h3>
<p>&nbsp;</p>


Username: <input type="text" name="uname" value="<?php echo $pageuser; ?>" />
<br> <br>
Password: <input type="password" name="upass" />
<br><br>
Re-enter Password: <input type="password" name="upass1" />
<br><br>
Computer Identifier: <input type="text" name="cid" onchange="fixcid();" /> (eg, Main, Computer2, etc)

<br /> <br />

<input type="submit" value="Submit">

</center>

</form>

</body>
</html>
