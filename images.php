<?php
/***********************************************************************
*
*  Author:: Manuel Moscoso <mmoscoso@mobiquos.cl>
* Copyright 2013, Mobiquos LTDA
************************************************************************/
if(isset($_GET['plan'])){
	$plan = $_GET['plan'];
	$images = array('6h','12h','24h','48h');
	
	//Creating table with images
	echo '<center><table>';
	foreach($images as $img){
		echo '<tr><td>';
		echo '<img src="rrdimages/img-'.$_GET['plan'].'-'.$img.'.png"></img>';
		echo '</td></tr>';
	}
	echo '</table></center>';
}
else {
	header("Location: index.php");
}
?>