<?php
////////////////////////////////////
//TESTING
////////////////////////////////////

function randomOrders()
{    require 'constants.php';
if($loud!='quiet'){echo date("Y-m-d H:i:s");
    $startDate =  time();}
    $ordersCreated = 0;
    $i=0;
    $type='limit';
    $ordersCreated=0; //total created

    //count number of users
    $userCheck = query("SELECT count(id) as number FROM users");
    $numberUsers=$userCheck[0]["number"];
    if($numberUsers<3){apologize("Not enough users for trade. Requires 3.");}

    $symbols =	query("SELECT symbol FROM assets ORDER BY symbol ASC");
    foreach ($symbols as $symbol) { $symbol=$symbol['symbol'];
        //apologize(var_dump(get_defined_vars()));



        //while ($i < 26) {
        $randomOrders=0;
        if($loud!='quiet'){echo("<br><b>[" . $symbol . "] Placing Orders...</b>");}
        while ($randomOrders < 50) //number of orders
        {
            $sideNum = mt_rand(1, 2);
            $percent=mt_rand(95,105);$percent=$percent/100;
            if ($sideNum == 1) {
                $side = 'a';
                //$price = (mt_rand(1, 1000)/100);
                $askPrice =	query("SELECT price FROM orderbook WHERE symbol=? AND side='a' ORDER BY price ASC", $symbol);
                if(empty($askPrice)){$price = mt_rand(1, 400) * $divisor;}
                else{$price=getPrice($askPrice[0]["price"]);$price=$price*$percent;}
            } else {
                $side = 'b';
                //$price = (mt_rand(1, 1000)/100);
                $askPrice =	query("SELECT price FROM orderbook WHERE symbol=? AND side='a' ORDER BY price ASC", $symbol);
                if(empty($askPrice)){$price = mt_rand(1, 400) * $divisor;}
                else{$price=getPrice($askPrice[0]["price"]);$price=$price*$percent;}
            }
            if ($type == 'market') {
                $price = 0;
            }

            $quantity = mt_rand(1, 100);
            $id = mt_rand(2, $numberUsers);


            try {
                placeOrder($symbol, $type, $side, $quantity, $price, $id);
                $total = $quantity * $price;
                if($loud!='quiet'){echo("<br>[ID:" . $id . ", " . $symbol . ", " . $type . ", " . $side . ", $" . $price . ", x" . $quantity . ", Total: $" . $total . "]");}
                $randomOrders++; //should be only 10 per symbol
                $ordersCreated++; //total created
            } //catch exception
            catch (Exception $e) {
                if($loud!='quiet'){echo('<br>Error: [' . $symbol . '] ' . $e->getMessage());}
            }


        }
        $symbol++; //up to 26 (Z)
        $i++; //up to 26
    }
    $endDate =  time();
if($loud!='quiet') {
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate = time();
    $totalTime = $endDate - $startDate;
    if ($totalTime == 0) {
        $speed = $ordersCreated;
    } //so we don't divid by 0.
    else {
        $speed = $ordersCreated / $totalTime;
    }
    echo("<br>Created " . $ordersCreated . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br>");
}
    return($ordersCreated); //number of orders processed
}



function populatetrades()
{ require 'constants.php';
    $date=0;
    while($date<3)
    {
        try {
            $randomOrders = randomOrders();
        } catch (Exception $e) {
            if($loud!='quiet') {echo('Error: ' . $e->getMessage() . '<br>');}
        }         //catch exception
        try {
            $processOrderbook = processOrderbook();
        } catch (Exception $e) {
            if($loud!='quiet') {echo('Error: ' . $e->getMessage() . '<br>');}
        }
        query("UPDATE trades SET date = DATE_SUB(date, INTERVAL 1 DAY)");
        $date++;
    }
}



function createStocks()
{    require 'constants.php';//for $divisor
if($loud!='quiet') {echo("Creating Stocks");
    echo date("Y-m-d H:i:s");
    $startDate =  time();}
    $lastSymbol =	query("SELECT symbol FROM assets ORDER BY symbol DESC LIMIT 0, 1");
    if($lastSymbol==null){$symbol='A';}
    else{$symbol = $lastSymbol[0]["symbol"]; $symbol++;}

if($loud!='quiet') {echo("<br>Symbol: " . $symbol);}
    $i=0;
    while ($i < 7) {
        $name=('The ' . $symbol . ' Co.');
        $userid=mt_rand(2,3);
        $issued = 2 * (mt_rand(1, 100) * 100000);
        $type='stock'; //or commodity
        $fee=(mt_rand(1,100)/100);//0.45;
        $url=('http://www.' . $symbol . '.com');
        $rating=mt_rand(1,10);
        $description=('Makes a lot of ' . $symbol);
        // publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description)
        try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description);
            $quantity = $issued / 2;
            $price = mt_rand(1, 40) * $divisor * ($issued / 2);
            //query("INSERT INTO `portfolio` (`id`, `symbol`, `quantity`, `price`) VALUES (3, ?, ?, ?)", $symbol, $quantity, $price);
            if($loud!='quiet') {echo("<br>Issued-[Symbol:" . $symbol . ", Quantity:" . $quantity . ", Fee:" . $fee . "]<br>");
            echo($publicOffering);}
            $symbol++;
            $i++;
        }
        catch(Exception $e) {echo('<br>Error on Public Stock Offering: ' . $symbol . $e->getMessage());}
    }
if($loud!='quiet') {$endDate = time();
    echo("<br>");
    echo date("Y-m-d H:i:s");
    echo("<br>");
    $endDate = time();
    $totalTime = $endDate - $startDate;
    $speed = $i / $totalTime;
    echo("<br>Issued " . $i . " stocks offerings in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");}
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
    $units = setPrice(100000000);
    query("  UPDATE `accounts` SET `units`=?,`loan`=0,`rate`=0,`approved`=1 WHERE 1", $units);
    query("  UPDATE `accounts` SET `units`=?,`loan`=0,`rate`=0,`approved`=1 WHERE id=1", $units);

    //createStocks();
    publicOffering('PWR', 'Pulwar Group, Inc.', 1, 1000000, 'stock', 0.5, 'http://pulwar.com', 10, 'Each unit represents 1 share of the Pulwar Group.');

    publicOffering('XAU', 'Gold (Au)', 1, 50000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Gold', 10, 'Each unit represents 1 troy ounce of 99.9% fine Gold. Conversion: 1 gram = 0.0321507466 troy ounce; 1 troy ounce = 31.1034768 grams; XAU - Gold Ounce AU');
    publicOffering('XAG', 'Silver (Ag)', 1, 1000000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Silver', 10, 'Each unit represents 1 troy ounce of 99.9% fine Silver. Conversion: 1 gram = 0.0321507466 troy ounce; 1 troy ounce = 31.1034768 grams; XAG - Silver Ounce AG');
    publicOffering('XBT', 'Bitcoin (BTC)', 1, 100000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Bitcoin', 10, 'Each unit represents 1 BTC. Conversion: 0.01 BTC = 1 million Satoshi 1 Satoshi = 0.00000001; XBT - Bitcoin BTC');
    
    // $ Dollar
    //publicOffering('USD', 'Dollar (United States)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Dollar', 10, 'Each unit represents $1 Dollar; USD - U.S. Dollar (United States)');

    // € Euro
    publicOffering('EUR', 'Euro (Euro Member Countries)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Euro', 10, 'Each unit represents €1 Euro; EUR - Euro (Euro Member Countries)');
    
    // £ Pound
    publicOffering('GBP', 'British Pound (United Kingdom)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Pound_(currency)', 10, 'Each unit represents £1 Pound; GBP - British Pound Sterling (United Kingdom)');
    
    // ₹ Rupee
    publicOffering('INR', 'Indian Rupee (India)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Rupee', 10, 'Each unit represents ₹1 Rupee; INR - Indian Rupee (India)');
    
    // ¥ Yuan
    publicOffering('CNY', 'Chinese Yuan Renminbi (China)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Yuan', 10, 'Each unit represents ¥1 Yuan; CNY - Chinese Yuan Renminbi (China)');
    
    // ¥ Yen
    publicOffering('JPY', 'Japanese Yen (Japan)', 1, 1000000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Yen', 10, 'Each unit represents ¥1 Yuan; JPY - Japanese Yen (Japan)');

    //GOLD $1200
    placeOrder('XAU', 'limit', 'b', 1000, 1100, 1);
    placeOrder('XAU', 'limit', 'a', 50000, 1300, 1);
    //SILVER $17
    placeOrder('XAG', 'limit', 'b', 100000, 15, 1);
    placeOrder('XAG', 'limit', 'a', 1000000, 19, 1);
    //BITCOIN $350
    placeOrder('XBT', 'limit', 'b', 10000, 300, 1);
    placeOrder('XBT', 'limit', 'a', 100000, 400, 1);

    placeOrder('EUR', 'limit', 'b', 1000, 1100, 1);
    placeOrder('EUR', 'limit', 'a', 50000, 1300, 1);

    placeOrder('GBP', 'limit', 'b', 1000, 1100, 1);
    placeOrder('GBP', 'limit', 'a', 50000, 1300, 1);

    placeOrder('INR', 'limit', 'b', 100000, 15, 1);
    placeOrder('INR', 'limit', 'a', 1000000, 19, 1);

    placeOrder('CNY', 'limit', 'b', 10000, 300, 1);
    placeOrder('CNY', 'limit', 'a', 100000, 400, 1);

    placeOrder('JPY', 'limit', 'b', 10000, 300, 1);
    placeOrder('JPY', 'limit', 'a', 100000, 400, 1);





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
