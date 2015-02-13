<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["symbol"])) { apologize("Please select a symbol!"); } //check to see if empty
    $symbol = $_POST["symbol"];
    $symbol = sanatize("alnum", $symbol);

    //COMPANY INFORMATION
    $asset=[];
    $asset =	query("SELECT * FROM assets WHERE symbol=?", $symbol);
    if(!empty($asset))
    {
        $asset = $asset[0];
//PORTFOLIO
        //TOTAL SHARES PUBLIC MINUS ORDERBOOK
        $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $asset["totalportfolio"] = $public[0]["quantity"]; //shares held

        //USERS OWNERSHIP
        $usersPortfolio =query("SELECT SUM(`quantity`) AS quantity, price FROM `portfolio` WHERE (symbol=? AND id=?)", $symbol, $id);	  // query user's portfolio
        if(empty($usersPortfolio[0]["price"])){$usersPortfolio[0]["price"]=0;}
        $asset["userportfolio"]=$usersPortfolio[0]["quantity"];
        if(empty($usersPortfolio[0]["price"])){$usersPortfolio[0]["price"]=0;}
        $asset["purchaseprice"] = getPrice($usersPortfolio[0]["price"]); //price paid

        //ALL OWNERSHIP FOR PIECHART
        $ownership2 = ownership($symbol);
        
        //ORDERBOOK
        //USERS ORDERBOOK
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a' AND status=1)", $id, $symbol);	  // query user's portfolio
        if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
$asset["userlocked"] = $askQuantity;

        //ORDERS
$bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND status=1) ORDER BY price DESC, uid ASC LIMIT 0, 5", $symbol, 'b');
$asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND status=1) ORDER BY price ASC, uid ASC LIMIT 0, 5", $symbol, 'a');
$lastorders =	query("SELECT * FROM orderbook WHERE (symbol = ?) ORDER BY uid DESC LIMIT 0, 5", $symbol);


if(isset($asks[0]["price"])) {$asksPrice=getPrice($asks[0]["price"]);}else{$asksPrice=0;}
if(isset($bids[0]["price"])) {$bidsPrice=getPrice($bids[0]["price"]);}else{$bidsPrice=0;}

        //ORDERS COMBINED FOR TABLE AND FOR CHARTS (COMBINED PRICE)
        $asksGroup =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit' AND status=1) GROUP BY `price` ORDER BY `price` ASC  LIMIT 0, 5", $symbol);	  // query user's portfolio
        $bidsGroup =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit' AND status=1) GROUP BY `price` ORDER BY `price` DESC  LIMIT 0, 5", $symbol);	  // query user's portfolio

        //ORDERS COMBINED FOR TABLE AND FOR CHARTS (COMBINED PRICE) BID ASK WALL
        $asksGroupAll =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit' AND status=1) GROUP BY `price` ORDER BY `price` ASC", $symbol);	  // query user's portfolio
        $bidsGroupAll =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit' AND status=1) GROUP BY `price` ORDER BY `price` DESC", $symbol);	  // query user's portfolio

        //TOTAL AMOUNT OF BIDS/ASKS IN ORDERBOOK
        $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit' AND status=1)", $symbol);	  // query user's portfolio
        $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit' AND status=1)", $symbol);	  // query user's portfolio
$asset["bidstotal"] = $bidsTotal[0]['bidtotal'];
$asset["askstotal"] = $asksTotal[0]['asktotal'];
        //if ($bidsTotal == 0){$bidsTotal = "No Orders";}
        //if ($asksTotal == 0){$asksTotal = "No Orders";}

        //TOTAL SHARES PUBLIC (ON ORDERBOOK + ON PORTFOLIO)
$asset["public"] = $asset["askstotal"]+$asset["totalportfolio"]; //asktotal will not show market ask orders, might cause issues...

//TRADES
        $timeframe = '7d';
        $tradesTime = query("SELECT COUNT(uid) AS count, AVG(price) AS price, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (symbol=?) AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())", $asset["symbol"]); // query database for user
        if(empty($tradesTime[0]["volume"])){$tradesTime[0]["volume"]=0;}
        if(empty($tradesTime[0]["price"])){$tradesTime[0]["price"]=0;}
        $asset["avgprice"] = getPrice($tradesTime[0]["price"]);
        $asset["volume"] = $tradesTime[0]["volume"];




        //TRADES (PROCESSED ORDERS)
$trades =  query("SELECT * FROM trades WHERE (symbol=? AND (type='limit' OR type='market')) ORDER BY uid DESC LIMIT 0,100", $symbol);
        //if(empty($trades[0]["price"])){$trades[0]["price"]=0;}
        if(isset($trades[0]["price"])) 
            {$asset["price"] = getPrice($trades[0]["price"]); //stock price per share
            }else{$asset["price"]=0;}        

$asset["marketcap"] = ($asset["price"] * $asset["issued"]);
        //$dividend =	query("SELECT SUM(quantity) AS quantity FROM history WHERE type = 'dividend' AND symbol = ?", $asset["symbol"]);	  // query user's portfolio
        //$asset["dividend"] = $dividend["dividend"]; //shares actually held public
$asset["dividend"]=0; //until we get real ones
        
        //DAILY TRADES CHART
        $tradesGroup =      query("SELECT SUM(quantity) AS volume, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol =?) GROUP BY DAY(date) ORDER BY date DESC LIMIT 0,7", $symbol);      // query user's portfolio
//$tradesGroup =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE (symbol=? AND (type='limit' OR type='market'))  GROUP BY DAY(date) ORDER BY uid ASC LIMIT 0,30", $symbol);	  // query user's portfolio
        //ALL TRADES CHART


         //USERS CONTROL
        if($asset["public"]==0){$asset["control"]=0;} //can also use 'issued' for this and the one below as they should in theory be the same
        else{$asset["control"] = (($asset["userportfolio"]+$asset["userlocked"])/$asset["public"])*100; } //based on public
       




        /*********************VOLUME*****************************/
//TOTAL
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (symbol=? AND status=1)", $symbol); // query database for user
        $dash["orderstotal"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=?", $symbol); // query database for user
        $dash["tradestotal"] = $count[0]["total"];
        $dash["valuetotal"] = getPrice($count[0]["value"]);
        $dash["volumetotal"] = $count[0]["volume"];

//MONTH
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE  symbol=? AND status=1 AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())", $symbol); // query database for user
        $dash["ordersmonth"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())", $symbol); // query database for user
        $dash["tradesmonth"] = $count[0]["total"];
        $dash["valuemonth"] = getPrice($count[0]["value"]);
        $dash["volumemonth"] = $count[0]["volume"];

//WEEK
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())", $symbol); // query database for user
        $dash["ordersweek"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())", $symbol); // query database for user
        $dash["tradesweek"] = $count[0]["total"];
        $dash["valueweek"] = getPrice($count[0]["value"]);
        $dash["volumeweek"] = $count[0]["volume"];

//D7
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 168 HOUR)", $symbol);
        $dash["ordersday7"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 168 HOUR)", $symbol);
        $dash["tradesday7"] = $count[0]["total"];
        $dash["valueday7"] = getPrice($count[0]["value"]);
        $dash["volumeday7"] = $count[0]["volume"];


//D6
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 144 HOUR)", $symbol);
        $dash["ordersday6"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 144 HOUR)", $symbol);
        $dash["tradesday6"] = $count[0]["total"];
        $dash["valueday6"] = getPrice($count[0]["value"]);
        $dash["volumeday6"] = $count[0]["volume"];


//D5
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 120 HOUR)", $symbol);
        $dash["ordersday5"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 120 HOUR)", $symbol);
        $dash["tradesday5"] = $count[0]["total"];
        $dash["valueday5"] = getPrice($count[0]["value"]);
        $dash["volumeday5"] = $count[0]["volume"];

//D4
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 96 HOUR)", $symbol);
        $dash["ordersday4"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 96 HOUR)", $symbol);
        $dash["tradesday4"] = $count[0]["total"];
        $dash["valueday4"] = getPrice($count[0]["value"]);
        $dash["volumeday4"] = $count[0]["volume"];

//D3
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 72 HOUR)", $symbol);
        $dash["ordersday3"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 72 HOUR)", $symbol);
        $dash["tradesday3"] = $count[0]["total"];
        $dash["valueday3"] = getPrice($count[0]["value"]);
        $dash["volumeday3"] = $count[0]["volume"];

//YESTERDAY D2
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND `date` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 48 HOUR)", $symbol);
        $dash["ordersday2"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND `date` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 48 HOUR)", $symbol);
        $dash["tradesday2"] = $count[0]["total"];
        $dash["valueday2"] = getPrice($count[0]["value"]);
        $dash["volumeday2"] = $count[0]["volume"];


//TODAY D1
        $count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE symbol=? AND status=1  AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())", $symbol); // query database for user
        $dash["ordersday1"] = $count[0]["total"];
        $count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE symbol=? AND (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())", $symbol); // query database for user
        $dash["tradesday1"] = $count[0]["total"];
        $dash["valueday1"] = getPrice($count[0]["value"]);
        $dash["volumeday1"] = $count[0]["volume"];








        //WORKING SQL QUERY FOR CHARTING DAILY TRADES
        render("information_form.php", [
            "title" => "Information",
            "symbol" => $symbol,
            "asset" => $asset,
            "timeframe" => $timeframe,
            "ownership2" => $ownership2,
            "bids" => $bids,
            "asks" => $asks,
            "lastorders" => $lastorders,
            "asksPrice" => $asksPrice,  
            "bidsPrice"  => $bidsPrice, 
            "asksGroup" => $asksGroup,
            "bidsGroup" => $bidsGroup,
            "asksGroupAll" => $asksGroupAll,
            "bidsGroupAll" => $bidsGroupAll,
            "trades" => $trades,
            "tradesGroup" => $tradesGroup,
            "dash" => $dash,
            ]);
    } //!empty
    else
    {apologize("Invalid Symbol!");}
} // else render quote_form
else
{
    $allStocks =	query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $stocks = [];
    foreach ($allStocks as $row)		// for each of user's stocks
    {
        $stock = [];
        $stock["symbol"] = $row["symbol"];
        $stock["quantity"] = $row["quantity"];
            $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE id=? AND symbol =? AND status=1  AND side='a'", $id, $row["symbol"]);	  // query user's portfolio
            if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $stock["locked"] = $askQuantity[0]["quantity"]; //shares trading


        $stocks[] = $stock;
    }

    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    //$stocks = $infos;
    //apologize(var_dump(get_defined_vars()));
    render("information_symbol_form.php", ["title" => "Symbol", "stocks" => $stocks, "assets" => $assets]);
}







?>
