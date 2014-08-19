<?php

if ($_POST['y']!=''){

	$y=$_POST['y'];
	
	$fptr=fopen("includes/currentyear.php","w");

	fwrite($fptr,'<?php'."\n");
	fwrite($fptr,'$currentyear="'.$_POST['y']."\";\n");
		
	fwrite($fptr, 'if (strstr($_SERVER["PHP_SELF"],"flash2/")!==false) $currentyear = '.($y-1).";\n");
	fwrite($fptr, 'if (strstr($_SERVER["PHP_SELF"],"flash1/")!==false) $currentyear = '.($y).";\n");
        fwrite($fptr, 'if (strstr($_SERVER["PHP_SELF"],"tmis/")!==false) $currentyear = '.($y-1).";\n");

	fclose($fptr);
		
	header("Location: index.php");
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Set year</title>
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

<h2>Set year</h2>
<p>&nbsp;</p>
<h3 style="color:blue;"><?php

require_once "includes/vars.php";

echo 'Please set the year for this Flash Installation';

?>

</h3>
<p>&nbsp;</p>

year: 
<select name='y'>
<?php

$y = date("Y");
$m = date("n");
$d = date("j");

$nepy = $y + 57;

if (($m*30+$d)<105) $nepy--;

for ($i=2062;$i<=($nepy+10);$i++){
	echo "<option value='$i' ".($nepy==$i?"selected":"").">".($i-1)."/$i</option>\n";
}

?>
</select>

<br /> <br />

<input type="submit" value="Set">

</center>

</form>

</body>
</html>
