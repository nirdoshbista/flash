<?php

$v = $_GET['v'];
$s = $_GET['s'];


$str = "<?php \$autoFillMode='$v';\n\$autoFillSchool='$s'; ?>";

file_put_contents("autofillsettings.php",$str);

?>