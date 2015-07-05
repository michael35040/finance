<?php
// Include the library
require('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://www.kitco.com/mobile/');
$apmexGold = file_get_html('http://mobile.apmex.com/product/9/Canada-1-oz-Gold-Maple-Leaf-(Random-Year)');
$apmexPalladium = file_get_html('http://mobile.apmex.com/product/32457/Canada-1-oz-Palladium-Maple-Leaf-BU-(Random-Year)');
$apmexPlatinum = file_get_html('http://mobile.apmex.com/product/60/Canada-1-oz-Platinum-Maple-Leaf-BU-(Random-Year)');
$apmexSilver = file_get_html('http://mobile.apmex.com/product/1090/Canada-1-oz-Silver-Maple-Leaf-BU-(Random-Year)');



// Extract all text from a given cell
$maple["gold"] = $apmexGold->find('<td>1  - 24  </td><td> for </td><td> ', 1)->plaintext.'<br><hr>'; 
var_dump($maple); 


/*
//To prove it works.
var_dump($gold); 
var_dump($silver); 
var_dump($platinum); 
var_dump($palladium); 
var_dump($rhodium);
*/
?>

 
