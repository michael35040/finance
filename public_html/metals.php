<?php
$xmldata = "https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/au/";
//https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/

$xml=simplexml_load_string($xmldata) or die("Error: Cannot create object");
print_r($xml);
?>
