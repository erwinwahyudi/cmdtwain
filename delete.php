<?php
	$handle = opendir('scanned_doc/');
	while(false != ($entry = readdir($handle))){
		if (preg_match('/hasil_scan/', $entry)){
			unlink('scanned_doc/'.$entry);
		}
	}
	closedir($handle);
?>