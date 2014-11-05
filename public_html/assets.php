<?php

// configuration
require("../includes/config.php");

$allAssets =	query("SELECT * FROM assets ORDER BY symbol ASC");

$assets = []; //to send to next page
foreach ($allAssets as $row)		// for each of user's stocks
{
    $asset = [];

    $asset["symbol"] = $row["symbol"]; //set variable from stock info
    $asset["name"] = $row["name"]; //set variable from stock info
    $asset["date"] = $row["date"]; //date listed on exchange
    $asset["owner"] = $row["owner"];
    $asset["fee"] = $row["fee"];
    $asset["issued"] = $row["issued"]; //shares issued
    $public =	query("SELECT SUM(quantity) AS quantity,  SUM(locked) AS locked FROM portfolio WHERE symbol =?", $asset["symbol"]);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        if(empty($public[0]["locked"])){$public[0]["locked"]=0;}
        $publicLocked = $public[0]["locked"];
        $publicQuantity = $public[0]["quantity"];
    $asset["public"] = $publicLocked+$publicQuantity; //shares actually held public
    $asset["dividend"] = $row["dividend"]; //shares actually held public
    $asset["url"] = $row["url"]; //webpage
    $asset["type"] = $row["type"]; //type of asset (shares, commodity)
    $asset["rating"] = $row["rating"]; //my rating
    $asset["description"] = $row["description"]; //description of asset
        $bid =	query("SELECT price FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $asset["symbol"], 'b');
        if(empty($bid)){$bid=0;}
    $asset["bid"] = $bid[0]["price"]; //stock price per share
        $ask =	query("SELECT price FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $asset["symbol"], 'a');
        if(empty($ask)){$ask=0;}
    $asset["ask"] = $ask[0]["price"]; //stock price per share
        $volume =	query("SELECT SUM(quantity) AS quantity, AVG(price) AS price, date FROM trades WHERE symbol =? GROUP BY DAY(date) ORDER BY uid ASC ", $asset["symbol"]);	  // query user's portfolio
        if(empty($volume[0]["quantity"])){$volume[0]["quantity"]=0;}
        if(empty($volume[0]["price"])){$volume[0]["price"]=0;}
    $asset["volume"] = $volume[0]["quantity"];
    $asset["avgprice"] = $volume[0]["price"];
    $trades =	    query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $asset["symbol"]);	  // query user's portfolio
        if(empty($trades[0]["price"])){$trades[0]["price"]=0;}
    $asset["price"] = $trades[0]["price"]; //stock price per share
    $asset["marketcap"] = ($asset["price"] * $asset["issued"]);

    $assets[] = $asset;

    //apologize(var_dump(get_defined_vars()));

}

// render portfolio (pass in new portfolio table and cash)
render("assets_form.php", ["title" => "Accounts", "assets" => $assets]);

?>
