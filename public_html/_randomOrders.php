<?php require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

echo date("Y-m-d H:i:s");
$startDate =  time();
$randomOrders = randomOrders();
$endDate =  time();
echo("<br>");
echo date("Y-m-d H:i:s");
echo("<br>");
$endDate =  time();
$totalTime = $endDate-$startDate;
$speed=$randomOrders/$totalTime;
echo("Created " . $randomOrders . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec");


?>