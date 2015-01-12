<?php


//initalise the necessary includes and connect to the database
require_once('includes/vars.php');
require_once('includes/dbfunctions.php');


if (!checkcookie()) header("Location: ../login.php");

$link = dbconnect($dbname);

?>
<html>
    <head>
        <title>Add Agency</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="../includes/jQuery 1.11/jQuery 1.11.js" type="text/javascript"></script>
        
        <script src="js/addagency.js" type="text/javascript"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="initialize();"> 
        <?php 
            if ($_POST['addagency'])
            { 
                $data['dist_code']=$_POST['distlist'];
                $data['year']=$currentyear;
                $data['agency_name']=$_POST['agencyname'];
                
                //insert the information into nfe master database,agency id is autoincremented at the database side
                idata('nfe_mast_agency', $data);
                        
                echo "<script>alert('".$data['agency_name']." has been added successfully!')</script>";
            } 
        ?>
        <div align="center">
            <p><img src="../images/iemis logo.png" style="width:470px;"></p>
        </div>
        <br>
        <center><h3>Add Agency by District</h3></center>
        <div style="margin-left:35%;">
            <form method="POST">
                <div class="addAgency_box">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>District</span>
                                    </td>
                                    <td>
                                        <span id='divdistrict'><select name="distlist" id="distlist"></select></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Agency Name</span>
                                    </td>
                                    <td>
                                        <span id='divagency'><textarea name="agencyname" style="width:200px;" id="agencyname" onKeypress="validateInput();"></textarea></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" id="addagency" name="addagency" value="Add Agency" disabled/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </form>
        </div>
        <div class="modal"><!-- Place at bottom of page --></div>
        <div id="toprightmenu" style="position:absolute; top:10px; right:10px;">
            <a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a>
        </div>
        <br />
    </body>
</html>