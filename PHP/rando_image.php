<?php

	/*Dynamic way to get the root on the current server.
	makes it easier if moving site to different structures*/
	$dir = $_SERVER['DOCUMENT_ROOT'] . '/landing/wallpapers/';

	//creates a glob array of all images in the folder	
	$images = glob($dir . '*{.jpg,png,jpeg}', GLOB_BRACE);

	//Uses a array randomisation function to then randomly order the glob array
	$image = array_rand($images);

	//Takes the randomly picture and creates a string that can easily inserted into css.
	$image_string = 'wallpapers/' . basename($images[$image]);

	echo $image_string;
?>
