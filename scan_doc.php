<?php
	$_POST['scan'] = 'true';
	if ($_POST['scan'] == 'true'){
		session_start();
		
		if (isset($_SESSION['scan_number'])){
			$_SESSION['scan_number']++;
		} else {
			$_SESSION['scan_number'] = 1;
		}

		// if (!isset($_SESSION['scan_number_test'])) $_SESSION['scan_number_test'] = 7;
		
		// if ($_SESSION['scan_number_test'] == 7){
		// 	$_SESSION['scan_number_test']++;
		// } else {
		// 	$_SESSION['scan_number_test']--;
		// }

		$file_name = 'hasil_scan'.$_SESSION['scan_number'].'.jpg';

		passthru('"C:\Program Files\GssEziSoft\CmdTwain\cmdtwain.exe" /PAPER=A4/RGB/DPI=200/JPG75 F:\xampp\htdocs\cmdtwain\scanned_doc\\'.$file_name);
		$return_data = array();
		$return_data['file_name'] = $file_name;

		$path = 'scanned_doc/'.$file_name;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);

		$base_64_img = 'data:image/'.$type.';base64,'.base64_encode($data);

		$return_data['base64image'] = $base_64_img;
		// header('Content-Type: application/json');
		echo $_GET['callback'].'('.json_encode($return_data).')';
	}
?>