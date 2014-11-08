<?php

////////////////////////////////////
////////////////////////////////////
//TESTING
////////////////////////////////////
/////////////////////////////////////

function testNumbers()
{   $i=0;
    while ($i<100){
        $bid = ((mt_rand(0,1) * (40 + $i) ) + 100 + $i + mt_rand(1,50));
        $ask = ((mt_rand(0,1) * (40 + $i) ) + 100 + $i + mt_rand(75,100));
        echo($ask);
        echo($bid);
    }
}

function randomOrders($symbol='A', $number=10, $type='limit')
{
    include("constants.php");//for $divisor
    //$divisor=0.25;
    $randomOrders = 0;
    while ($randomOrders < $number) {
        $randomOrders++;
        $id = mt_rand(2, 3);
        $sideNum = mt_rand(1, 2);
        $quantity = mt_rand(1, 50);
        if ($sideNum == 1) {
            $side = 'a';
            $price = mt_rand(8, 40)*$divisor;
        } else {
            $side = 'b';
            $price = mt_rand(1, 36)*$divisor;
        }
        if ($type == 'market') {
            $price = 0;
        }
        placeOrder($symbol, $type, $side, $quantity, $price, $id);
    }
    return $randomOrders;
}

function clear_all()
{
    clear_orderbook();
    clear_trades();
    clear_portfolio();
    clear_history();
    clear_assets();
    query("  UPDATE `accounts` SET `units`=1000000,`loan`=0,`rate`=0,`approved`=1 WHERE 1");
    query("  INSERT INTO `assets` (`symbol`, `name`, `issued`, `type`, `fee`, `owner`, `url`, `rating`, `description`)
             VALUES ('A', 'aaa', 3000000, 'stock', '0.500000000000000000000000000000', '', '', 1, '')");
    query("INSERT INTO `portfolio` (`uid`, `id`, `symbol`, `quantity`, `price`)
            VALUES  (1, 1, 'A', 1000000, '0.000000000000000000000000000000'),
                    (2, 2, 'A', 1000000, '0.000000000000000000000000000000'),
                    (3, 3, 'A', 1000000, '0.000000000000000000000000000000')");
}

function clear_orderbook()
{
    if (query("TRUNCATE TABLE `orderbook`") === false)
    {echo("Database orderbook Failure");}
}

function clear_assets()
{
    if (query("TRUNCATE TABLE `assets`") === false)
    {echo("Database orderbook Failure");}
}

function clear_trades()
{
    if (query("TRUNCATE TABLE `trades`") === false)
        if (query("TRUNCATE TABLE `trades`") === false)
        {echo("Database trades Failure");}
}

function clear_portfolio()
{
    if (query("TRUNCATE TABLE `portfolio`") === false)
    {echo("Database portfolio Failure");}
}

function clear_history()
{
    if (query("TRUNCATE TABLE `history`") === false)
    {echo("Database history Failure");}
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


?>
