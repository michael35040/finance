<?php

  // Set the content-type
  header('Content-Type: image/png');
  
  
  //placeholder2.php?name1=value1&name2=value2
  //placeholder2.php?text=AG 47
  
  $font = '/font/chunky.otf';  
  $rotation = 0; 
  $height = 200;
  $width = 400;
  if(!empty($_GET["text"])){$text = $_GET["text"];}else{$text = 'AU GOLD';}
  if(!empty($_GET["fontcolor"])){$fontcolor = $_GET["fontcolor"];}else{$fontcolor = $black;}
  if(!empty($_GET["backgroundcolor"])){$backgroundcolor = $_GET["backgroundcolor"];}else{$backgroundcolor = $gold;}
  if(!empty($_GET["shadow"])){$shadow = $_GET["shadow"];}else{$shadow = $gray;}
  if(!empty($_GET["size"])){$size = $_GET["size"];}else{$size = 20;}
  

  
  // Create the image
  $im = imagecreatetruecolor($width, $height);
  
  // Create some colors
  $dollar = imagecolorallocate($im, 133, 187, 101); //USD
  $silver = imagecolorallocate($im, 204, 204, 204); //XAG
  $gold = imagecolorallocate($im, 255, 215, 0); //XAU
  $orange = imagecolorallocate($im, 255, 102, 0); //JPY
  $darkblue = imagecolorallocate($im, 0, 51, 102); //EUR
  $babyblue = imagecolorallocate($im, 51, 255, 255); //GBP
  $brown = imagecolorallocate($im, 102, 51, 0); //INR
  
  $red = imagecolorallocate($im, 0, 255, 0);//CNY
  $blue = imagecolorallocate($im, 0, 0, 255); //XBT
  $green = imagecolorallocate($im, 255, 0, 0); 
  
  $black = imagecolorallocate($im, 0, 0, 0); 
  $white = imagecolorallocate($im, 255, 255, 255);
  $gray = imagecolorallocate($im, 128, 128, 128);
  
  
  imagefilledrectangle($im, 0, 0, ($width-1), ($height-1), $backgroundcolor);
  
  //FIGURE SIZE
  // First we create our bounding box for the first text
  $bbox = imagettfbbox($size, $rotation, $font, $text);
  
  //CENTER TEXT This is our cordinates for X and Y
  $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2);
  $y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2);
  
  
  // Add some shadow to the text
  imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $text);
  
  // Add the text
  imagettftext($im, $size, $rotation, $x, $y, $fontcolor, $font, $text);
  
  // Using imagepng() results in clearer text compared with imagejpeg()
  imagepng($im);
  imagedestroy($im);
  ?>

