<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('includes/flash1fn.php');

$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Teacher Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/openschool.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
    <br>
    <p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
        <b>Jump to: </b><span id="nav"><select onkeypress="return generalKeyPress(this, event);"><option>Select School & Classes</select></span>
    </p>
    <form action="controller.php" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable" style="margin-bottom: 12px;">
            <tr> 
                <td width="30%" class="ewTableHeader">Parent School Code</td>
                <td>                   
                   <input name="parent_sch_num_open" id="parent_sch_num_open" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="12" maxlength="9">
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
            <tr class="ewTableHeader"> 
                <td rowspan="3" width="30%">Open School Type</td>
                <td colspan="9">Students Detail</td>
            </tr>
            <tr class="ewTableHeader">
                <td colspan="3" align="center">Total</td>
                <td colspan="3" align="center">Dalit</td>
                <td colspan="3" align="center">Janjati</td>
            </tr>
            <tr class="ewTableHeader"> 
                <td align="center">F</td>
                <td align="center">M</td>
                <td align="center">T</td>
                <td align="center">F</td>
                <td align="center">M</td>
                <td align="center">T</td>
                <td align="center">F</td>
                <td align="center">M</td>
                <td align="center">T</td>
            </tr>
            <tr>
                <td>L.Sec Open School First Rank</td>
                <?php 
                    for($i=1;$i<4;$i++): 
                            foreach(array('f','m','t') as $sex): 
                                echo '<td><input type="text" name="lsec1_'.$i.'_'.$sex.'" id="lsec1_'.$i.'_'.$sex.'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                                if($sex=='t')
                                    echo 'disabled';
                                echo '/></td>';
                            endforeach; 
                    endfor; 
                ?>
            </tr>
            <tr>
                <td>L.Sec Open School Second Rank</td>
                <?php 
                    for($i=1;$i<4;$i++): 
                        foreach(array('f','m','t') as $sex): 
                            echo '<td><input type="text" name="lsec2_'.$i.'_'.$sex.'" id="lsec2_'.$i.'_'.$sex.'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                            if($sex=='t')
                                    echo 'disabled';
                            echo '/></td>';
                        endforeach; 
                    endfor; 
                ?>
            </tr>
            <tr>
                <td>Sec Open School</td>
                <?php 
                    for($i=1;$i<4;$i++): 
                        foreach(array('f','m','t') as $sex): 
                            echo '<td><input type="text" name="secon_'.$i.'_'.$sex.'" id="sec_'.$i.'_'.$sex.'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                            if($sex=='t')
                                    echo 'disabled';
                            echo '/></td>';
                        endforeach; 
                    endfor; 
                ?>
            </tr>
        </table>
        <br/><br/><br/>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable" style="margin-bottom: 12px;">
            <tr> 
                <td width="30%" class="ewTableHeader">Parent School Code</td>
                <td>                   
                   <input name="parent_sch_num_nf" id="parent_sch_num_nf" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="12" maxlength="9">
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
            <tr class="ewTableHeader"> 
                <td rowspan="2" width="30%">Student Details</td>
                <td colspan="11">Total Female Students</td>
            </tr>
            <tr class="ewTableHeader"> 
                <?php for($i=1;$i<=10;$i++): ?> 
                    <td align="center"><?php echo $i; ?></td>
                <?php  endfor; ?>
                <td align="center">Total</td>
            </tr>
            <tr>
                <td>Total Students</td>
                <?php 
                for($i=0;$i<11;$i++): 
                     echo '<td><input type="text" name="total_'.($i+1).'" id="total_'.($i+1).'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                     if($i==10)
                         echo 'disabled';
                     echo'/></td>';
                endfor; 
                ?>
            </tr>
            <tr>
                <td>Only Dalit</td>
                <?php 
                for($i=0;$i<11;$i++): 
                     echo '<td><input type="text" name="dalit_'.($i+1).'" id="dalit_'.($i+1).'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                     if($i==10)
                         echo 'disabled';
                     echo'/></td>';
                endfor; 
                ?>
            </tr>
            <tr>
                <td>Only Janajati</td>
                <?php 
                for($i=0;$i<11;$i++): 
                     echo '<td><input type="text" name="janaj_'.($i+1).'" id="janajati_'.($i+1).'" size="5" maxlength="3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);"';
                     if($i==10)
                         echo 'disabled';
                     echo'/></td>';
                endfor; 
                ?>
            </tr>
        </table>
    </form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>

<script>




<?php
// default parent school code
echo "document.forms[0]['parent_sch_num_nf'].value = '$sch_num';\n";
echo "document.forms[0]['parent_sch_num_open'].value = '$sch_num';\n";


//for openschool
foreach(array(1=>'lsec1',2=>'lsec2',3=>'secon') as $i=>$value){
	$result=mysql_query("select * from opensch_info_f1 where sch_num='$sch_num' and sch_year='$currentyear' and opensch_level=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

        echo "document.forms[0]['parent_sch_num_open'].value ='".$r['parent_code']."';\n";
	echo "document.forms[0]['{$value}_1_f'].value='".$r['total_f']."';\n";
        echo "document.forms[0]['{$value}_1_m'].value='".$r['total_m']."';\n";
        echo "document.forms[0]['{$value}_2_f'].value='".$r['dalit_f']."';\n";
        echo "document.forms[0]['{$value}_2_m'].value='".$r['dalit_m']."';\n";
        echo "document.forms[0]['{$value}_3_f'].value='".$r['janajati_f']."';\n";
        echo "document.forms[0]['{$value}_3_m'].value='".$r['janajati_m']."';\n";
        
        
        echo "handleChange(document.forms[0]['{$value}_1_f']);\n";
        echo "handleChange(document.forms[0]['{$value}_1_m']);\n";
        echo "handleChange(document.forms[0]['{$value}_2_f']);\n";
        echo "handleChange(document.forms[0]['{$value}_2_m']);\n";
        echo "handleChange(document.forms[0]['{$value}_3_f']);\n";
        echo "handleChange(document.forms[0]['{$value}_3_m']);\n";
	
}

//non-formal
for($i=1;$i<11;$i++){
	$result=mysql_query("select * from nf_info_f1 where sch_num='$sch_num' and sch_year='$currentyear' and nf_class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

        echo "document.forms[0]['parent_sch_num_nf'].value ='".$r['parent_code']."';\n";
	echo "document.forms[0]['total_{$i}'].value='".$r['no_total']."';\n";
        echo "document.forms[0]['dalit_{$i}'].value='".$r['no_dalit']."';\n";
        echo "document.forms[0]['janaj_{$i}'].value='".$r['no_janajati']."';\n";
        
        echo "handleChange(document.forms[0]['total_{$i}']);\n";
        echo "handleChange(document.forms[0]['dalit_{$i}']);\n";
        echo "handleChange(document.forms[0]['janaj_{$i}']);\n";
}



?>
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>