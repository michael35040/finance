<?php
// Include the library
require('simple_html_dom.php');

// Retrieve the DOM from a given URL
$gold = file_get_html('http://mobile.apmex.com/product/9/Canada-1-oz-Gold-Maple-Leaf-(Random-Year)');
$palladium = file_get_html('http://mobile.apmex.com/product/32457/Canada-1-oz-Palladium-Maple-Leaf-BU-(Random-Year)');
$platinum = file_get_html('http://mobile.apmex.com/product/60/Canada-1-oz-Platinum-Maple-Leaf-BU-(Random-Year)');
$silver = file_get_html('http://mobile.apmex.com/product/1090/Canada-1-oz-Silver-Maple-Leaf-BU-(Random-Year)');
// Extract all text from a given cell
echo '<hr>APMEX<hr>';
echo '<br>Gold: ';
echo $gold->find('td', 9)->plaintext.'<br>';
echo '<br>Palladium: ';
echo $palladium->find('td', 9)->plaintext.'<br>';
echo '<br>Platinum: ';
echo $platinum->find('td', 9)->plaintext.'<br>';
echo '<br>Silver: ';
echo $silver->find('td', 9)->plaintext.'<br>';


// Retrieve the DOM from a given URL
$gold = file_get_html('http://www.jmbullion.com/2015-1-oz-canadian-gold-maple-leaf/');
$palladium = file_get_html('http://www.jmbullion.com/1-oz-canadian-palladium-maple-leaf/');
$platinum = file_get_html('http://www.jmbullion.com/2015-1-oz-canadian-platinum-maple-leaf/');
$silver = file_get_html('http://www.jmbullion.com/2015-canadian-silver-maple-leaf/');
// Extract all text from a given cell
echo '<hr>JM Bullion<hr>';
echo '<br>Gold: ';
echo $gold->find('span', 19)->plaintext.'<br>';
echo '<br>Palladium: ';
echo $palladium->find('span', 17)->plaintext.'<br>';
echo '<br>Platinum: ';
echo $platinum->find('span', 18)->plaintext.'<br>';
echo '<br>Silver: ';
echo $silver->find('span', 19)->plaintext.'<br>';




/*

foreach($jmbGold->find('span') as $e)
{
 echo $e->innertext . '=======' . $i . '<br>';
$i++;
}
$i=0;
foreach($apmexGold->find('td') as $e)
{
 echo $e->innertext . '=======' . $i . '<br>';
$i++;
}


//To prove it works.
var_dump($gold); 
var_dump($silver); 
var_dump($platinum); 
var_dump($palladium); 
var_dump($rhodium);
*/
?>

 
