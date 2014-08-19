<html>
<body>
<table>
<?php 

@require_once("../lib/excel.lib.php");

$data = new Spreadsheet_Excel_Reader("/tmp/test.xls", false);

for ($row = 1;$row < 30;$row++){
	echo "<tr>";
	for ($i=1;$i<30;$i++){
		echo "<td>",$data->val($row,$i),"</td>";
	}
	echo "</tr>";
}
?>
</table>
</body>
</html>

