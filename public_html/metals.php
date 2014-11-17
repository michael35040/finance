<?php
include '../includes/config.php'; 
//https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/

$data1 = file_get_contents('https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/');
$xml2 = simplexml_load_file('https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/');


$url = 'https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/';
$xml = file_get_contents($url);
$data = new SimpleXMLElement($xml);

echo(var_dump(get_defined_vars()));
?>
