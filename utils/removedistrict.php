<?php

require_once('../includes/tablelist.php');
require_once('../includes/excelEMIS_tables.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

if (isset($_POST['submit'])){
    	
	$districts = $_POST['d'];
        $f=$_POST['flash'];
       // $f2=$_POST['flash2'];
        $ach=$_POST['ach'];
        $tmis=$_POST['tmis'];
        $excelEMIS=$_POST['excelEMIS'];
	
        if($districts)
        {
	foreach($districts as $d){
		
		foreach($t as $table){
			//if ($table=='mast_district' || $table == 'mast_vdc') continue;
                        if (whichDB($table)==0) continue;
                        if (whichDB($table)==1 && $f=='') continue;
                        if (whichDB($table)==2 && $f=='') continue;
                        if (whichDB($table)==3) continue;
			
                        //clear the achievement data
                        if (whichDB($table)==4 && $ach!=='')
                        {
                            if($table!='subjects')
                            {
                                mysql_query("delete from `achievement`.`$table` where stu_num like '$d%'");
                            }
                            else
                            {
                                mysql_query("delete from `achievement`.`$table` where dist_code like '$d%'");
                            }
                            continue;
                        }
			mysql_query("delete from $table where sch_num like '$d%'");
			
		}
		
		// remove tmis tables		
		// get all tid's for this district
                if($tmis!='')
                {
                    $result = mysql_query("select * from tmis_main where sch_num like '$d%'");
                    $tids = mysql_fetch_all($result);
		
                	foreach($tids as $tid){
                            
                        	foreach($t as $table){
                                    if (substr($table,0,4)!='tmis') continue;
                                    mysql_query("delete from $table where tid='${tid['tid']}'");
                                    //print("delete from $table where tid='${tid['tid']}'\n");
				
                                }			
			
                        }
                }
                
                //remove excelEMIS data
                if($excelEMIS!='')
                {
                        foreach ($excelEMIS_tables as $table):
                            /** check whether it is a tmis table or student_id table
                            *  and set the required conditions respectively 
                            */
                            $query="delete from `$table` where ";
                            if(substr($table, 0, 2)=="id")    
                                $query.="sch_num like '$d%'";
                            else if(substr($table, 0, 4)=="tmis")
                                $query.="tid like '$d%'";
                            else
                                continue;
                            mysql_query($query);
                        endforeach;
                }
                
                //deleting master tables
                if($f!='')                        
                {
                    foreach($t as $table)
                    {
                        if (substr($table,0,4)!='mast') continue;
                        if($table=='mast_school_type')
                        {
                            mysql_query("delete from $table where sch_num like '$d%'");  
                            continue;
                        }
                        mysql_query("delete from $table where dist_code='$d'");

                    }
                }
		
     }
        
  }
}
?>

<html>
<head>
<title>Flash - Remove District</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<h2 align="center">Remove District</h2>

<p style='color:red;' align="center">WARNING: This will remove all year data for selected district!</p>
<p align="center">&nbsp;

<?php
	if ($_POST['submit']){
		echo "<div class='ewmsg' style='text-align:center;'>";
		echo "Data for ".count($districts)." district(s) removed from database.";
		echo "</div>";
	}

?>
</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">


  <p align="center"> 
  
  
  
<?php  

	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('District: <br /><select name="d[]" id="d" onchange="return handlechange(this, event);" size="10" multiple>');
	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');
	
?>
  </p>
  <p align="center">
  <input type="checkbox" name="flash" id="flash"/><label>Flash</label>
  <!--<input type="checkbox" name="flash2" id="flash2"/><label>Flash II</label>-->
  <input type="checkbox" name="tmis" id="tmis"/><label>Tmis</label>    
  <input type="checkbox" name="ach" id="ach"/><label>Achievement</label>
  <input type="checkbox" name="excelEMIS" id="excelEMIS"/><label>Excel EMIS Data</label>
  </p>
  <p align="center">
    <input type="submit" name="submit" value="Remove">
  </p>  
</form>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

<script>
    <?php
    //disable delete if there are no districts
        $result = mysql_query('select * from mast_district order by dist_name');
	$row = mysql_fetch_all($result);
        if(count($row)<1)
        {
            echo "document.getElementById('flash').disabled=true;\n";
            echo "document.getElementById('tmis').disabled=true;\n";
            echo "document.getElementById('ach').disabled=true;\n";
            echo "document.getElementById('excelEMIS').disabled=true;\n";

        }

    ?>
</script>

</body>
</html>
