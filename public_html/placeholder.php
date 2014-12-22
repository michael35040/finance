<?php

// Set the content-type
header('Content-Type: image/png');
require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));

function adjustColor($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else
    { //if(preg_match("/#/",$color_code))
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));

        return str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
        .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
        .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);

    }
}

function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    //return '#'.$r_hex.$g_hex.$b_hex;
    return $r_hex.$g_hex.$b_hex;
}


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
if(!empty($_GET["name"])){$name = $_GET["name"];}else{$name = '';}

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
//$im     = imagecreatefrompng("images/button1.png");
//imagecreatefromjpeg imagecreatefromgif imagecreatefrompng


//requires 6 chars
list($r,$g,$b) = array_map('hexdec',str_split($fontcolor,2));
$fontcolor=imagecolorallocate($im, $r, $g, $b);

list($r,$g,$b) = array_map('hexdec',str_split($backgroundcolor,2));
$backgroundcolor=imagecolorallocate($im, $r, $g, $b);

list($r,$g,$b) = array_map('hexdec',str_split($shadow,2));
$shadow=imagecolorallocate($im, $r, $g, $b);

$font = 'fonts/LeagueGothic-Regular.otf';


imagefilledrectangle($im, 0, 0, ($width-1), ($height-1), $backgroundcolor);

//SYMBOL TEXT
$size = 85;
//$fontcolor2 = adjustBrightness($backgroundcolor, -1);
$fontcolor2 = adjustColor($backgroundcolor,1); //-5 for lighter, 5 for darker
$bbox = imagettfbbox($size, $rotation, $font, $text);
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5; //horizontal
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 5; //vertical
imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $text);
imagettftext($im, $size, $rotation, $x, $y, $fontcolor2, $font, $text);


//NAME TEXT
$size = 20;
$bbox = imagettfbbox($size, $rotation, $font, $name);
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5; //horizontal
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 5; //vertical
imagettftext($im, $size, $rotation, ($x+1), ($y+1), $shadow, $font, $name);
imagettftext($im, $size, $rotation, $x, $y, $fontcolor, $font, $name);


// QUANTITY TEXT
if($quantity>0)
{
    //$font = 'fonts/engraved.ttf';
    $size = 16;
    $quantity = strval(number_format($quantity, 0, ".", ","));
    $quantity = ($quantity . 'x');
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

