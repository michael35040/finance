<?php
////////////////////////////////////
//TESTING
////////////////////////////////////

function randomOrders()
{    include("constants.php");//for $divisor
    echo date("Y-m-d H:i:s");
    $startDate =  time();
    $ordersCreated = 0;
    $i=0;
    $type='limit';
    $ordersCreated=0; //total created

    //count number of users
    $userCheck = query("SELECT count(id) as number FROM users");
    $numberUsers=$userCheck[0]["number"];

    $symbols =	query("SELECT symbol FROM assets ORDER BY symbol ASC");
    foreach ($symbols as $symbol) { $symbol=$symbol['symbol'];
        //apologize(var_dump(get_defined_vars()));



        //while ($i < 26) {
        $randomOrders=0;
        echo("<br><b>[" . $symbol . "] Placing Orders...</b>");
        while ($randomOrders < 50) //number of orders
        {
            $sideNum = mt_rand(1, 2);
            if ($sideNum == 1) {
                $side = 'a';
                //$price = (mt_rand(1, 1000)/100);
                $price = mt_rand(1, 400) * $divisor;
            } else {
                $side = 'b';
                //$price = (mt_rand(1, 1000)/100);
                $price = mt_rand(1, 400) * $divisor;
            }
            if ($type == 'market') {
                $price = 0;
            }

            $quantity = mt_rand(1, 100);
            $id = mt_rand(1, $numberUsers);


            try {
                placeOrder($symbol, $type, $side, $quantity, $price, $id);
                $total = $quantity * $price;
                echo("<br>[ID:" . $id . ", " . $symbol . ", " . $type . ", " . $side . ", $" . $price . ", x" . $quantity . ", Total: $" . $total . "]");
                $randomOrders++; //should be only 10 per symbol
                $ordersCreated++; //total created
            } //catch exception
            catch (Exception $e) {
                echo('<br>Error: [' . $symbol . '] ' . $e->getMessage());
            }


        }
        $symbol++; //up to 26 (Z)
        $i++; //up to 26
    }
    $endDate =  time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate =  time();
    $totalTime = $endDate-$startDate;
    if($totalTime==0){$speed=$ordersCreated;} //so we don't divid by 0.
    else{$speed=$ordersCreated/$totalTime;}
    echo("<br>Created " . $ordersCreated . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br>");

    return($ordersCreated); //number of orders processed
}



function populatetrades()
{
    $date=0;
    while($date<3)
    {
        try {
            $randomOrders = randomOrders();
        } catch (Exception $e) {
            echo('Error: ' . $e->getMessage() . '<br>');
        }         //catch exception
        try {
            $processOrderbook = processOrderbook();
        } catch (Exception $e) {
            echo('Error: ' . $e->getMessage() . '<br>');
        }
        query("UPDATE trades SET date = DATE_SUB(date, INTERVAL 2 DAY)");
        $date++;
    }
}

function createStocks()
{    include("constants.php");//for $divisor
    echo("Creating Stocks");
    echo date("Y-m-d H:i:s");
    $startDate =  time();
    $lastSymbol =	query("SELECT symbol FROM assets ORDER BY symbol DESC LIMIT 0, 1");
    if($lastSymbol==null){$symbol='A';}
    else{$symbol = $lastSymbol[0]["symbol"]; $symbol++;}

    echo("<br>Symbol: " . $symbol);
    $i=0;
    while ($i < 7) {
        $name=('The ' . $symbol . ' Co.');
        $userid=mt_rand(1,3);
        $issued = 2 * (mt_rand(1, 100) * 100000);
        $type='stocks';
        $fee=(mt_rand(1,100)/100);//0.45;
        $url=('http://www.' . $symbol . '.com');
        $rating=mt_rand(1,10);
        $description=('Makes a lot of ' . $symbol);
        // publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description)
        try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description);
            $quantity = $issued / 2;
            $price = mt_rand(1, 40) * $divisor * ($issued / 2);
            //query("INSERT INTO `portfolio` (`id`, `symbol`, `quantity`, `price`) VALUES (3, ?, ?, ?)", $symbol, $quantity, $price);
            echo("<br>Issued-[Symbol:" . $symbol . ", Quantity:" . $quantity . ", Fee:" . $fee . "]<br>");
            echo($publicOffering);
            $symbol++;
            $i++;
        }
        catch(Exception $e) {echo('<br>Error on Public Stock Offering: ' . $symbol . $e->getMessage());}
    }
    $endDate = time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate = time();
    $totalTime = $endDate - $startDate;
    $speed = $i / $totalTime;
    echo("<br>Issued " . $i . " stocks offerings in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");
    return ($i);

}




function clear_all()
{
    clear_orderbook();
    clear_trades();
    clear_portfolio();
    clear_history();
    clear_assets();
    query("  UPDATE `accounts` SET `units`=0,`loan`=0,`rate`=0,`approved`=1 WHERE 1");


    //try {processOrderbook();}
    //catch exception
    //catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

}

function test()
{
    clear_orderbook();
    clear_trades();
    clear_portfolio();
    clear_history();
    clear_assets();
    query("  UPDATE `accounts` SET `units`=1000000,`loan`=0,`rate`=0,`approved`=1 WHERE 1");

    createStocks();


    //try {processOrderbook();}
    //catch exception
    //catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

}

function clear_orderbook()
{
    if (query("TRUNCATE TABLE `orderbook`") === false)
    {echo("Database orderbook Failure");}
}

function clear_assets()
{
    if (query("TRUNCATE TABLE `assets`") === false)
    {echo("<br>Database orderbook Failure");}
}

function clear_trades()
{
    if (query("TRUNCATE TABLE `trades`") === false)
        if (query("TRUNCATE TABLE `trades`") === false)
        {echo("<br>Database trades Failure");}
}

function clear_portfolio()
{
    if (query("TRUNCATE TABLE `portfolio`") === false)
    {echo("<br>Database portfolio Failure");}
}

function clear_history()
{
    if (query("TRUNCATE TABLE `history`") === false)
    {echo("<br>Database history Failure");}
}

function billionaire() //everyone is a billionaire! $$$ //for testing only
{
    query("SET AUTOCOMMIT=0");
    query("SET AUTOCOMMIT=1");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

    //USER UNITS
    if (query("UPDATE `accounts` SET `units`=1000000000,`locked`=1000000000,`loan`=0 WHERE 1") === false)
    {
        query("ROLLBACK;"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        echo("Database Failure #U1.");
    }

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
}

//used for stock charts for realistic stock lines
function randomStocks()
{
    $prefix = '';
    echo("[\n");
    for ($i = 0; $i < 1000; $i++)
    {
        $date = new DateTime();
        $date = $date->getTimestamp();
        $date *= 1000;//convert to unix then to milliseconds IOT pass to Javascript
        $date -= ($i *1000 * 60 * 5);
        $a = ((rand(0,1) * (40 + $i) ) + 100 + $i);
        $b = (rand(1, 10000));
        echo $prefix . " {\n";
        echo '  "date": "' . $date . '",' . "\n";
        echo '  "price": ' . $a . ',' . "\n";
        echo '  "size": ' . $b . '' . "\n";
        echo " }";
        $prefix = ",\n";
    }
    echo "\n]";

}
function testNumbers()
{   $i=0;
    while ($i<100){
        $bid = ((mt_rand(0,1) * (40 + $i) ) + 100 + $i + mt_rand(1,50));
        $ask = ((mt_rand(0,1) * (40 + $i) ) + 100 + $i + mt_rand(75,100));
        echo($ask);
        echo($bid);
    }
}


?>
