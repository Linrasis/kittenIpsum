<?php
	$array_kitten = glob('kitten/*');
	$filename = $array_kitten[array_rand($array_kitten)];
	
	list($width, $height, $type, $attr) = getimagesize($filename);
	$x = $_GET['x'];
	$y = $_GET['y'];
	$ratio = $x/$y;
	if(in_array($type, array(1, 2, 3))) {
		$dst_x = ($width > ($height*$ratio)) ? round(($width-($height*$ratio))/2) : 0;
		$dst_y = ($width < ($height*$ratio)) ? round(($height-($width/$ratio))/2) : 0;

		$dst_w = ($width > ($height*$ratio)) ? round($height*$ratio) : $width;
		$dst_h = ($width < ($height*$ratio)) ? round($width/$ratio) : $height;


		$image_p = imagecreatetruecolor($x, $y);
		if ($type == 1) {
			$image = imagecreatefromgif($filename);
			$ext = 'gif';
		}
		if ($type == 2) {
			$image = imagecreatefromjpeg($filename);
			$ext = 'jpg';
		}
		if ($type == 3) {
			$image = imagecreatefrompng($filename);
			$ext = 'png';
		}
		imagecopyresampled($image_p, $image, 0,0,$dst_x,$dst_y, $x, $y, $dst_w, $dst_h);
		header('Content-Type: image/jpeg');
		imagejpeg($image_p);
	}
?>