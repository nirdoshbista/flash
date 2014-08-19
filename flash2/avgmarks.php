<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash II</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/avgmarks.js" type="text/javascript"></script>
<?php

$classes=schoolclasses($sch_num);
$highest_class=0;

$input_state=array();
foreach($classes as $class => $exists)
{
    if(!$exists)
        $input_state[$class]="disabled";
    else
        $input_state[$class]="";
    
    if ($class>$highest_class && $classes[$class]>0)
	$highest_class=$class;
}

/*
if($highest_class>6 && $highest_class<12)
{
    $header1_colspan=27;
    $header2_colspan=($highest_class%6)*4+1;
}
elseif ($highest_class==6) 
{
    $header1_colspan=27;
    $header2_colspan=0;
}
elseif ($highest_class==12) 
{
    $header1_colspan=$header2_colspan=25;
}
else
{
    $header1_colspan=$highest_class*4+4;
    $header2_colspan=0;
}*/
?>
</head>
<body onLoad="navigation();">
<div align="center">
  <p><img src="../images/flash2.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

</p>
<form action="controller.php" method="post">
    <table width="100%" class="ewTable">
      <tr align="center" class="ewTableHeader">
        <td colspan="25"><strong>Primary Level</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> </td>
		
	<td width="7"></td>
		
	<?php for($class=1;$class<6;$class++){ ?>

                <td colspan="3"><strong><?php echo $class; ?></strong></td>

        	<td width="7"></td>
	<?php } ?>
		<td colspan="3"><strong>Total Average</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> Subjects</td>
		
	<td width="7"></td>
		
	<?php for($class=1;$class<6;$class++){ ?>
        
            <td><strong>F</strong></td>

            <td><strong>M</strong></td>

            <td><strong>T</strong></td>
		
            <td width="7"></td>
        <?php } ?>
		
	<td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>
		
		
      </tr>

      <tr class="ewTableRow">
        <td width="120">Nepali&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
                        <?php if($classes[$class]!=0) { }?>
        		<td><input type="text" name='sch_g_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[1]"; ?>' size="4" disabled></td>

			<td width="7"></td>
                        
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[1]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[1]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[1]' size="4" disabled></td>

      </tr>
      
      <tr class="ewTableRow">
        <td width="120">English&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
        
        		<td><input type="text" name='sch_g_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[2]"; ?>' size="4" disabled></td>

                        <td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[2]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[2]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[2]' size="4" disabled></td>

      </tr>
      
      <tr class="ewTableRow">
        <td width="120">Math&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
			
        		<td><input type="text" name='sch_g_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[3]"; ?>' size="4" disabled></td>

			<td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[3]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[3]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[3]' size="4" disabled></td>

      </tr>
      
      
      <tr class="ewTableRow">
        <td width="120">Social Studies&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
			
        		<td><input type="text" name='sch_g_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[4]"; ?>' size="4" disabled></td>

			<td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[4]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[4]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[4]' size="4" disabled></td>

      </tr>
      
      
      <tr class="ewTableRow">
        <td width="120">Science&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
			
        		<td><input type="text" name='sch_g_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[5]"; ?>' size="4" disabled></td>

			<td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[5]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[5]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[5]' size="4" disabled></td>

		
      </tr>
      
      
      <tr class="ewTableRow">
        <td width="120">Population & Environment&nbsp;</td>

        <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
			
        		<td><input type="text" name='sch_g_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[6]"; ?>' size="4" disabled></td>

			<td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[6]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[6]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[6]' size="4" disabled></td>

		
      </tr>
      <tr class="ewTableFooter">
           <td width="120">Total&nbsp;</td>

           <td width="7"></td>
		
		<?php for($class=1;$class<6;$class++){ ?>
			
        		<td><input type="text" name='sch_g_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[7]"; ?>' size="4" maxlength="3" disabled></td>

        		<td><input type="text" name='sch_b_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[7]"; ?>' size="4" maxlength="3" disabled></td>

        		<td><input type="text" name='sch_t_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[7]"; ?>' size="4" disabled></td>

			<td width="7"></td>
		<?php } ?>
		
			<td><input type="text" name='sch_g_primary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_primary[7]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_b_primary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_primary[7]' size="4" maxlength="3" disabled ></td>

        		<td><input type="text" name='sch_t_primary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_primary[7]' size="4" disabled></td>

		
      </tr>
    </table><br>
        <table class="ewTable" width="55%" style="float:left">
             <tr align="center" class="ewTableHeader">
                <td colspan="17"><strong>Lower Secondary Level</strong></td>
            </tr>

            <tr align="center" class="ewTableHeader">
                <td> </td>
		
		<td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
		
                    <td colspan="3"><strong><?php echo $class; ?></strong></td>

                    <td width="7"></td>
		<?php } ?>
                    
                    <td colspan="3"><strong>Total Average</strong></td>
            </tr>

            <tr align="center" class="ewTableHeader">
                <td> Subjects</td>
		
		<td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>		

                    <td><strong>F</strong></td>

                    <td><strong>M</strong></td>

                    <td><strong>T</strong></td>
		
                    <td width="7"></td>
		<?php } ?>
                    
                    <td><strong>F</strong></td>

                    <td><strong>M</strong></td>

                    <td><strong>T</strong></td>
            </tr>

            <tr class="ewTableRow">
                <td width="120">Nepali&nbsp;</td>

                <td width="7"></td>
            
		<?php for($class=6;$class<9;$class++){ ?>

                        	<td><input type="text" name='sch_g_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_b_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[1]"; ?>' size="4" disabled></td>

                                
                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[1]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[1]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[1]' size="4" disabled></td>

            </tr>
      
            <tr class="ewTableRow">
                <td width="120">English&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                                <td><input type="text" name='sch_g_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                        	<td><input type="text" name='sch_b_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[2]"; ?>' size="4" disabled></td>

                        	
                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[2]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[2]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[2]' size="4" disabled></td>
                                
            </tr>
      
            <tr class="ewTableRow">
            <td width="120">Math&nbsp;</td>

            <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                		<td><input type="text" name='sch_g_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                        	<td><input type="text" name='sch_b_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[3]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[3]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[3]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[3]' size="4" disabled></td>

            </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Social Studies&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                            <td><input type="text" name='sch_g_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_b_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_t_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[4]"; ?>' size="4" disabled></td>
        			
                            <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[4]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[4]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[4]' size="4" disabled></td>

             </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Science&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                            <td><input type="text" name='sch_g_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_b_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_t_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[5]"; ?>' size="4" disabled></td>

                            <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[5]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[5]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[5]' size="4" disabled></td>

            </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Population & Environment Ed&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_b_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[6]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[6]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[6]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[6]' size="4" disabled></td>

            </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Health & Physical Ed&nbsp;</td>

                <td width="7"></td>
		
                <?php for($class=6;$class<9;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[7]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_b_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[7]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                    		<td><input type="text" name='sch_t_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[7]"; ?>' size="4" disabled></td>

                        	<td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[7]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[7]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[7]' size="4" disabled></td>

            </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Art and Prevocational Ed&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[8]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[8]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                		<td><input type="text" name='sch_b_<?php echo $class."[8]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[8]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                		<td><input type="text" name='sch_t_<?php echo $class."[8]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[8]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[8]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[8]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[8]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[8]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[8]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[8]' size="4" disabled></td>

            </tr>
            <tr class="ewTableRow">
                <td width="120">Moral/Civics&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[9]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[9]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                		<td><input type="text" name='sch_b_<?php echo $class."[9]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[9]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                		<td><input type="text" name='sch_t_<?php echo $class."[9]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[9]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[9]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[9]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[9]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[9]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[9]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[9]' size="4" disabled></td>

            </tr>
            
            <tr class="ewTableFooter">
                <td width="120">Total&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=6;$class<9;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[10]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[10]"; ?>' size="4" maxlength="3" disabled></td>

                		<td><input type="text" name='sch_b_<?php echo $class."[10]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[10]"; ?>' size="4" maxlength="3" disabled></td>
                                
                                <td><input type="text" name='sch_t_<?php echo $class."[10]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[10]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_lsecondary[10]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_lsecondary[10]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_lsecondary[10]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_lsecondary[10]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_lsecondary[10]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_lsecondary[10]' size="4" disabled></td>

            </tr>
      </table>

    
    <table class="ewTable" width="44%" style="float:right">
             <tr align="center" class="ewTableHeader">
                <td colspan="13"><strong>Secondary Level</strong></td>
            </tr>

            <tr align="center" class="ewTableHeader">
                <td> </td>
		
		<td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
		
                    <td colspan="3"><strong><?php echo $class; ?></strong></td>

                    <td width="7"></td>
		<?php } ?>
                    
                    <td colspan="3"><strong>Total Average</strong></td>
            </tr>

            <tr align="center" class="ewTableHeader">
                <td> Subjects</td>
		
		<td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>		

                    <td><strong>F</strong></td>

                    <td><strong>M</strong></td>

                    <td><strong>T</strong></td>
		
                    <td width="7"></td>
		<?php } ?>
                    
                    <td><strong>F</strong></td>

                    <td><strong>M</strong></td>

                    <td><strong>T</strong></td>
            </tr>

            <tr class="ewTableRow">
                <td width="120">Nepali&nbsp;</td>

                <td width="7"></td>
            
		<?php for($class=9;$class<11;$class++){ ?>

                        	<td><input type="text" name='sch_g_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_b_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[1]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[1]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[1]"; ?>' size="4" disabled></td>

                                
                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[1]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[1]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[1]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[1]' size="4" disabled></td>

            </tr>
      
            <tr class="ewTableRow">
                <td width="120">English&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
			
                                <td><input type="text" name='sch_g_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                        	<td><input type="text" name='sch_b_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[2]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[2]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[2]"; ?>' size="4" disabled></td>

                        	
                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[2]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[2]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[2]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[2]' size="4" disabled></td>
                                
            </tr>
      
            <tr class="ewTableRow">
            <td width="120">Math&nbsp;</td>

            <td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
			
                		<td><input type="text" name='sch_g_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                        	<td><input type="text" name='sch_b_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[3]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[3]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[3]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[3]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[3]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[3]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[3]' size="4" disabled></td>

            </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Social Studies&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
			
                            <td><input type="text" name='sch_g_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_b_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[4]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_t_<?php echo $class."[4]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[4]"; ?>' size="4" disabled></td>
        			
                            <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[4]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[4]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[4]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[4]' size="4" disabled></td>

             </tr>
      
      
            <tr class="ewTableRow">
                <td width="120">Science&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
			
                            <td><input type="text" name='sch_g_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_b_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[5]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                            <td><input type="text" name='sch_t_<?php echo $class."[5]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[5]"; ?>' size="4" disabled></td>

                            <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[5]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[5]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[5]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[5]' size="4" disabled></td>

            </tr>
           <tr class="ewTableRow">
                <td width="120">Health, Pop & Env.&nbsp;</td>

                <td width="7"></td>
            
		<?php for($class=9;$class<11;$class++){ ?>

                        	<td><input type="text" name='sch_g_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_b_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[6]"; ?>' size="4" maxlength="3" <?php echo $input_state[$class]; ?>></td>

                                <td><input type="text" name='sch_t_<?php echo $class."[6]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[6]"; ?>' size="4" disabled></td>

                                
                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[6]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[6]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[6]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[6]' size="4" disabled></td>

            </tr>


            <tr class="ewTableFooter">
                <td width="120">Total&nbsp;</td>

                <td width="7"></td>
		
		<?php for($class=9;$class<11;$class++){ ?>
			
                        	<td><input type="text" name='sch_g_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_<?php echo $class."[7]"; ?>' size="4" maxlength="3" disabled></td>

                		<td><input type="text" name='sch_b_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_<?php echo $class."[7]"; ?>' size="4" maxlength="3" disabled></td>
                                
                                <td><input type="text" name='sch_t_<?php echo $class."[7]"; ?>' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_<?php echo $class."[7]"; ?>' size="4" disabled></td>

                                <td width="7"></td>
                        <?php } ?>
                                <td><input type="text" name='sch_g_secondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_g_secondary[7]' size="4" maxlength="3" disabled ></td>

                                <td><input type="text" name='sch_b_secondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_b_secondary[7]' size="4" maxlength="3" disabled ></td>
                            
                                <td><input type="text" name='sch_t_secondary[7]' onKeyPress="return forceNumberInput(this, event);" onChange="cV(this);" id='sch_t_secondary[7]' size="4" disabled></td>

            </tr>
      </table>
</form>
<div class="clr"></div>
<div id="backbtn" style="margin-left:20px;margin-top: 60px;clear:none; float:left"></div>
<div id="nextbtn" style="margin-top: 60px;clear:none; float:right"></div>
<p>&nbsp;</p>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>
</html>
<script>
    <?php
        
        // get the number of enrolled students

        echo "var sn = new Array();\n";

        for ($i=1;$i<=12;$i++){
	
            if ($i>=1 && $i<=5) $table = 'class1_5_enroll_app';
            if ($i>=6 && $i<=8) $table = 'class6_8_enroll_app';
            if ($i>=9 && $i<=10) $table = 'class9_10_enroll_app';
            if ($i>=11 && $i<=12) $table = 'class11_12_enroll_app';
	
            $result = mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
	
            if (mysql_num_rows($result)==0) continue; // no data for that class
	
            $row = mysql_fetch_array($result);
	
            echo "sn['t_e_g_$i'] = '${row['tot_enroll_total_f']}';\n";
            echo "sn['t_e_b_$i'] = '${row['tot_enroll_total_m']}';\n";
            echo "sn['t_e_t_$i'] = '${row['tot_enroll_total_t']}';\n";
        }
        
        
        //retrieve data from database
        $sexes= array( 0 => "M", 1 => "F");
        for ($i=1;$i<=10;$i++){
		
		if ($i>=1 && $i<=5) {$table = 'pr_scores'; $subcount=6;}
                if ($i>=6 && $i<=8) {$table = 'lsec_scores'; $subcount=9;}
                if ($i>=9 && $i<=10) {$table = 'sec_scores'; $subcount=6;}
                
                for($sub=1;$sub<=$subcount;$sub++)
                {
                    //get female students marks
                    foreach($sexes as $sex){
                        $result = mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear' and class='$i' and subject_id='$sub' and sex='$sex'");
		
                        if (mysql_num_rows($result)==0) continue; // no data for that 
		
                        $row = mysql_fetch_array($result);
                    
                        $temp=$i.'['.$sub.']';
                        if ($sex=="M")
                        { 
                            echo "document.forms[0]['sch_b_$temp'].value = '${row['total']}';\n";
                            echo "cV(document.forms[0]['sch_b_$temp']);\n";
                        }
                        else{
                            echo "document.forms[0]['sch_g_$temp'].value = '${row['total']}';\n";
                            echo "cV(document.forms[0]['sch_g_$temp']);\n";
                        }
                    }
               }   
	}
        
        
// set for autofill
if (isset($_GET['af'])) 
{ 
    $subject_map=array("nepali"=>1,"english"=>2,"maths"=>3,
                         "social_studies"=>4,"science"=>5,"population_env"=>6);
    for($class=1;$class<13;$class++)
    {
        foreach(array('F'=>'_g_','M'=>'_b_','T'=>'_t_') as $sex_key=>$sex):
            foreach($subject_map as $subject=>$subject_key):
                $query="SELECT ROUND(AVG(`id_students_marks`.`{$subject}`)) AS average FROM `id_students_marks`
                        join `id_students_main` on (`id_students_main`.`reg_id`=`id_students_marks`.`reg_id` and `id_students_main`.`sch_year`=`id_students_marks`.`sch_year`) 
                        WHERE `id_students_marks`.`sch_num`='$sch_num'
                        AND `id_students_marks`.`sch_year`='$currentyear'
                        AND `id_students_marks`.`class`='$class'";
                
                if ($sex_key !="T")
                    $query .= " AND `id_students_main`.`gender`='$sex_key'";
                
                $result=  mysql_query($query);
                if (mysql_num_rows($result)>0)
                {
                    $row=mysql_fetch_assoc($result);
                    $id = "sch{$sex}{$class}[$subject_key]";
                    echo "document.forms[0].elements['$id'].value='".$row['average']."';\n";
                    echo "cV(document.forms[0].elements['$id']);\n";
                    echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
                }
            endforeach;
        endforeach;
    }
    /*
   //$currentyear--;
   $dist_code=substr($sch_num,0,2);
   
   //level specific subject map
   
   //$sch_class='8';
   for($sch_class=0;$sch_class<=10;$sch_class++)
   {
        //map subjects to each level
        if($sch_class<6) //primary
        {
            $subjectmap=array("nepali"=>1,"english"=>2,"math"=>3,
                         "social"=>4,"science"=>5,"population"=>6,"environment"=>6,
                          "population and environment"=>6);
        }
        else if($sch_class>5 and $sch_class<9)  //lsec
        {
            $subjectmap=array("nepali"=>1,"english"=>2,"math"=>3,
                         "social"=>4,"science"=>5,"population"=>6,"environment"=>6,"health"=>7,"physical"=>7,
                        "prevocational"=>8,"pre vocational"=>8,"arts"=>8,
                        "civic"=>9);
        }
        else    //sec
        {
            $subjectmap=array("nepali"=>1,"english"=>2,"math"=>3,
                         "social"=>4,"science"=>5,"population"=>6);
        }      
    
        //get no of subjects entered for that class
        $result=mysql_query("SELECT `subjects`.`subject_sn` as sn,`subjects`.`subject_name` as sub, 
                        `subjects`.`subject_theory_pass_mark` as theory_pass, 
                        `subjects`.`subject_practical_pass_mark` as prac_pass 
                        FROM `achievement`.`subjects` 
                        WHERE `subjects`.`dist_code`='$dist_code' 
                        AND `subjects`.`sch_year`='$currentyear' AND `subjects`.`class`='$sch_class'");
        if (mysql_num_rows($result)>0)
        {
            while($row=mysql_fetch_assoc($result))
            {
                    //get subject details and pass marks for that subject
                    $sub_id=$row['sn'];
                    $sub_name=$row['sub'];
                     //map that subject from achievement
                    $current_sub=0;
                    foreach($subjectmap as $name=>$sn)
                    {
                        //echo $sub_name."->".$name."<br/>";
                        if(strpos(strtolower($sub_name), strtolower($name))!==false)
                        {
                            $current_sub=$sn; 
                            foreach(array("g","b","t") as $sex)
                            {
                                if("g"==$sex)
                                {
                                    $result1 = mysql_query("SELECT count(*) as count,ROUND(AVG(`student_marks`.`s{$sub_id}`)) as avg FROM `achievement`.`student_main` 
                                                          join `achievement`.`student_marks` on (`student_main`.`stu_num`=`student_marks`.`stu_num` and `student_main`.`sch_year`=`student_marks`.`sch_year` 
                                                            and `student_main`.`class`=`student_marks`.`class`)  
                                                         WHERE `student_marks`.`class`='$sch_class' AND `student_main`.`sch_num`='$sch_num' 
                                                         AND `student_main`.`sch_year`='$currentyear' 
                                                         AND `student_main`.`sex`='2'");
                                }
                                if("b"==$sex)
                                {
                                    $result1 = mysql_query("SELECT count(*) as count,ROUND(AVG(`student_marks`.`s{$sub_id}`)) as avg FROM `achievement`.`student_main` 
                                                            join `achievement`.`student_marks` on (`student_main`.`stu_num`=`student_marks`.`stu_num` and `student_main`.`sch_year`=`student_marks`.`sch_year` 
                                                             and `student_main`.`class`=`student_marks`.`class`)  
                                                              WHERE `student_marks`.`class`='$sch_class' AND `student_main`.`sch_num`='$sch_num' 
                                                            AND `student_main`.`sch_year`='$currentyear' 
                                                            AND `student_main`.`sex`='1'");
                                }
                                if (mysql_num_rows($result1)>0)
                                {
                                    while($row1=mysql_fetch_assoc($result1))
                                    {
                                        $id = "sch_{$sex}_{$sch_class}[$current_sub]";
                                        if(sex!="t" && $row1['avg']!=="0")
                                        {
                                            echo "document.forms[0].elements['$id'].value='".$row1['avg']."';\n";
                                            echo "cV(document.forms[0].elements['$id']);\n";
                                            echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
                                        }
                                    }
                                }
                        }
                    }        
                }
            }
        }
    }*/
}        
        
    ?>
        //disable marks field if there are no students enrolled in that class
        var types=new Array("g","b","t");
        for(var grade=1;grade<=10;grade++)
        {
            for(var index=0;index<=2;index++)
            {
                if(!sn['t_e_'+types[index]+'_'+grade])
                {
                    for(var subj=1;subj<=9;subj++)
                    {
                     if(document.getElementById('sch_'+types[index]+'_'+grade+'['+subj+']'))
                        document.getElementById('sch_'+types[index]+'_'+grade+'['+subj+']').disabled = true;
                    }
                }
            }
                
        }
</script>
