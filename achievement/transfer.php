<?php 

@require_once("includes/bootstrap.php");

if (isset($_POST['transfer'])){
	$transfer_from = $_POST['transfer_from'];
	$transfer_to = $_POST['transfer_to'];
	$class = $_POST['transfer_class'];
	
	// check if $from and $to are valid school codes
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$transfer_from' AND sch_year='$currentyear'",$flashdblink);
	if (mysql_num_rows($result)==0) $error="Invalid School Code $transfer_from";
	else{
	
		$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$transfer_to' AND sch_year='$currentyear'",$flashdblink);
		if (mysql_num_rows($result)==0) $error="Invalid School Code $transfer_to";
		else{
			// now check if transfer_to school already has kids
			
			$result = mysql_query("SELECT * FROM student_main WHERE sch_num='$transfer_to' AND sch_year='$currentyear'",$dblink);
			if (mysql_num_rows($result)>0) $error="Target school already has students";
		
		}
	}
	
	if ($error == ''){
		// transfer students
		
		mysql_query("UPDATE student_main set stu_num=concat('$transfer_to',substring(stu_num,10)), sch_num='$transfer_to' WHERE sch_num='$transfer_from' AND sch_year='$currentyear' AND class='$class'");
		mysql_query("UPDATE student_marks set stu_num=concat('$transfer_to',substring(stu_num,10)) WHERE stu_num like '$transfer_from%' AND sch_year='$currentyear' AND class='$class'");
		
		$n = mysql_affected_rows();
		
		$message = "$n students transferred";
	
	}
	
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Achievement Students Transfer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<script>

function validate(){
	if (document.getElementById('transfer_from').value.length!=9){
		alert("School Code invalid");
		document.getElementById('transfer_from').focus();
		return false;
	}
	if (document.getElementById('transfer_to').value.length!=9){
		alert("School Code invalid");
		document.getElementById('transfer_to').focus();
		return false;
	}

}

</script>
<body>


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/dle.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

if ($error!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid red; width: 200px;'>$error</div>";
if ($message!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid green; width: 200px;'>$message</div>";


?>

<form action="" method="POST" onsubmit="return validate();">
<p align="center"><strong>Transfer Students from</strong></p>
<p align="center">
School Code 
<input type="text" name="transfer_from" id="transfer_from" size="10" />
to
<input type="text" name="transfer_to" id="transfer_to" size="10" />
of class 
<select name="transfer_class">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option selected>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select>
<input type="submit" name="transfer" value="Transfer" />
</p>
</form>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>

</body>

</html>
