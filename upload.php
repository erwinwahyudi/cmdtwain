<?php
	echo "accepted";
	echo $_POST['img_file'];
	if (isset($_POST['img_file'])){
		$image = str_replace('data:image/png;base64,', '', $_POST['img_file']);
		$image = str_replace(' ', '', $image);
		$name = md5(rand(1000,100000)); 
		$filename = $name.'.jpg';
		$savename = $name.'_compres.jpg';

		echo $filename." ".$savename;

		$success = file_put_contents($filename, base64_decode($image));

		$info = getimagesize($filename);
		if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($filename); elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($filename); elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($filename);
		imagejpeg($image, $savename, 75);
		echo $success?'sucess':'failed';
	}
?>