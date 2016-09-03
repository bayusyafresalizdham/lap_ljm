<?php
	error_reporting(0);
	$periode = $_REQUEST['valuz'];
	$jurusan = $_REQUEST['srchby'];
	echo "<script>window.location.assign('surat.php?periode=".$periode."&nama=".$jurusan."')</script>";

?>
