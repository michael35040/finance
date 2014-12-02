<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session






if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["cancel"])) {
        $uid = $_POST["cancel"];
        if ($uid == 'ALL') { //CANCEL ALL USERS ORDERS
            if (query("UPDATE notification SET status = '0' WHERE id = ?", $id) === false) {
                apologize("Unable to cancel all notifications!");
            }

        } else { //CANCEL ONLY 1 ORDER
            if (!ctype_digit($uid)) {
                apologize("Invalid notice #");
            }
            if (query("UPDATE notification SET status = '0' WHERE uid = ?", $uid) === false) {
                apologize("Unable to cancel notification!");
            }

        }
    }
}






$bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $id);	  // query user's portfolio
$bidLocked = getPrice($bidLocked[0]["total"]); //shares trading
if($bidLocked==null){$bidLocked=0;}

$userPortfolio =	query("SELECT symbol, quantity, price FROM portfolio WHERE id = ? ORDER BY symbol ASC", $_SESSION["id"]);

$purchaseprice = query("SELECT SUM(price) AS purchaseprice FROM portfolio WHERE id = ?", $_SESSION["id"]); //calculate purchase price
$purchaseprice = getPrice($purchaseprice[0]["purchaseprice"]); //convert array to number

$portfolioTotal=0; //total market value of portfolio

$portfolio = []; //to send to next page
foreach ($userPortfolio as $row)		// for each of user's stocks
{
    $stock = [];
    $stock["symbol"] = $row["symbol"]; //set variable from stock info
    
    //USERS PORTFOLIO
    $stock["quantity"] = $row["quantity"];
    
    //USERS ORDERBOOK
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a')", $id, $stock["symbol"]);	  // query user's portfolio
        if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
    $stock["locked"] = $askQuantity;
    
    //TOTAL SHARES PUBLIC
        $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $row["symbol"]); // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $publicQuantity = $public[0]["quantity"]; //shares held
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE symbol =? AND side='a'", $row["symbol"]); // query user's portfolio
        if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
    $stock["public"] = $askQuantity+$publicQuantity;
    
    //TOTAL SHARES ISSUED
    $issued =	query("SELECT issued FROM assets WHERE symbol =?", $stock["symbol"]);	  // query user's portfolio
        if(empty($issued[0]["issued"])){$issued[0]["issued"]=0;}
        $issued = $issued[0]["issued"]; //shares held
    $stock["issued"]=$issued;
    
    //USERS CONTROL
    if($stock["public"]==0){$stock["control"]=0;} //can also use 'issued' for this and the one below as they should in theory be the same
    else{$stock["control"] = (($stock["quantity"]+$stock["locked"])/$stock["public"])*100; } //based on public

    $stock["value"] = getPrice($row["price"]); //total purchase price, value when bought
    $trades =	    query("SELECT price FROM trades WHERE symbol = ? ORDER BY uid DESC LIMIT 0, 1", $stock["symbol"]);	  // query user's portfolio
        @$stock["price"] = $trades[0]["price"]; //stock price per share
    $stock["total"] = getPrice(($stock["quantity"]+$stock["locked"]) * $stock["price"]); //current market price pulled from function.php

    $portfolio[] = $stock;
    $portfolioTotal = $portfolioTotal + $stock["total"]; //total market value of portfolio
}

$notifications = query("SELECT * FROM notification WHERE (id =? AND status='1')", $id);


    $countQ = query("SELECT COUNT(uid) AS total FROM orderbook WHERE id=?", $id); // query database for user
$count["orders"] = $countQ[0]["total"];
    $countQ = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (buyer=? OR seller=?)", $id, $id); // query database for user
$count["trades"] = $countQ[0]["total"];
$count["value"] = getPrice($countQ[0]["value"]);
$count["volume"] = $countQ[0]["volume"];
    $countQ = query("SELECT COUNT(symbol) AS total FROM portfolio WHERE id=?", $id); // query database for user
$count["assets"] = $countQ[0]["total"];
    $countQ = query("SELECT SUM(commission) AS commission FROM trades WHERE seller=? AND (type='limit' OR type='market')", $id); // to prevent the PO type from adding fee for commission
$count["commission"] = getPrice($countQ[0]["commission"]);

// render portfolio (pass in new portfolio table and cash)
render("account_form.php", ["title" => "Account", "count" => $count, "notifications" => $notifications, "portfolio" => $portfolio, "portfolioTotal" => $portfolioTotal, "purchaseprice" => $purchaseprice, "bidLocked" => $bidLocked]);
?>                    
