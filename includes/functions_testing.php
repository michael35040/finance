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
        while ($randomOrders < 10) //number of orders
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
            $id = mt_rand(1, $numberUsers);


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



//Roman Numerals (1:I, 5:V, 10:X, 50:L, 100:C, 500:D, 1000:M)

function createStocks()
{

$symbol='SAE';
$name='Silver 1ozt Coins U.S. Mint';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='Silver American Eagle';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SCM';
$name='Silver 1ozt Coins Canadian Mint';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='Silver Mapleleaf, Wildlife, Birds of Prey, etc.';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SAM';
$name='Silver 1ozt Coins Austrian Mint';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='Silver Coin Austria Vienna Philharmonic';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SAP';
$name='Silver 1ozt Coins Australia Perth Mint';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='(Kangaroo, Koala, Kookaburra, Lunar etc.)';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SML';
$name='Silver 1ozt Coins Mexican Mint';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='Silver Mexican Libertad';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBB';
$name='Silver 1ozt Coins British Britannia';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SCO';
$name='Silver 1ozt Coins Other';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description='(American The Beautiful, Chinese Panda, Armenia Noahs Ark, New Zealand Kiwi, Somalia Elephant, etc)';
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SAC';
$name='Silver American Constituional Silver Coins 1837-1964 (90% ~.715ozt/$1 face)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBI';
$name='Silver Bullion 1 (99.9% 1ozt)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBV';
$name='Silver Bullion 5 (99.9% 5ozt)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBX';
$name='Silver Bullion 10 (99.9% 10ozt)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBL';
$name='Silver Bullion 50 (99.9% 50ozt)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBC';
$name='Silver Bullion 100 (99.9% 100ozt)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}

$symbol='SBO';
$name='Silver Bullion Other (99.9% Other weight)';
$userid=1;
$issued=1000;
$type='commodity';
$fee=0;
$url='http://www.pulwar.com';
$rating=10;
$description=$name;
try { $publicOffering = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description); }
catch(Exception $e) {echo('<br>Error on Commodity Offering: ' . $symbol . $e->getMessage());}



}



/*
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

*/




function clear_all()
{
    clear_orderbook();
    clear_trades();
    clear_portfolio();
    clear_history();
    clear_assets();
    clear_ledger();
}

function test()
{ 
    require 'constants.php';
    
    clear_all();
    
    $units = setPrice(1000000);
    query("UPDATE `accounts` SET `units`=?,`loan`=0,`rate`=0,`approved`=1 WHERE 1", $units);

    $id=1;
    $userCheck = query("SELECT count(id) as number FROM users");
    $n=$userCheck[0]["number"];

    $referenceID = ($id); //concatenate
    $reference = uniqid($referenceID, true); //unique id reference to trade

    while($id<=$n){
        query("INSERT INTO ledger (
                        type, category,
                        user, symbol, amount, reference,
                        xuser, xsymbol, xamount, xreference,
                        status, note, biduid, askuid)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    'DEPOSIT', 'available',
                    $id, $unittype, $units, $reference,
                    1, $unittype, $units, $reference,
                    0, 'Initial', null, null
                );
    
    $id++;
    }
    
createStocks();
populatetrades();
    
}





/*
    //BITCOIN $350/31
    if($unittype!='XBT')
    {
        publicOffering('XBT', 'Bitcoin', 1, 100000, 'cryptocurrency', 0.5, 'http://en.wikipedia.org/wiki/Bitcoin', 10, 'Each unit represents 1 Bit if Bitcoin (BTC) (100 Satoshi). Conversion: 1 Bit (0.01 BTC) = 1 million Satoshi; 1 BTC = 100 million Satashi; 1 Satoshi = 0.00000001');
        placeOrder('XBT', 'limit', 'b', 1000, 300, 1);
        placeOrder('XBT', 'limit', 'a', 100000, 400, 1);
    }


    // $ Dollar
    if($unittype!='USD')
    {
        publicOffering('USD', 'U.S. Dollar', 1, 100000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Dollar', 10, 'Each unit represents $1 Dollar; USD - U.S. Dollar (United States)');
        placeOrder('USD', 'limit', 'b', 1000, 34, 1);
        placeOrder('USD', 'limit', 'a', 100000, 36, 1);
    }

    //XRP RIPPLE $1.0/1.5
    publicOffering('XRP', 'Ripple', 1, 100000, 'cryptocurrency', 0.5, 'https://ripple.com/', 10, 'Each unit represents 1 Ripple.');
    placeOrder('XRP', 'limit', 'b', 1000, 300, 1);
    placeOrder('XRP', 'limit', 'a', 100000, 400, 1);

    //XST STELLAR $1.25/1.75
    publicOffering('XST', 'Stellar', 1, 100000, 'cryptocurrency', 0.5, 'https://www.stellar.org/', 10, 'Each unit represents 1 Stellar');
    placeOrder('XST', 'limit', 'b', 1000, 300, 1);
    placeOrder('XST', 'limit', 'a', 100000, 400, 1);

    //GOLD $1200/1300
    publicOffering('XAU', 'Gold', 1, 10000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Gold', 10, 'Each unit represents 1 gram of 99.9% fine Gold (Au). Conversion: 1 gram = 0.0321507466 troy ounce; 1 troy ounce = 31.1034768 grams');
    placeOrder('XAU', 'limit', 'b', 1000, 14, 1);
    placeOrder('XAU', 'limit', 'a', 10000, 15, 1);

    //SILVER $17/31
    publicOffering('XAG', 'Silver', 1, 100000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Silver', 10, 'Each unit represents 1 gram of 99.9% fine Silver (Ag). Conversion: 1 gram = 0.0321507466 troy ounce; 1 troy ounce = 31.1034768 grams');
    placeOrder('XAG', 'limit', 'b', 1000, 15, 1);
    placeOrder('XAG', 'limit', 'a', 100000, 19, 1);

    //COPPER $4/31
    publicOffering('XCU', 'Copper', 1, 1000000, 'commodity', 0.5, 'http://en.wikipedia.org/wiki/Copper', 10, 'Each unit represents 1 gram of 99.9% fine Copper (Cu). Conversion: 1 gram = 0.0321507466 troy ounce; 1 troy ounce = 31.1034768 grams');
    placeOrder('XCU', 'limit', 'b', 1000, 3, 1);
    placeOrder('XCU', 'limit', 'a', 1000000, 4, 1);

    // € Euro
    publicOffering('EUR', 'Euro', 1, 100000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Euro', 10, 'Each unit represents &euro; 1 Euro. EUR - Euro (Euro Member Countries)');
    placeOrder('EUR', 'limit', 'b', 1000, 60, 1);
    placeOrder('EUR', 'limit', 'a', 100000, 65, 1);

    // £ Pound
    publicOffering('GBP', 'British Pound', 1, 20000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Pound_(currency)', 10, 'Each unit represents &pound; 1 Pound. GBP - British Pound Sterling (United Kingdom)');
    placeOrder('GBP', 'limit', 'b', 1000, 10, 1);
    placeOrder('GBP', 'limit', 'a', 20000, 13, 1);

    // ₹ Rupee
    publicOffering('INR', 'Indian Rupee', 1, 50000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Rupee', 10, 'Each unit represents &#x20B9; 1 Rupee. INR - Indian Rupee (India)');
    placeOrder('INR', 'limit', 'b', 1000, 1.5, 1);
    placeOrder('INR', 'limit', 'a', 50000, 1.9, 1);

    // ¥ Yuan
    publicOffering('CNY', 'Chinese Yuan Renminbi', 1, 5000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Yuan', 10, 'Each unit represents &yen; 1 Yuan. CNY - Chinese Yuan Renminbi (China)');
    placeOrder('CNY', 'limit', 'b', 1000, 25, 1);
    placeOrder('CNY', 'limit', 'a', 5000, 30, 1);

    // ¥ Yen
    publicOffering('JPY', 'Japanese Yen', 1, 10000, 'currency', 0.5, 'http://en.wikipedia.org/wiki/Yen', 10, 'Each unit represents &yen; 1 Yen. JPY - Japanese Yen (Japan)');
    placeOrder('JPY', 'limit', 'b', 1000, 0.3, 1);
    placeOrder('JPY', 'limit', 'a', 10000, 0.4, 1);

    //PULWAR $35/31
    publicOffering('PWR', 'Pulwar Group, Inc.', 1, 1000000, 'stock', 0.5, 'http://pulwar.com', 10, 'Each unit represents 1 share of the Pulwar Group.');
    placeOrder('PWR', 'limit', 'b', 1000, 11, 1);
    placeOrder('PWR', 'limit', 'a', 1000000, 13, 1);

    //try {processOrderbook();}
    //catch exception
    //catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
*/

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

function clear_ledger()
{
    if (query("TRUNCATE TABLE `ledger`") === false)
    {echo("<br>Database ledger Failure");}
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
