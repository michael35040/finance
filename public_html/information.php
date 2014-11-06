<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["symbol"])) { apologize("Please fill all required fields (Symbol)."); } //check to see if empty
    $symbol = $_POST["symbol"];
    if (!ctype_alnum($symbol)) {apologize("Invalid Symbol");}
    $symbol = strtoupper($symbol); //cast to UpperCase


    //COMPANY INFORMATION
    $asset=[];
    $asset =	query("SELECT * FROM assets WHERE symbol=?", $symbol);
    $asset = $asset[0];
        $public =	query("SELECT SUM(quantity) AS quantity,  SUM(locked) AS locked FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        if(empty($public[0]["locked"])){$public[0]["locked"]=0;}
        $publicLocked = $public[0]["locked"];
        $publicQuantity = $public[0]["quantity"];
    $asset["public"] = $publicLocked+$publicQuantity; //shares actually held public
    $volume =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY MONTH(date) ORDER BY uid ASC LIMIT 0, 500", $symbol);	  // query user's portfolio
        if(empty($volume[0]["quantity"])){$volume[0]["quantity"]=0;}
        if(empty($volume[0]["price"])){$volume[0]["price"]=0;}
    $asset["volume"] = $volume[0]["quantity"];
    $asset["avgprice"] = $volume[0]["price"];
    $trades =	    query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $symbol);	  // query user's portfolio
        if(empty($trades[0]["price"])){$trades[0]["price"]=0;}
        $asset["price"] = $trades[0]["price"]; //stock price per share
    $asset["marketcap"] = ($asset["price"] * $asset["issued"]);

    //apologize(var_dump(get_defined_vars()));

    //EXCHANGE TRADES (PROCESSED ORDERS)
        //$trades =       query("SELECT (SUM(quantity)/1000) AS quantity, price, date FROM trades WHERE symbol=? GROUP BY DAY(date) ORDER BY date ASC ", $symbol);
        //$tradesGroup =	    query("SELECT * FROM trades WHERE symbol = ? GROUP BY DAY(date) ORDER BY uid DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
        $trades =  query("SELECT * FROM trades WHERE symbol=? ORDER BY uid DESC LIMIT 0, 5", $symbol);
    //if (count($trades) < 1){apologize("Incorrect symbol!");} //check to see if exists in db

        //EXCHANGE ORDERS
        $bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 5", $symbol, 'b');
        $asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 5", $symbol, 'a');
        //EXCHANGE ORDERS (COMBINED PRICE)


        $tradesGroupChart =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY DAY(date) ORDER BY uid ASC ", $symbol);	  // query user's portfolio
        $tradesChart =  query("SELECT quantity, price, date FROM trades WHERE symbol=? ORDER BY uid ASC", $symbol);


        $asksGroupChart =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a') GROUP BY `price` ORDER BY `price` ASC  LIMIT 0, 5", $symbol);	  // query user's portfolio
        $bidsGroupChart =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b') GROUP BY `price` ORDER BY `price` DESC  LIMIT 0, 5", $symbol);	  // query user's portfolio
        $bidsGroupChart = array_reverse($bidsGroupChart); //so it will be in correct ASC order for chart

        $bidsGroup =	    query("SELECT price, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (symbol = ? AND side ='b') GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
        $asksGroup =	    query("SELECT price, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (symbol = ? AND side ='a') GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5", $symbol);	  // query user's portfolio

        //$asksGroup = query("select concat(1*floor(price/1), '-', 1*floor(price/1) + 1) as `price`,     sum(`quantity`) as `quantity` from orderbook WHERE (symbol = ? AND side ='a') group by 1 order by `price`", $symbol);

        //TOTAL AMOUNT OF BIDS/ASKS IN ORDERBOOK
        $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE (symbol = ? AND side ='b')", $symbol);	  // query user's portfolio
        $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE (symbol = ? AND side ='a')", $symbol);	  // query user's portfolio
        @$bidsTotal = $bidsTotal[0]['bidtotal'];
        @$asksTotal = $asksTotal[0]['asktotal'];
        if ($bidsTotal == 0){$bidsTotal = "No Orders";}
        if ($asksTotal == 0){$asksTotal = "No Orders";}

        //WORKING SQL QUERY FOR CHARTING DAILY TRADES
        render("information_form.php", [
            "title" => "Information",

            "asset" => $asset,


            "trades" => $trades,
            //"tradesGroup" => $tradesGroup,

            "tradesChart" => $tradesChart,
            "tradesGroupChart" => $tradesGroupChart,

            "bidsGroupChart" => $bidsGroupChart,
            "asksGroupChart" => $asksGroupChart,

            "symbol" => $symbol,
            "bids" => $bids,
            "asks" => $asks,

            "bidsGroup" => $bidsGroup,
            "asksGroup" => $asksGroup,

            "bidsTotal" => $bidsTotal,
            "asksTotal" => $asksTotal

            ]);

} // else render quote_form
else
{
    $stocks =	query("SELECT * FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    render("information_symbol_form.php", ["title" => "Symbol", "stocks" => $stocks, "assets" => $assets]);
}

?>
