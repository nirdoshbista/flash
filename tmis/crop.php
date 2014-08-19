<?php 

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$tid = $_GET['tid'];
$sch_num = $_GET['s'];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $targ_h = 300;
	$jpeg_quality = 90;
	
	$tid = $_POST['tid'];
	$sch_num = $_POST['s'];	
	
	// get image
	$result = mysql_query("SELECT photo FROM tmis_photos WHERE tid='$tid'");
	$row =  mysql_fetch_assoc($result);	

	$img_r = imagecreatefromstring($row['photo']);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	$temp_file = tempnam(sys_get_temp_dir(), 'img');

	imagejpeg($dst_r,$temp_file,$jpeg_quality);

	$image_str = file_get_contents($temp_file);
	unlink($temp_file);
	
	// put image back to db
	mysql_query("UPDATE tmis_photos SET photo='".mysql_escape_string($image_str)."' WHERE tid='$tid'");

	header("Location: tmis_general.php?tid=$tid&s=$sch_num");
	
	exit;
}


?>
<html>
	<head>
		<title>TMIS Image Crop</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

		<script language="Javascript">

			$(function(){

				$('#cropbox').Jcrop({
					aspectRatio: 1,
					setSelect: [50, 50, 200, 200],
					onSelect: updateCoords
				});

			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};

		</script>

	</head>

	<body>

		<h2>Image Crop</h2>

		<!-- This is the image we're attaching Jcrop to -->
		<img src="photo.php?get&tid=<?php echo $tid; ?>" id="cropbox" />

		<!-- This is the form that our event handler fills -->
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" value="50" />
			<input type="hidden" id="y" name="y" value="50" />
			<input type="hidden" id="w" name="w" value="200" />
			<input type="hidden" id="h" name="h" value="200" />
			
			<input type="hidden" id="tid" name="tid" value="<?php echo $tid; ?>" />
			<input type="hidden" id="s" name="s" value="<?php echo $sch_num; ?>" />
			<input type="submit" value="Crop Image" />
		</form>

	</body>
</html>
