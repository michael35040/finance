<?php

  // Set the content-type
header('Content-Type: image/png');
require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));


//placeholder.php?name1=value1&name2=value2
  //placeholder.php?height=100&width=200&text=SILVER&backgroundcolor=ffd700

if(!empty($_GET["fontcolor"])){$fontcolor = ltrim($_GET["fontcolor"], '#');}else{$fontcolor = "000000";}
if(!empty($_GET["backgroundcolor"])){$backgroundcolor = ltrim($_GET["backgroundcolor"], '#');}else{$backgroundcolor = '808080';}
if(!empty($_GET["shadow"])){$shadow = ltrim($_GET["shadow"], '#');}else{$shadow = "202020";}
if(!empty($_GET["height"])){$height = $_GET["height"];}else{$height = '100';}
if(!empty($_GET["width"])){$width = $_GET["width"];}else{$width = '200';}
if(!empty($_GET["text"])){$text = $_GET["text"];}else{$text = '';}
if(!empty($_GET["quantity"])){$quantity = $_GET["quantity"];}else{$quantity = '';}
if(!empty($_GET["size"])){$size = $_GET["size"];}else{$size = '20';}
if(!empty($_GET["rotation"])){$rotation = $_GET["rotation"];}else{$rotation = '0';}
if(!empty($_GET["price"])){$price = $_GET["price"];}else{$price = '0';}

    if(!ctype_alnum($fontcolor))        {exit;apologize("Invalid Format!1");}
    if(!ctype_alnum($backgroundcolor))  {exit;apologize("Invalid Format!2");}
    if(!ctype_alnum($shadow))           {exit;apologize("Invalid Format!3");}
    if(!ctype_alnum($height))           {exit;apologize("Invalid Format!4");}
    if(!ctype_alnum($width))            {exit;apologize("Invalid Format!5");}
    if(!ctype_alnum($text))             {exit;apologize("Invalid Format!6");}
    if(!ctype_alnum($size))             {exit;apologize("Invalid Format!7");}
    if(!ctype_alnum($rotation))         {exit;apologize("Invalid Format!8");}


// Create the image
  $im = imagecreatetruecolor($width, $height);

//requires 6 chars
list($r,$g,$b) = array_map('hexdec',str_split($fontcolor,2));
$fontcolor=imagecolorallocate($im, $r, $g, $b);

list($r,$g,$b) = array_map('hexdec',str_split($backgroundcolor,2));
$backgroundcolor=imagecolorallocate($im, $r, $g, $b);

list($r,$g,$b) = array_map('hexdec',str_split($shadow,2));
$shadow=imagecolorallocate($im, $r, $g, $b);



    imagefilledrectangle($im, 0, 0, ($width-1), ($height-1), $backgroundcolor);

    //SYMBOL TEXT
    $size = 20;
    $font = 'fonts/LeagueGothic-Regular.otf';
    $bbox = imagettfbbox($size, $rotation, $font, $text);
    $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5; //horizontal
    $y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 5; //vertical
    imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $text);
    imagettftext($im, $size, $rotation, $x, $y, $fontcolor, $font, $text);


// QUANTITY TEXT
if($quantity>0)
{
    //$font = 'fonts/engraved.ttf';
    $size = 16;
    $quantity = strval(number_format($quantity, 0, ".", ","));
    $bbox = imagettfbbox($size, $rotation, $font, $quantity);
    $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5; //horizontal
    $y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 35; //vertical
    imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $quantity);
    imagettftext($im, $size, $rotation, $x, $y, $fontcolor, $font, $quantity);
}

// PRICE TEXT
if($quantity>0)
{
    $size = 16;
    $price = $unitsymbol . number_format($price, $decimalplaces, ".", ","); //$price, $decimalplaces
    $bbox = imagettfbbox($size, $rotation, $font, $price);
    //CENTER TEXT This is our cordinates for X and Y
    $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5; //horizontal
    $y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) + 25; //vertical

    imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $price);
    imagettftext($im, $size, $rotation, $x, $y, $fontcolor, $font, $price);
}

// Using imagepng() results in clearer text compared with imagejpeg()
  imagepng($im);
  imagedestroy($im);

  ?>

