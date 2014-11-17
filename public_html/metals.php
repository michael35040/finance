<?php
//https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/ag/

$url = 'https://svc.cloudhost365.com/SharedServices/api/market/spotprices/USD/au/';

$xml = new SimpleXMLElement(file_get_contents($url));

// pre tags to format nicely
echo '<pre>';
print_r($xml);
echo '</pre>';

?>
