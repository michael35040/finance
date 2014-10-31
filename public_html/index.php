<?php

// configuration
require("../includes/config.php");

$purchaseprice = query("SELECT SUM(price) AS purchaseprice FROM portfolio WHERE id = ?", $_SESSION["id"]); //calculate purchase price
$userPortfolio =	query("SELECT * FROM portfolio WHERE id = ? ORDER BY symbol ASC", $_SESSION["id"]);

$portfolio = []; //to send to next page
foreach ($userPortfolio as $row)		// for each of user's stocks
{
    $stock = [];
    $stock["symbol"] = $row["symbol"]; //set variable from stock info
    $stock["quantity"] = $row["quantity"];
    $stock["locked"] = $row["locked"];
    $stock["value"] = $row["price"]; //total purchase price, value when bought

    $trades =	    query("SELECT * FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $stock["symbol"]);	  // query user's portfolio
        @$stock["price"] = $trades[0]["price"]; //stock price per share
    //$bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, date ASC LIMIT 0, 1", $symbol, 'b');
    //    $stock["bid"] = $bids[0]["price"];
    //$asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, date ASC LIMIT 0, 1", $symbol, 'a');
    //    $stock["ask"] = $asks[0]["price"];

        //for networth of stock
    $stock["total"] = $stock["quantity"] * $stock["price"]; //current market price pulled from function.php


    $portfolio[] = $stock;
}

// render portfolio (pass in new portfolio table and cash)
render("index_form.php", ["title" => "Accounts", "portfolio" => $portfolio, "purchaseprice" => $purchaseprice]);

?>
