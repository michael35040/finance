<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["symbol"])) { apologize("Please select a symbol!"); } //check to see if empty
    $symbol = $_POST["symbol"];
    $symbol = sanatize("symbol", $symbol);

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
        $usersPortfolio =query("SELECT SUM(`quantity`) AS quantity FROM `portfolio` WHERE (symbol=? AND id=?)", $symbol, $id);	  // query user's portfolio
$asset["userportfolio"]=$usersPortfolio[0]["quantity"];
        
        //ALL OWNERSHIP FOR PIECHART
$ownership =query("SELECT SUM(`quantity`) AS quantity, id FROM `portfolio` WHERE (symbol = ?) GROUP BY `id` ORDER BY `quantity` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
        
//ORDERBOOK        
        
        //USERS ORDERBOOK
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a')", $id, $symbol);	  // query user's portfolio
        if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
$asset["userlocked"] = $askQuantity;

        //ORDERS
$bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 5", $symbol, 'b');
$asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 5", $symbol, 'a');


if(isset($asks[0]["price"])) {$asksPrice=getPrice($asks[0]["price"]);}else{$asksPrice=0;}
if(isset($bids[0]["price"])) {$bidsPrice=getPrice($bids[0]["price"]);}else{$bidsPrice=0;}
if(isset($trades[0]["price"])) {$tradesPrice=getPrice($trades[0]["price"]);}else{$tradesPrice=0;}        


        //ORDERS COMBINED FOR TABLE AND FOR CHARTS (COMBINED PRICE)
        $asksGroup =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit') GROUP BY `price` ORDER BY `price` ASC  LIMIT 0, 5", $symbol);	  // query user's portfolio
        $bidsGroup =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit') GROUP BY `price` ORDER BY `price` DESC  LIMIT 0, 5", $symbol);	  // query user's portfolio

        //ORDERS COMBINED FOR TABLE AND FOR CHARTS (COMBINED PRICE) BID ASK WALL
        $asksGroupAll =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit') GROUP BY `price` ORDER BY `price` ASC", $symbol);	  // query user's portfolio
        $bidsGroupAll =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit') GROUP BY `price` ORDER BY `price` DESC", $symbol);	  // query user's portfolio

        //TOTAL AMOUNT OF BIDS/ASKS IN ORDERBOOK
        $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE (symbol = ? AND side ='b' AND type = 'limit')", $symbol);	  // query user's portfolio
        $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE (symbol = ? AND side ='a' AND type = 'limit')", $symbol);	  // query user's portfolio
$asset["bidstotal"] = $bidsTotal[0]['bidtotal'];
$asset["askstotal"] = $asksTotal[0]['asktotal'];
        //if ($bidsTotal == 0){$bidsTotal = "No Orders";}
        //if ($asksTotal == 0){$asksTotal = "No Orders";}

        //TOTAL SHARES PUBLIC (ON ORDERBOOK + ON PORTFOLIO)
$asset["public"] = $asset["askstotal"]+$asset["totalportfolio"];

//TRADES
        //30day volume
        $volume =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY MONTH(date) ORDER BY uid ASC LIMIT 0, 500", $symbol);	  // query user's portfolio
        //$volume =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY MONTH(date) ORDER BY uid ASC LIMIT 0, 500", $symbol);	  // query user's portfolio
        if(empty($volume[0]["quantity"])){$volume[0]["quantity"]=0;}
        if(empty($volume[0]["price"])){$volume[0]["price"]=0;}
$asset["volume"] = $volume[0]["quantity"];
$asset["avgprice"] = getPrice($volume[0]["price"]);
        //TRADES (PROCESSED ORDERS)
$trades =  query("SELECT * FROM trades WHERE (symbol=? AND (type='limit' OR type='market')) ORDER BY uid DESC", $symbol);
        if(empty($trades[0]["price"])){$trades[0]["price"]=0;}
$asset["price"] = getPrice($trades[0]["price"]); //stock price per share
$asset["marketcap"] = ($asset["price"] * $asset["issued"]);
        //$dividend =	query("SELECT SUM(quantity) AS quantity FROM history WHERE type = 'dividend' AND symbol = ?", $asset["symbol"]);	  // query user's portfolio
        //$asset["dividend"] = $dividend["dividend"]; //shares actually held public
$asset["dividend"]=0; //until we get real ones
        
        //DAILY TRADES CHART
$tradesGroup =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE (symbol=? AND (type='limit' OR type='market'))  GROUP BY DAY(date) ORDER BY uid ASC ", $symbol);	  // query user's portfolio
        //ALL TRADES CHART


         //USERS CONTROL
        if($asset["public"]==0){$asset["control"]=0;} //can also use 'issued' for this and the one below as they should in theory be the same
        else{$asset["control"] = (($asset["userportfolio"]+$asset["userlocked"])/$asset["public"])*100; } //based on public
       










        //WORKING SQL QUERY FOR CHARTING DAILY TRADES
        render("information_form.php", [
            "title" => "Information",
            "symbol" => $symbol,
            "asset" => $asset,
            "ownership" => $ownership,
            "bids" => $bids,
            "asks" => $asks,
            "asksPrice" => $asksPrice,  
            "bidsPrice"  => $bidsPrice, 
            "tradesPrice"  => $tradesPrice,
            "asksGroup" => $asksGroup,
            "bidsGroup" => $bidsGroup,
            "asksGroupAll" => $asksGroupAll,
            "bidsGroupAll" => $bidsGroupAll,
            "trades" => $trades,
            "tradesGroup" => $tradesGroup,
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
            $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE id=? AND symbol =? AND side='a'", $id, $row["symbol"]);	  // query user's portfolio
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
