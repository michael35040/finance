<?php
//throw new Exception(var_dump(get_defined_vars()));

///////////////////////////////
//CONVERT INTEGER PRICE TO FLOAT
///////////////////////////////
function getPrice($price)
{
    $price = $price/10000000;

    //setlocale(LC_MONETARY, 'en_US');
    //$price = money_format('%(#10n', $price) . "\n"; // ($        1,234.57)
    return($price);
}
function setPrice($price)
{
    if (preg_match("/^([0-9.]+)$/", $price) == false) {apologize("You submitted an invalid price.");}
	if ($price<0){ apologize("Price must be positive!");} //if quantity is numeric
	$price = $price*10000000;
	$price=floor($price);
	//if (!is_int($price)) { apologize("Price must be numeric!");} //if quantity is numeric
	return($price);
}


/////////////////////////////////
//COMMISSION
/////////////////////////////////
function getCommission($total)
{
    require 'constants.php'; //for $divisor
    $commissionAmount = $total * $commission; //ie 13.6875 = 273.75 * 0.05  //(5qty * $54.75)
    $commissionAmount = floor($commissionAmount); //drops decimals
    return($commissionAmount);
    
}



////////////////////////////////////
//CHECK FOR 0 QTY ORDERS AND REMOVES
////////////////////////////////////
function zeroQuantityCheck()
{    require 'constants.php';
    if($loud!='quiet'){echo("<br>Conducting check for empty orders...");}
    $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (quantity = 0) LIMIT 0, 1");
    $removedEmpty = 0;
    while(!empty($emptyOrders))
    {   $removedEmpty++;
        cancelOrder($emptyOrders[0]["uid"]); //try catch
        $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (quantity = 0) LIMIT 0, 1"); }
    if($removedEmpty>0){ if($loud!='quiet'){echo("<br>Removed: " . $removedEmpty . " empty orders.");  }}
    return($removedEmpty);
}

////////////////////////////////////
//CHECK FOR NEGATIVE VALUES
////////////////////////////////////
function negativeValues()
{   require 'constants.php';
    if($loud!='quiet'){echo("<br>Conducting check for negative values...");}
    $negativeValueOrderbook = query("SELECT quantity, total, uid FROM orderbook WHERE (quantity < 0 OR total < 0) LIMIT 0, 1");
    if(!empty($negativeValueOrderbook)) {
        throw new Exception("<br>Negative Orderbook Values! UID: " . $negativeValueOrderbook[0]["uid"] . ", Quantity: " . $negativeValueOrderbook[0]["quantity"] . ", Total: " . $negativeValueOrderbook[0]["total"]);}
    //eventually all users order using id
    $negativeValueAccounts = query("SELECT units, id FROM accounts WHERE (units < 0) LIMIT 0, 1");
    if(!empty($negativeValueAccounts))
    { if($loud!='quiet'){echo("<br>Negative Account Balance Detected! ID:"  .$negativeValueAccounts[0]["id"] . ", Balance:" . $negativeValueAccounts[0]["units"]);}
        if(query("UPDATE orderbook SET type = 'cancel' WHERE id = ?", $negativeValueAccounts[0]["id"]) === false){ apologize("Unable to cancel all orders!"); }
        cancelOrderCheck(); //try catch
        throw new Exception("<br>Canceled All Users (ID:" . $negativeValueAccounts[0]["id"] . ") orders due to negative account balance. Current balance: " . $negativeValueAccounts[0]["units"]);}
    //eventually all users order using id     throw new Exception(var_dump(get_defined_vars()));
}

////////////////////////////////////
//CHECK FOR CANCELED ORDERS VALUES
////////////////////////////////////
function cancelOrderCheck()
{    require 'constants.php';
if($loud!='quiet'){echo("<br>Conducting check for canceled orders...");}
      //Check to see if anyone canceled any orders
    $cancelOrders = query("SELECT side, uid FROM orderbook WHERE type = 'cancel' ORDER BY uid ASC LIMIT 0, 1");
    $canceledNumber=0;
    while(!empty($cancelOrders))
    {
        //NEGATIVE VALUE CHECK
        cancelOrder($cancelOrders[0]["uid"]); //try catch

        //Search again to see if anymore
        $cancelOrders = query("SELECT side, uid FROM orderbook WHERE type = 'cancel' ORDER BY uid ASC LIMIT 0, 1");
        $canceledNumber++;
    }
    if($canceledNumber>0){ echo("<br>Canceled: " . $canceledNumber . " orders.");  }

}


////////////////////////////////////
//CANCEL ORDER
////////////////////////////////////
function cancelOrder($uid)
{   require 'constants.php';
    $order = query("SELECT side, quantity, uid, symbol, type, price, id, total FROM orderbook WHERE uid = ?", $uid);
    if(!empty($order)) {
        @$side = $order[0]["side"];
        @$quantity = $order[0]["quantity"];
        @$uid = $order[0]["uid"];
        @$symbol = $order[0]["symbol"];
        @$type = $order[0]["type"];
        @$price = $order[0]["price"];
        @$id = $order[0]["id"];
        query("SET AUTOCOMMIT=0");
        query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

        @$total = $order[0]["total"];


        if ($side == 'a') {
            if (query("UPDATE portfolio SET quantity = (quantity + ?) WHERE (symbol = ? AND id = ?)", $quantity, $symbol, $id) === false) {
                query("ROLLBACK");
                query("SET AUTOCOMMIT=1");
                throw new Exception("Failure Cancel 2");
            }
        } elseif ($side == 'b') {
            if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $total, $id) === false) //MOVE CASH TO units FUNDS
            {
                query("ROLLBACK");
                query("SET AUTOCOMMIT=1");
                throw new Exception("Failure Cancel 4");
            }
        }

        //DELETE ORDER
        if (query("DELETE FROM orderbook WHERE (uid = ?)", $uid) === false) {
            query("ROLLBACK");
            query("SET AUTOCOMMIT=1");
            throw new Exception("Failure Cancel 1");
        }

        //UPDATE HISTORY
        if ($quantity > 0) //to prevent spamming history with cleanup of orderbook of empty orders.
        { $total=($total*-1); //set to negative for calculations on order form total.
            if (query("INSERT INTO history (id, ouid, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, $uid, 'CANCEL', $symbol, $quantity, $price, $total) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Insert History Failure 3c"); }
        }
        else //($quantity <=0)
        { $price=0; $total=0;//order was executed and the price listed was not the actual amount and the total was what was left over.
            if (query("INSERT INTO history (id, ouid, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, $uid, 'EXECUTED', $symbol, $quantity, $price, $total) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Insert History Failure 3c"); }
        }


        if($loud!='quiet'){echo("<br>Canceled [ID: " . $id . ", UID:" . $uid . ", Side:" . $side . ", Type:" . $type . ", Total:" . $total . ", Quantity:" . $quantity . ", Symbol:" . $symbol . "]");}


        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");

    } //!empty

    //var_dump(get_defined_vars());
    //throw new Exception("Market orders require limit orders. No ask limit orders for the bid market order. Deleting market order.");

}



////////////////////////////////////
//CHECK FOR WHICH ORDERS ARE AT TOP OF ORDERBOOK
////////////////////////////////////
function OrderbookTop($symbol)
{    require 'constants.php';
    if($loud!='quiet'){echo("<br>[" . $symbol . "] Conducting check for top of orderbook...");}

    $topOrders=[];

    //MARKET ORDERS SHOULD BE AT TOP IF THEY EXIST
    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND type = 'market' AND quantity>0) ORDER BY uid ASC LIMIT 0, 1", $symbol);
    if(!empty($marketOrders))
    {   @$marketSide=$marketOrders[0]["side"];
        $tradeType = 'market';
        if($marketSide == 'b') {
            $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'b') && (empty($asks))) {  //cancel all bid market orders since there are no limit ask orders.
                cancelOrder($marketOrders[0]["uid"]);
                $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market' AND quantity>0) ORDER BY uid ASC LIMIT 0, 1", $symbol, 'b');
                $asks = query("SELECT 	* FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            }
            $marketOrders[0]["price"]=$asks[0]["price"]; //give it the same price so they execute
            $bids = $marketOrders;
        }    //assign top price to the ask since it is a bid market order
        elseif($marketSide == 'a')
        {
            $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'a') && (empty($bids))) {
                cancelOrder($marketOrders[0]["uid"]);
                $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market' AND quantity>0) ORDER BY uid ASC LIMIT 0, 1", $symbol, 'a');
                $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            }
            $marketOrders[0]["price"]=$bids[0]["price"]; //give it the same price so they execute
            $asks = $marketOrders;
        }   //assign top price to the bid since it is an ask market order
        else { throw new Exception("Market Side Error!"); }
    }
    elseif(empty($marketOrders))
    {   $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
        $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit' AND quantity>0) ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
        $tradeType = 'limit'; }
    else {throw new Exception("Market Order Error!");}

    $topOrders["asks"]=$asks;
    $topOrders["bids"]=$bids;
    $topOrders["tradeType"]=$tradeType;
    return($topOrders);
}
//throw new Exception(var_dump(get_defined_vars())); //dump all variables if i hit error


////////////////////////////////////
//EXCHANGE MARKET ALL
////////////////////////////////////            apologize(var_dump(get_defined_vars()));

//apologize(var_dump(get_defined_vars()));
function processOrderbook($symbol=null)
{   require 'constants.php';
    $startDate = time();
    $totalProcessed=0;
if($loud!='quiet'){echo(date("Y-m-d H:i:s"));}

    //NEGATIVE VALUE CHECK
    negativeValues();
    //CANCEL ORDER CHECK
    cancelOrderCheck();

    if(empty($symbol))
    {
        //GET A QUERY OF ALL SYMBOLS FROM ASSETS
        $symbols =	query("SELECT symbol FROM assets ORDER BY symbol ASC");

        //to prevent stopping on error for symbol (i.e. user does not have enough funds, all user orders deleted
        $error=1;
        while($error>0)
        {
            $error=0;
            foreach ($symbols as $symbol)
            {   if($loud!='quiet'){echo("<br><br>[" . $symbol["symbol"] . "] Processing orderbook...");}
                try {$orderbook = orderbook($symbol["symbol"]);
                    if($loud!='quiet'){echo('<br>[' . $orderbook["symbol"] . '] Processed ' . $orderbook["orderProcessed"] . ' orders.');}
                    $totalProcessed = ($totalProcessed + $orderbook["orderProcessed"]);

                }
                catch(Exception $e) {
                    if($loud!='quiet'){echo('<br><div style="color:red;">Error: [' . $symbol["symbol"] . "] " . $e->getMessage() . '</div>');}
                $error=$error+1;
                }
            }
        }

    }
    else
    {   if($loud!='quiet'){echo("<br>[" . $symbol . "] Processing orderbook...");}
        $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
        if (count($symbolCheck) != 1) {throw new Exception("[" . $symbol . "] Incorrect Symbol. Not listed on the exchange!");} //row count

        $error=1;
        while($error>0) {
            $error = 0;

            try {
                $orderbook = orderbook($symbol);
                if (isset($orderbook)) {
                    if($loud!='quiet'){echo('<br><div style="color:red; font-weight: bold;">[' . $symbol . '] Processed ' . $orderbook["orderProcessed"] . " orders</div>");}
                    $totalProcessed = ($totalProcessed + $orderbook["orderProcessed"]);
                }
            } catch (Exception $e) {
                    if($loud!='quiet'){echo '<br>[' . $symbol . "] " . $e->getMessage();}
                $error = $error + 1;
            }
        }

    }
if($loud!='quiet'){echo("<br>");}


    //REMOVES ALL EMPTY ORDERS
    zeroQuantityCheck();

if($loud!='quiet'){ echo(date("Y-m-d H:i:s"));}
    $endDate =  time();
    $totalTime = $endDate-$startDate;
    if($totalTime != 0){$speed=$totalProcessed/$totalTime;}
    else{$speed=0;}
    if($loud!='quiet'){echo("<br><br><b>Processed " . $totalProcessed . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec</b>");}

    return($totalProcessed);

}


////////////////////////////////////
//EXCHANGE MARKET
////////////////////////////////////
function orderbook($symbol)
{ require 'constants.php';
//   apologize(var_dump(get_defined_vars())); //dump all variables if i hit error
if($loud!='quiet'){echo("<br>[" . $symbol . "] Computing orderbook...");}
    //$adminid = 1;

    require 'constants.php';

    //PROCESS MARKET ORDERS
    if(empty($symbol)){throw new Exception("No symbol selected!");}

    //QUERY TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    if (count($symbolCheck) != 1) {throw new Exception("Incorrect Symbol. Not listed on the exchange!");} //row count

    //FIND TOP OF ORDERBOOK
    $topOrders = OrderbookTop($symbol); //try catch
    $asks = $topOrders["asks"];
    $bids = $topOrders["bids"];
    
    if (empty($asks) || empty($bids)) { $orderbook['orderProcessed'] = 0; return($orderbook); }  //{ throw new Exception("No bid limit orders. Unable to cross any orders."); }

    $topAskPrice = (float)$asks[0]["price"];
    $topBidPrice = (float)$bids[0]["price"];
    $tradeType = $topOrders["tradeType"];

    //PROCESS ORDERS
    $orderProcessed = 0; //orders processed
    $orderbook=[];
    $orderbook["symbol"]=$symbol;
    while ($topBidPrice >= $topAskPrice)
    {   @$topAskUID = (int)($asks[0]["uid"]); //order id; unique id
        @$topAskSymbol = ($asks[0]["symbol"]); //symbol of equity
        @$topAskSide = ($asks[0]["side"]); //bid or ask
        @$topAskDate = ($asks[0]["date"]);
        @$topAskType = ($asks[0]["type"]); //limit or market
        @$topAskSize = (int)($asks[0]["quantity"]); //size or quantity of trade
        @$topAskUser = (int)($asks[0]["id"]); //user id
        @$topBidUID = (int)($bids[0]["uid"]); //order id; unique id
        @$topBidSymbol = ($bids[0]["symbol"]);
        @$topBidSide = ($bids[0]["side"]); //bid or ask
        @$topBidDate = ($bids[0]["date"]);
        @$topBidType = ($bids[0]["type"]); //limit or market
        @$topBidSize = (int)($bids[0]["quantity"]);
        @$topBidUser = (int)($bids[0]["id"]);
        @$topBidUnits = (float)($bids[0]["total"]);

        $orderProcessed++; //orders processed plus 1

        if ($topBidPrice >= $topAskPrice) //TRADES ARE POSSIBLE
        { if($loud!='quiet'){echo("<br>[" . $symbol . "] Trade possible...");}
            //START TRANSACTION
            query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

            //DETERMINE EXECUTED PRICE (bid or ask) BY EARLIER DATE TIME using UID
            if ($topBidUID < $topAskUID) { $tradePrice = $topBidPrice;} //with dates or uid, the smaller one is older
            elseif ($topBidUID > $topAskUID) { $tradePrice = $topAskPrice; }
            else {  query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("$topBidUID / $topAskUID Bid and Ask UID same!"); } //rollback on failure

            //DETERMINE TRADE SIZE
            if ($topBidSize <= $topAskSize) { $tradeSize = $topBidSize;}  //BID IS SMALLER SO DELETE AND UPDATE ASK ORDER
            elseif ($topBidSize > $topAskSize) { $tradeSize = $topAskSize;}
            else {  query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Bid Size or Ask Size Unknown!"); } //rollback on failure
            if ($tradeSize == 0) {throw new Exception("Trade Size is 0"); } //catch if trade size is null or zero

            //TRADE AMOUNT
            $tradeAmount = ($tradePrice * $tradeSize);
            if ($tradeAmount == 0) {throw new Exception("Trade Amount is 0");}
            //COMMISSION AMOUNT
            $commissionAmount = getCommission($tradeAmount);

            ////////////
            //ORDERBOOK
            /////////////

            //ASK INFO
            $orderbookQuantity = query("SELECT quantity FROM orderbook WHERE (uid = ?)", $topAskUID);
            $orderbookQuantity = (int)$orderbookQuantity[0]["quantity"];
            // throw new Exception(var_dump(get_defined_vars()));

            //REMOVE SHARES FROM ASK USER
            //IF SELLER TRYING TO SELL MORE THEN THEY OWN CANCEL ORDER
            if ($tradeSize > $orderbookQuantity) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topAskUID);
                throw new Exception("$topAskUser Seller does not have enough quantity. Seller's order deleted."); }
            //UPDATE ASK ORDER //REMOVE QUANTITY
            if (query("UPDATE orderbook SET quantity=(quantity-?) WHERE uid=?", $tradeSize, $topAskUID) === false)
            {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Size OB Failure: #3"); } //rollback on failure


            // UPDATE BID ORDER //REMOVE units FUNDS
            $orderbookUnitsQ = query("SELECT total FROM orderbook WHERE uid=?", $topBidUID);
            $orderbookUnits = (float)$orderbookUnitsQ[0]["total"];
            //throw new Exception(var_dump(get_defined_vars()));

            //IF BUYER DOESN'T HAVE ENOUGH FUNDS CANCEL ORDER
            if ($orderbookUnits < $tradeAmount)
            {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topBidUID); throw new Exception("Buyer does not have enough funds. Buyers orders deleted"); }
            if (query("UPDATE orderbook SET quantity=(quantity-?), total=(total-?) WHERE uid=?", $tradeSize, $tradeAmount, $topBidUID) === false)
            {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Update OB Failure: #5"); }

            ///////////
            //ACCOUNTS
            ///////////
            //GIVE UNITS TO ASK USER MINUS COMMISSION
            if (query("UPDATE accounts SET units = (units + ? - ?) WHERE id = ?", $tradeAmount, $commissionAmount, $topAskUser) === false)
            { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Update Accounts Failure: #11"); }
            //GIVE COMMISSION TO ADMIN/OWNER
            if ($commissionAmount > 0)
            {   if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commissionAmount, $adminid) === false)
            { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Update Accounts Failure: #11a"); }
            }

            ///////////
            //PORTFOLIO
            ///////////
            //QUICK ERROR CHECK
            //CHECK THE QUANTITY FOR INSERT OR DELETE
            $askPortfolio = query("SELECT quantity, symbol FROM portfolio WHERE (symbol=? AND id=?)", $symbol, $topAskUser);
            $askPortfolioRows = count($askPortfolio);
            if ($askPortfolioRows > 1){ query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("$topAskUser has too many $symbol Portfolios! #20a"); }

            @$askPortfolio = $askPortfolio[0]["quantity"];
            // DELETE IF TRADE IS ALL THEY OWN//WOULD BE 0 SINCE THE REST WOULD BE IN ORDERBOOK
            if($askPortfolio == 0) {if (query("DELETE FROM portfolio WHERE (id = ? AND symbol = ?)", $topAskUser, $symbol) === false)
            { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure: #14"); } }
            // QUANTITY WERE REMOVED WHEN PUT INTO ORDERBOOK BUT NEED TO UPDATE PRICE
            elseif($askPortfolio > 0) {if (query("UPDATE portfolio SET price = (price - ? - ?) WHERE (id = ? AND symbol = ?)", $tradeAmount, $commissionAmount, $topAskUser, $symbol) === false)
            { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure: #14a"); } }
            else { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure: #14b. Seller has no portfolio." . $topAskUser); }

            //GIVE SHARES TO BID USER
            $bidQuantityRows = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $topBidUser, $symbol); //Checks to see if they already own stock to determine if we should insert or update tables
            $countRows = count($bidQuantityRows);
            //INSERT IF NOT ALREADY OWNED
            if ($countRows == 0)
            {   if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $topBidUser, $symbol, $tradeSize, $tradeAmount) === false) {
                query("ROLLBACK"); query("SET AUTOCOMMIT=1"); pologize("Failure: #18, Bid Quantity & Trade Size"); } }
            //UPDATE IF ALREADY OWNED
            elseif($countRows == 1)
            {   if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $tradeSize, $tradeAmount, $topBidUser, $symbol) === false)
            {   query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure: #19"); } }
            //ERROR: TO MANY ROWS
            else { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("$topBidUser has too many $symbol Portfolios! #20b"); }  //throw new Exception(var_dump(get_defined_vars()));

            ///////////
            //TRADE
            ///////////
            if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $topBidUser, $topAskUser, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount, $tradeType, $topBidUID, $topAskUID) === false)  { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure: #21a"); }

            //ALL THINGS OKAY, COMMIT TRANSACTIONS
            query("COMMIT;"); //If no errors, commit changes
            query("SET AUTOCOMMIT=1");

            //FIND TOP OF ORDERBOOK
            $topOrders = OrderbookTop($symbol); //try catch
            $asks = $topOrders["asks"];
            $bids = $topOrders["bids"];
            if (empty($asks) || empty($bids)) { $orderbook['orderProcessed'] = 0; return($orderbook); }  //{ throw new Exception("No bid limit orders. Unable to cross any orders."); }
            $topAskPrice = (float)$asks[0]["price"];
            $topBidPrice = (float)$bids[0]["price"];
            $tradeType = $topOrders["tradeType"];

            /* */
            //LAST TRADE INFO TO RETURN ON FUNCTION
            if ($topAskType == 'market') { $topAskPrice = 'market'; } //null//$tradePrice;}     //since the do while loop gives it the next orders price, not the last traded
            if ($topBidType == 'market') { $topBidPrice = 'market'; } //null// $tradePrice;}     //since the do while loop gives it the next orders price, not the last traded
            $orderbook['topAskPrice'] = ($asks[0]["price"]); //limit price
            $orderbook['topAskUID'] = ($asks[0]["uid"]);  //order id; unique id
            $orderbook['topAskSymbol'] = ($asks[0]["symbol"]); //symbol of equity
            $orderbook['topAskSide'] = ($asks[0]["side"]);  //bid or ask
            $orderbook['topAskDate'] = ($asks[0]["date"]);
            $orderbook['topAskType'] =  ($asks[0]["type"]);  //limit or market
            $orderbook['topAskSize'] = ($asks[0]["quantity"]); //size or quantity of trade
            $orderbook['topAskUser'] = ($asks[0]["id"]); //user id
            $orderbook['topBidPrice'] = ($bids[0]["price"]);
            $orderbook['topBidUID'] = ($bids[0]["uid"]);//order id; unique id
            $orderbook['topBidSymbol'] = ($bids[0]["symbol"]);
            $orderbook['topBidSide'] = ($bids[0]["side"]);  //bid or ask
            $orderbook['topBidDate'] = ($bids[0]["date"]);
            $orderbook['topBidType'] = ($bids[0]["type"]); //limit or market
            $orderbook['topBidSize'] = ($bids[0]["quantity"]);
            $orderbook['topBidUnits'] = ($bids[0]["total"]);
            $orderbook['topBidUser'] = ($bids[0]["id"]);
            if (empty($tradePrice)) {$tradePrice = 0;} //if no trades so should be empty
            $orderbook['tradePrice'] = $tradePrice;
            $orderbook['tradeType'] = $tradeType;

            if($loud!='quiet'){
                    echo("<br><br><b>Executed: Trade Price: " . number_format($orderbook['tradePrice'],2,".",",") . " (" . $orderbook['tradeType'] . ")</b>");
                    echo("<br>Ask Price: " . number_format($orderbook['topAskPrice'],2,".",","));
                    echo("<br>Ask UID: " . $orderbook['topAskUID']); //order id; unique id
                    echo("<br>Ask Symbol: " . $orderbook['topAskSymbol']); //symbol of equity
                    echo("<br>Ask Side: " . $orderbook['topAskSide']); //bid or ask
                    echo("<br>Ask Date: " . $orderbook['topAskDate']);
                    echo("<br>Ask Type: " . $orderbook['topAskType']);  //limit or market
                    echo("<br>Ask Size: " . $orderbook['topAskSize']); //size or quantity of trade
                    echo("<br>Ask User: " .  $orderbook['topAskUser']); //user id
                    echo("<br>Bid Price: " . number_format($orderbook['topBidPrice'],2,".",",")); //might need to make (float)
                    echo("<br>Bid UID: " . $orderbook['topBidUID']); //order id; unique id
                    echo("<br>Bid Symbol: " . $orderbook['topBidSymbol']);
                    echo("<br>Bid Side: " . $orderbook['topBidSide']); //bid or ask
                    echo("<br>Bid Date: " . $orderbook['topBidDate']);
                    echo("<br>Bid Type: " . $orderbook['topBidType']); //limit or market
                    echo("<br>Bid Size: " . $orderbook['topBidSize']);
                    echo("<br>Bid User: " . $orderbook['topBidUser']);
                }





        } //IF TRADES ARE POSSIBLE
        elseif($topBidPrice < $topAskPrice){throw new Exception("No trades possible!");}
        //{throw new Exception("No trades possible!");} //TRADES ARE NOT POSSIBLE
        else {throw new Exception("ERROR!");}

    } //BOTTOM of WHILE STATEMENT


    $orderbook['orderProcessed'] = $orderProcessed;
    return($orderbook);

//catch(Exception $e) {echo('<br>Message: [' . $symbol . "] " . $e->getMessage());}

} //END OF FUNCTION















////////////////////////////////////
//Update Stock
////////////////////////////////////
function updateSymbol($symbol, $newSymbol, $userid, $name, $type, $url, $rating, $description)
{   
    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    //CHECK TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($symbolCheck);
    if ($countOwnersRows != 1) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Symbol does not exist."); }

    if (!empty($userid)) { if (query("UPDATE assets SET userid = ? WHERE symbol = ?", $userid, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($name)) { if (query("UPDATE assets SET name = ? WHERE symbol = ?", $name, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($type)) { if (query("UPDATE assets SET type=? WHERE symbol = ?", $type, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($url)) { if (query("UPDATE assets SET url = ? WHERE symbol = ?", $url, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($rating)) { if (query("UPDATE assets SET rating = ? WHERE symbol = ?", $rating, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($description)) { if (query("UPDATE assets SET description = ? WHERE symbol = ?", $description, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");} }
    if (!empty($newSymbol)) {
        if (query("UPDATE assets SET symbol = ? WHERE symbol = ?", $newSymbol, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");}
        if (query("UPDATE history SET symbol = ? WHERE symbol = ?", $newSymbol, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");}
        if (query("UPDATE orderbook SET symbol = ? WHERE symbol = ?", $newSymbol, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");}
        if (query("UPDATE portfolio SET symbol = ? WHERE symbol = ?", $newSymbol, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");}
        if (query("UPDATE trades SET symbol = ? WHERE symbol = ?", $newSymbol, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("Failure to update");}
    }

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    return("$symbol Update successful!");
}
















////////////////////////////////////
//Public Offering (initial)
////////////////////////////////////
function publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description)
{   require 'constants.php';
$transaction='PO'; //public offering
if (empty($symbol)) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("You must enter symbol."); }
$symbol = strtoupper($symbol); //cast to UpperCase

query("SET AUTOCOMMIT=0");
query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit


    if (empty($fee)) { $fee=0; }
    if (empty($userid)) {query("ROLLBACK"); query("SET AUTOCOMMIT=1");throw new Exception("You must enter owner user # when conducting a follow on public offering ."); }
    $feeQuantity = ($issued * $fee);
    $ownersQuantity = ($issued - $feeQuantity);
    $price = 0; //since a public offering, cost is 0.
    
    //CHECK TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($symbolCheck);
    if ($countOwnersRows != 0) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Symbol already exsists."); }
    
    //INSERT ASSET
    if (query("INSERT INTO assets (`symbol`, `name`, `userid`, `fee`, `issued`, `url`, `type`, `rating`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $name, $userid, $fee, $issued, $url, $type, $rating, $description) === false)  //create IPO
    { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Failure to insert into assets"); }

//INSERT SHARES INTO PORTFOLIO OF OWNER MINUS FEE
$ownerPortfolio = query("SELECT symbol FROM portfolio WHERE (id =? AND symbol =?)", $userid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
$countOwnersRows = count($ownerPortfolio);
if ($countOwnersRows == 0)
{
    if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $userid, $symbol, $ownersQuantity, $price) === false) 
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Insert to Owners Portfolio Error");} //update portfolio
} //updates if stock already owned
elseif ($countOwnersRows == 1) //else update db
{   if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $ownersQuantity, $price, $userid, $symbol) === false) 
        {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Update to Owners Portfolio Error");} //update portfolio
}
else
{
     query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Public Offering Error: Too many symbol rows in assets. $symbol / $userid");
} //apologizes if first two conditions are not meet

//INSERT TRADE INTO PORTFOLIO OF OWNER MINUS FEE
if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $userid, $userid, $ownersQuantity, $price, $fee, 0, $transaction, 0, 0) === false) 
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); throw new Exception("Insert Owner Trade Error");}
    
//INSERT FEE SHARES INTO PORTFOLIO OF ADMIN
$adminPortfolio = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $adminid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
$adminPortfolio = count($adminPortfolio);
if ($adminPortfolio == 0)
    { if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $adminid, $symbol, $feeQuantity, $price) === false) {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");            throw new Exception("Insert Fee to Admin Error");} //update portfolio
        } //updates if stock already owned
        elseif ($adminPortfolio == 1) //else update db
        {
            if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $feeQuantity, $price, $adminid, $symbol) === false) {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                throw new Exception("Update to Admin Portfolio Error");
            } //update portfolio
        } else {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            //apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
            throw new Exception("Admin Portfolio Error");
        } //apologizes if first two conditions are not meet
    
    
    //INSERT TRADE SHARES INTO PORTFOLIO OF ADMIN
        if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $adminid, $userid, $feeQuantity, $price, $fee, 0, $transaction, 0, 0) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            throw new Exception("Insert Admin Trade Error");
        }


query("COMMIT;"); //If no errors, commit changes
query("SET AUTOCOMMIT=1");

return("$symbol public offering successful!");
} //function
















////////////////////////////////////
//Public Offering (follow on)
////////////////////////////////////
function publicOffering2($symbol, $userid, $issued, $fee)
{   require 'constants.php';

    $transaction='PO'; //public offering
    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    $symbol = strtoupper($symbol); //cast to UpperCase
    //CHECK TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($symbolCheck);
    if ($countOwnersRows != 1) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Symbol does not exsist."); }
    $feeQuantity = ($issued * $fee);
    $ownersQuantity = ($issued - $feeQuantity);
    $price = 0; //since a public offering, cost is 0.
    if (query("UPDATE assets SET issued=(issued+?) WHERE symbol = ?", $issued, $symbol) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1");apologize("Failure to update assets"); }
//INSERT SHARES INTO PORTFOLIO OF OWNER MINUS FEE
    $ownerPortfolio = query("SELECT symbol FROM portfolio WHERE (id =? AND symbol =?)", $userid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($ownerPortfolio);
    if ($countOwnersRows == 0)
    {
        if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $userid, $symbol, $ownersQuantity, $price) === false)
        {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Insert to Owners Portfolio Error1");} //update portfolio
    } //updates if stock already owned
    elseif ($countOwnersRows == 1) //else update db
    {   if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $ownersQuantity, $price, $userid, $symbol) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update to Owners Portfolio Error2");} //update portfolio
    }
    else
    {
        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Public Offering Error: Too many symbol rows in assets. $symbol / $userid");
    } //apologizes if first two conditions are not meet
//INSERT TRADE INTO PORTFOLIO OF OWNER MINUS FEE
    if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $userid, $userid, $ownersQuantity, $price, $fee, 0, $transaction, 0, 0) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Insert Owner Trade Error");}
//INSERT FEE SHARES INTO PORTFOLIO OF ADMIN
    $adminPortfolio = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $adminid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $adminPortfolio = count($adminPortfolio);
    if ($adminPortfolio == 0)
    { if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $adminid, $symbol, $feeQuantity, $price) === false) {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");            apologize("Insert Fee to Admin Error");} //update portfolio
    } //updates if stock already owned
    elseif ($adminPortfolio == 1) //else update db
    {
        if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $feeQuantity, $price, $adminid, $symbol) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Update to Admin Portfolio Error");
        } //update portfolio
    } else {
        query("ROLLBACK"); //rollback on failure
        query("SET AUTOCOMMIT=1");
        //apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
        apologize("Admin Portfolio Error");
    } //apologizes if first two conditions are not meet
    //INSERT TRADE SHARES INTO PORTFOLIO OF ADMIN
    if($feeQuantity>0){
        if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $adminid, $userid, $feeQuantity, $price, $fee, 0, $transaction, 0, 0) === false) {
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert Admin Trade Error");
        }
    }

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    return("$symbol Public offering successful!");
} //function

























////////////////////////////////////
//Public Offering (follow on)
////////////////////////////////////
function publicOfferingReverse($symbol, $userid, $issued)
{   require 'constants.php';

    $transaction='RO'; //reverse offering
    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    $symbol = strtoupper($symbol); //cast to UpperCase

    //CHECK TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($symbolCheck);
    if ($countOwnersRows != 1) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Symbol does not exist."); }
    if (query("UPDATE assets SET issued=(issued-?) WHERE symbol = ?", $issued, $symbol) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1");apologize("Failure to update assets"); }

    //CHECK TO SEE IF SYMBOL EXISTS
    $ownerPortfolio = query("SELECT symbol FROM portfolio WHERE (id =? AND symbol =?)", $userid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $countOwnersRows = count($ownerPortfolio);
    if ($countOwnersRows == 0) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("No assets to remove.");} //update portfolio} //updates if stock already owned
    elseif($countOwnersRows == 1) {if (query("UPDATE portfolio  SET quantity = (quantity - ?) WHERE (id = ? AND symbol = ?)", $issued, $userid, $symbol) === false) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update to Owners Portfolio Error2");}} //update portfolio
    else {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Public Offering Error: Too many symbol rows in assets. $symbol / $userid");} //apologizes if first two conditions are not meet

    //CHECK TO SEE IF USER HAS ENOUGH FOR REMOVAL
    $ownerPortfolio = query("SELECT quantity FROM portfolio WHERE (id =? AND symbol =?)", $userid, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
    $userQuantity = $ownerPortfolio[0]["quantity"];
    if ($userQuantity < $issued) {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("User does not have enough for removal."); exit();} //update portfolio} //updates if stock already owned

//INSERT TRADE INTO PORTFOLIO OF OWNER MINUS FEE
    if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $userid, $userid, $issued, 0, 0, 0, $transaction, 0, 0) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Insert Owner Trade Error");}

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    return("$symbol Public offering successful!");
} //function










////////////////////////////////////
//PLACE ORDER
////////////////////////////////////
function placeOrder($symbol, $type, $side, $quantity, $price, $id)
{   require 'constants.php'; //for $divisor
    //CHECK FOR EMPTY VARIABLES
    if(empty($symbol)) { throw new Exception("Invalid order. Trade symbol required."); } //check to see if empty
    if(empty($quantity)) { throw new Exception("Invalid order. Trade quantity required."); } //check to see if empty
    if(empty($type)) { throw new Exception("Invalid order. Trade type required."); } //check to see if empty
    if(empty($side)) { throw new Exception("Invalid order. Trade side required."); } //check to see if empty
    if(empty($id)) { throw new Exception("Invalid order. User required."); } //check to see if empty
    
    //SET PRICE
    if($type=='limit'){
    	if(empty($price)){throw new Exception("Invalid order. Limit order trade price required");}
    	$price = setPrice($price); }
    if($type=='market') { $price=0;}//market order doesn't require price
    
    //QUERY TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    if (count($symbolCheck) != 1) {throw new Exception("Incorrect Symbol. Not listed on the exchange!");} //row count
    //QUERY TO SEE IF USER EXISTS
    $userCheck = query("SELECT count(id) as number FROM users WHERE id =?", $id);
    if ($userCheck[0]["number"] != 1) {throw new Exception("No user exists!");} //row count
    
    //CHECKS INPUT
    if (preg_match("/^\d+$/", $quantity) == false) { throw new Exception("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    if (!ctype_alnum($symbol)) {throw new Exception("Symbol must be alphanumeric!");}
    if(!ctype_alpha($type) || !ctype_alpha($side)) { throw new Exception("Type and side must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
    if (!is_int($quantity) ) { throw new Exception("Quantity must be numeric!");} //if quantity is numeric
    if($quantity < 0){throw new Exception("Quantity must be positive!");}
    $symbol = strtoupper($symbol); //cast to UpperCase

    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

    if($type=='market')
    {   
        if ($side == 'a'){$otherSide='b';} 
        if($side=='b'){ $otherSide='a';}	
        //CHECK FOR LIMIT ORDERS SINCE MARKET ORDERS REQUIRE THEM
        $limitOrdersQ = query("SELECT SUM(quantity) AS limitorders FROM orderbook WHERE (type='limit' AND side=? AND symbol=?)", $otherSide, $symbol);
        $limitOrders = $limitOrdersQ[0]['limitorders'];
        if(empty($limitOrders)) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("No limit orders.");}
    }
    //both limit and market
    if($side=='b')
	{
	$transaction = 'BID';
        //QUERY CASH & UPDATE
        $unitsQ =	query("SELECT units FROM accounts WHERE id = ?", $id); //query db how much cash user has
        if(!empty($unitsQ[0]['units'])){$userUnits = $unitsQ[0]['units'];}	//convert array from query to value
        //IF USERUNITS IS EMPTY (0, NULL, etc.)
        else                    {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Order failed. User (#" . $id . ") has unknown balance");}
        //CHECK FOR 0 or NEGATIVE BALANCE
        if ($userUnits <= 0)    {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Order failed. User (#" . $id . ") balance: " . $userUnits);}
        //DETERMINE TRADEAMOUNT BASED ON ORDER TYPE
        if($type=='limit'){$tradeAmount = $price * $quantity; }
        else{$tradeAmount = $unitsQ[0]['units']; } //market orders lock all of the users funds
        //ENSURE BUYER HAS ENOUGH FUNDS
        if ($userUnits < $tradeAmount) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Trade amount (" . $tradeAmount . ") excceds user (" . $id . ") funds (" . $userUnits . ")." ); }
        elseif($userUnits >= $tradeAmount){if(query("UPDATE accounts SET units = (units - ?) WHERE id = ?", $tradeAmount, $id) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Updates Accounts Failure 4");}}
        else{  query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Updates Accounts Failure 5");}
	}
	//both limit and market
    if($side=='a')
    { 
		$transaction = 'ASK';
        $tradeAmount = 0;
	    //CHECK TO SEE IF SELLER HAS ENOUGH SHARES
        $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
        if(!empty($userQuantity)){$userQuantity = $userQuantity[0]["quantity"];}
        else{$userQuantity = 0;}
        //ENSURE SELLER HAS ENOUGH QUANTITY
        if($userQuantity <= 0) {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Ask order failed. User (#" . $id . ")  quantity: " . $userQuantity);}
        elseif($userQuantity < $quantity) {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Ask order not placed. Trade quantity (" . $quantity . ") exceeds user (" . $id . ") quantity (" . $userQuantity . ").");}                                                                  
        elseif($userQuantity >= $quantity){if(query("UPDATE portfolio SET quantity = (quantity - ?) WHERE (id = ? AND symbol = ?)", $quantity, $id, $symbol) === false){ query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Updates Accounts Failure 3"); }}
        else {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Updates Portfolio Failure 4");}
	}
	
    //INSERT INTO ORDERBOOK
    if (query("INSERT INTO orderbook (symbol, side, type, price, total, quantity, id) VALUES (?, ?, ?, ?, ?, ?, ?)", $symbol, $side, $type, $price, $tradeAmount, $quantity, $id) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Insert Orderbook Failure"); }

    //UPDATE HISTORY (ON ORDERS PAGE)
    $rows = query("SELECT LAST_INSERT_ID() AS uid"); //this takes the id to the next page
    $ouid = $rows[0]["uid"]; //sets sql query to var
    if (query("INSERT INTO history (id, ouid, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, $ouid, $transaction, $symbol, $quantity, $price, $tradeAmount) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); throw new Exception("Insert History Failure 3"); }

    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");

    return array($transaction, $symbol, $tradeAmount, $quantity);
}

?>
