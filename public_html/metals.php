<?php
include '../includes/config.php'; 
//https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/

$data = file_get_contents('https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/');
$xml = simplexml_load_file('https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/');
echo(var_dump(get_defined_vars()));


?>
