<?php

//initalise the necessary includes and connect to the database
require_once('includes/vars.php');
require_once('includes/dbfunctions.php');

$link = dbconnect();

?>
<html>
    <head>
        <title>Export EMIS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="../includes/jQuery 1.11/jQuery 1.11.js" type="text/javascript"></script>
        
        <script src="js/exportNFEMIS.js" type="text/javascript"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="initialize();">
        <div align="center">
            <p><img src="../images/iemis logo.png" style="width:470px;"></p>
        </div>
        <br>
        <center><h3>Select Agency to Export</h3></center>
        <div style="margin-left:35%;">
                <div class="exportEMIS_box">
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
                                        <span>
                                            Agency
                                        </span>
                                    </td>
                                    <td>
                                        <span id='agencylist'><select id="agncylist" name="agncylist[]" multiple size="6" style="min-width: 190%;"></select></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="button" id="exportbutton" name="export" value="Export to Desktop" onclick="ajaxExportExcel()" disabled/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
        </div>
        <div class="modal"><!-- Place at bottom of page --></div>
        <div id="toprightmenu" style="position:absolute; top:10px; right:10px;">
            <a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a>
        </div>
        <br />
    </body>
</html>