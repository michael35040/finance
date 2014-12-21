
<?php 
//The above will look in the folder /html/img for all the JPG files then pick one at random and return it.
//The added benefit here is that simply adding images to the myimages folder adds them as an option to be returned, no code changes needed.
//You still call it with <img src="image.php" /> or whatever you name the PHP file.

$pics = glob('../public/img/logo/*.PNG', GLOB_NOSORT); 
$pic = $pics[array_rand($pics)]; 
header("Content-type: image/png"); 
header("Content-Disposition: filename=\"" . basename($pic) . "\""); 
readfile($pic); 
?>