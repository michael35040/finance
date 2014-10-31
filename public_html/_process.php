
<?php
require("../includes/config.php");



$orderbook = orderbook('A');


$topAskPrice = $orderbook['topAskPrice'];
$topAskUID = $orderbook['topAskUID']; //order id; unique id
$topAskSymbol = $orderbook['topAskSymbol']; //symbol of equity
$topAskSide = $orderbook['topAskSide']; //bid or ask
$topAskDate = $orderbook['topAskDate'];
$topAskType = $orderbook['topAskType']; //limit or market
$topAskSize = $orderbook['topAskSize'];  //size or quantity of trade
$topAskUser = $orderbook['topAskUser']; //user id



$topBidPrice = $orderbook['topBidPrice'];
$topBidUID = $orderbook['topBidUID']; //order id; unique id
$topBidSymbol = $orderbook['topBidSymbol'];
$topBidSide = $orderbook['topBidSide']; //bid or ask
$topBidDate = $orderbook['topBidDate'];
$topBidType = $orderbook['topBidType']; //limit or market
$topBidSize = $orderbook['topBidSize'];
$topBidUser = $orderbook['topBidUser'];

$orderProcessed = $orderbook['orderProcessed'];
$tradePrice = $orderbook['tradePrice'];
$tradeType = $orderbook['tradeType'];

//var_dump(get_defined_vars()); //dump all variables if i hit error

/////////////////////////
//TESTING
/////////////////////////


echo("<br>Orders Processed: " . $orderProcessed);
echo("<hr>");
echo("<br>Ask Price: " . $topAskPrice);
echo("<br>Ask UID: " . $topAskUID);
echo("<br>Ask Symbol: " . $topAskSymbol);
echo("<br>Ask Side: " . $topAskSide);
echo("<br>Ask Date: " . $topAskDate);
echo("<br>Ask Type: " . $topAskType);
echo("<br>Ask Size: " . $topAskSize);
echo("<br>Ask User: " . $topAskUser);
echo("<hr>");
echo("<br>Bid Price: " . $topBidPrice);
echo("<br>Bid UID: " . $topBidUID);
echo("<br>Bid Symbol: " . $topBidSymbol);
echo("<br>Bid Side: " . $topBidSide);
echo("<br>Bid Date: " . $topBidDate);
echo("<br>Bid Type: " . $topBidType);
echo("<br>Bid Size: " . $topBidSize);
echo("<br>Bid User: " . $topBidUser);
echo("<hr>");
echo("<br>Trade Price: " . $tradePrice);
echo("<br>Trade Type: " . $tradeType);



?>
