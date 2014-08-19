<?php

$orientation=strtoupper(substr($_GET['orientation'],0,1));
$pagetype=$_GET['size'];

// paper sizes in pixel (72dpi)
$page_size["letter"] = array("w"=>612,"h"=>792);
$page_size["a4"] = array("w"=>595,"h"=>842);
$page_size["a3"] = array("w"=>842,"h"=>1190);

$width = $page_size[$pagetype]["w"];
$height = $page_size[$pagetype]["h"];

if ($orientation=="L"){
	$tmp=$width;
	$width=$height;
	$height=$tmp;
}


include("fpdf/fpdf.php");

$pdf = new FPDF($orientation,'pt',$pagetype);

$pdf->AddPage();
$pdf->SetFont('Arial','',7);

for ($i=0;$i<$width;$i+=20){
	$pdf->Line($i,0,$i, $height);
	$pdf->Text($i,60, $i);
}
for ($i=0;$i<$height;$i+=20){
	$pdf->Line(0,$i,$width, $i);
	$pdf->Text(60,$i+7, $i);
}



$pdf->Output("{$pagetype}_{$orientation}.pdf","D");

