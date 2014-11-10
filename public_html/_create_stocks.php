
<?php

require("../includes/config.php");

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

//apologize(var_dump(get_defined_vars()));
//function testExchange(){}


    echo date("Y-m-d H:i:s");
    $startDate =  time();
    $createStocks = createStocks();
    $endDate =  time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate =  time();
    $totalTime = $endDate-$startDate;
    $speed=$createStocks/$totalTime;
    echo("Created " . $createStocks . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");

    echo date("Y-m-d H:i:s");
    $startDate =  time();
    //$randomOrders = createStocks();
    try {$randomOrders = randomOrders();}
    catch(Exception $e) {echo('Message: [' . $symbol . '] ' . $e->getMessage() . '<br>');}         //catch exception
    $endDate =  time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate =  time();
    $totalTime = $endDate-$startDate;
    $speed=$randomOrders/$totalTime;
    echo("Created " . $randomOrders . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");

    echo date("Y-m-d H:i:s");
    $startDate =  time();
    //$randomOrders = createStocks();
    try {$processOrderbook = processOrderbook();}
    catch(Exception $e) {echo('Message: [' . $symbol . '] ' . $e->getMessage() . '<br>');}         //catch exception
    $endDate =  time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate =  time();
    $totalTime = $endDate-$startDate;
    $speed=$processOrderbook/$totalTime;
    echo("Created " . $processOrderbook . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");


?>
