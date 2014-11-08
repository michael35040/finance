<?php
//apologize(var_dump(get_defined_vars()));

/////////////////////////////////
//COMMISSION
///////////////////////////////////
function getCommission($total)
{
    $divisor = 0.25;
    $commission = 0.05;
    $commissionAmount = $total * $commission; //ie 13.6875 = 273.75 * 0.05  //(5qty * $54.75)
    $commissionAmount = $commissionAmount * 4; //ie 54.75 = 13.6875 * 4
    //ceil to round up and floor to round down
    $commissionAmount = floor($commissionAmount); //ie 55 = ceil(54.75)
    $commissionAmount = $commissionAmount/4; //ie 13.75
    
    //check to ensure it is to the nearest quarter
    $commissionModulus = fmod($commissionAmount, $divisor);
    if($commissionModulus != 0){apologize("Commission Amount Error. $divisor / $commissionAmount");} //checks to see if quarter increment

    //should need it but just in case.
    $commissionAmount = round($commissionAmount, 2); 
    
    return($commissionAmount);
}

////////////////////////////////////
//CANCEL ORDER
////////////////////////////////////
function cancelOrder($uid)
{
    $order = query("SELECT * FROM orderbook WHERE uid = ?", $uid);
    if(!empty($order))
    {   query("SET AUTOCOMMIT=0");
        query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
        if (query("DELETE FROM orderbook WHERE (uid = ?)", $uid) === false)
        {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 1"); }
        @$side=$order[0]["side"];

        if($side=='a')
        {   if (query("UPDATE portfolio SET quantity = (quantity + ?) WHERE (symbol = ? AND id = ?)", $order[0]['quantity'], $order[0]['symbol'], $order[0]['id']) === false)
        {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 2"); }
            if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'ask') === false)
            {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                apologize("Failure Cancel 3"); } }
        elseif($side=='b')
        {   if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $order[0]["total"], $order[0]["id"]) === false) //MOVE CASH TO units FUNDS
        {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 4");}
            if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'bid') === false)
            {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                apologize("Failure Cancel 5"); } }

        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");
    } //!empty

        //var_dump(get_defined_vars());
        //apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting market order.");

}

////////////////////////////////////
//CHECK FOR 0 QTY ORDERS AND REMOVES
////////////////////////////////////
function zeroQuantityCheck($symbol)
{   $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (symbol = ? AND quantity = 0) LIMIT 0, 1", $symbol);
    $cancelOrders = 0;
    while(!empty($emptyOrders))
    {   $cancelOrders++;
        cancelOrder($emptyOrders[0]["uid"]);
        $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (symbol = ? AND quantity = 0) LIMIT 0, 1", $symbol); }
    return($cancelOrders);
}

////////////////////////////////////
//CHECK FOR NEGATIVE VALUES
////////////////////////////////////
function negativeValues()
{   $negativeValueOrderbook = query("SELECT quantity, total, uid FROM orderbook WHERE (quantity < 0 OR total < 0) LIMIT 0, 1");
    if(!empty($negativeValueOrderbook)) { apologize(var_dump(get_defined_vars())); apologize("Negative Orderbook Values: " . $negativeValueOrderbook[0]["uid"]);}
        //eventually all users order using id
    $negativeValueAccounts = query("SELECT units, units, id FROM accounts WHERE (units < 0 OR units < 0) LIMIT 0, 1");
    if(!empty($negativeValueAccounts)) { apologize("Negative Accounts Values: " . $negativeValueAccounts[0]["id"]);}
        //eventually all users order using id     apologize(var_dump(get_defined_vars()));
}


////////////////////////////////////
//CHECK FOR WHICH ORDERS ARE AT TOP OF ORDERBOOK
////////////////////////////////////
function OrderbookTop($symbol)
{       //MARKET ORDERS SHOULD BE AT TOP IF THEY EXIST
        $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol);
        if (!empty($marketOrders))
        {   @$marketSide=$marketOrders[0]["side"];
            $tradeType = 'market';
            if ($marketSide == 'b')
            {   $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
                while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'b') && (empty($asks)))
                {  //cancel all bid market orders since there are no limit ask orders.
                    cancelOrder($marketOrders[0]["uid"]);
                    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol, 'b');
                    $asks = query("SELECT 	* FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a'); }
                $bids = $marketOrders;
                //assign top price to the ask since it is a bid market order
                @$topAskPrice = ($asks[0]["price"]); //limit price
                @$topBidPrice = ($asks[0]["price"]); }
            elseif($marketSide == 'a')
            {   $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
                while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'a') && (empty($bids)))
                {   cancelOrder($marketOrders[0]["uid"]);
                    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol, 'a');
                    $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b'); }
                $asks = $marketOrders;
                //assign top price to the bid since it is an ask market order
                @$topAskPrice = ($bids[0]["price"]);
                @$topBidPrice = ($bids[0]["price"]); }
            else { apologize("Market Side Error!"); } }
        elseif(empty($marketOrders)) 
        {   $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            if (empty($asks)) { apologize("No ask limit orders. Unable to cross any orders."); }
            if (empty($bids)) { apologize("No bid limit orders. Unable to cross any orders."); }
            @$topAskPrice = ($asks[0]["price"]); //limit price
            @$topBidPrice = ($bids[0]["price"]);
            $tradeType = 'limit'; }
        else {apologize("Market Order Error!");}

    return array($asks, $bids, $topAskPrice, $topBidPrice, $tradeType);
}
//apologize(var_dump(get_defined_vars())); //dump all variables if i hit error


////////////////////////////////////
//EXCHANGE MARKET ALL
////////////////////////////////////
function allOrderbooks()
{
    //GET A QUERY OF ALL SYMBOLS FROM ASSETS
    $symbols =	query("SELECT symbol FROM assets ORDER BY symbol ASC");

    foreach ($symbols as $symbol)
    {
        orderbook($symbol);
    }

    //THEN ORDERBOOK FUNCTION ALL ASSETS FOREACH
}

////////////////////////////////////
//EXCHANGE MARKET
////////////////////////////////////
function orderbook($symbol)
{
    $adminid = 1;
    
    //PROCESS MARKET ORDERS
    if(empty($symbol)){apologize("No symbol selected!");}

    //QUERY TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    if (count($symbolCheck) != 1) {apologize("Incorrect Symbol. Not listed on the exchange!");} //row count

    //NEGATIVE VALUE CHECK
    negativeValues();

    //REMOVES ALL EMPTY ORDERS
    zeroQuantityCheck($symbol);

    //FIND TOP OF ORDERBOOK
    list($asks,$bids,$topAskPrice,$topBidPrice,$tradeType) = OrderbookTop($symbol);
    $topBidPrice  = (float)$topBidPrice; //convert string to float
    $topAskPrice  = (float)$topAskPrice; //convert string to float

    //PROCESS ORDERS
    $orderProcessed = 0; //orders processed
    while ($topBidPrice >= $topAskPrice) 
    {   $topAskUID = (int)($asks[0]["uid"]); //order id; unique id
        $topAskSymbol = ($asks[0]["symbol"]); //symbol of equity
        $topAskSide = ($asks[0]["side"]); //bid or ask
        $topAskDate = ($asks[0]["date"]);
        $topAskType = ($asks[0]["type"]); //limit or market
        $topAskSize = (int)($asks[0]["quantity"]); //size or quantity of trade
        $topAskUser = (int)($asks[0]["id"]); //user id
        $topBidUID = (int)($bids[0]["uid"]); //order id; unique id
        $topBidSymbol = ($bids[0]["symbol"]);
        $topBidSide = ($bids[0]["side"]); //bid or ask
        $topBidDate = ($bids[0]["date"]);
        $topBidType = ($bids[0]["type"]); //limit or market
        $topBidSize = (int)($bids[0]["quantity"]);
        $topBidUser = (int)($bids[0]["id"]);
        $topBidUnits = (float)($bids[0]["total"]);

        $orderProcessed++; //orders processed plus 1

        if ($topBidPrice >= $topAskPrice) //TRADES ARE POSSIBLE
        {
            //START TRANSACTION
            query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

            //DETERMINE EXECUTED PRICE (bid or ask) BY EARLIER DATE TIME using UID
            if ($topBidUID < $topAskUID) { $tradePrice = $topBidPrice;} //with dates or uid, the smaller one is older  
            elseif ($topBidUID > $topAskUID) { $tradePrice = $topAskPrice; } 
            else {  query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Size Failure: #2"); } //rollback on failure

            //DETERMINE TRADE SIZE
            if ($topBidSize <= $topAskSize) { $tradeSize = $topBidSize;}  //BID IS SMALLER SO DELETE AND UPDATE ASK ORDER
            elseif ($topBidSize > $topAskSize) { $tradeSize = $topAskSize;}
            else {  query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Size Failure: #9"); } //rollback on failure
            if ($tradeSize == 0) {apologize("Trade Size is 0"); } //catch if trade size is null or zero
            
            //TRADE AMOUNT
            $tradeAmount = ($tradePrice * $tradeSize);
            $tradeAmount = round($tradeAmount, 2);
            if ($tradeAmount == 0) {apologize("Trade Amount is 0");}
            //COMMISSION AMOUNT
            $commissionAmount = getCommission($tradeAmount);

            ////////////
            //ORDERBOOK
            /////////////

            //ASK INFO
            $orderbookQuantity = query("SELECT quantity FROM orderbook WHERE (uid = ?)", $topAskUID);
            $orderbookQuantity = (int)$orderbookQuantity[0]["quantity"];
           // apologize(var_dump(get_defined_vars()));

            //REMOVE SHARES FROM ASK USER
            //IF SELLER TRYING TO SELL MORE THEN THEY OWN CANCEL ORDER
            if ($tradeSize > $orderbookQuantity) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topAskUID);
                apologize("Seller does not have enough quantity. All seller's orders deleted."); }
            //UPDATE ASK ORDER //REMOVE QUANTITY
            if (query("UPDATE orderbook SET quantity=(quantity-?) WHERE uid=?", $tradeSize, $topAskUID) === false)
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Size OB Failure: #3"); } //rollback on failure


            // UPDATE BID ORDER //REMOVE units FUNDS
            $orderbookUnitsQ = query("SELECT total FROM orderbook WHERE uid=?", $topBidUID);
            $orderbookUnits = (float)$orderbookUnitsQ[0]["total"];
            //apologize(var_dump(get_defined_vars()));

            //IF BUYER DOESN'T HAVE ENOUGH FUNDS CANCEL ORDER
            if ($orderbookUnits < $tradeAmount)
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topBidUID); apologize("Buyer does not have enough funds. Buyers orders deleted"); }
            if (query("UPDATE orderbook SET quantity=(quantity-?), total=(total-?) WHERE uid=?", $tradeSize, $tradeAmount, $topBidUID) === false)
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update OB Failure: #5"); }

            ///////////
            //ACCOUNTS
            ///////////
            //GIVE UNITS TO ASK USER MINUS COMMISSION
            if (query("UPDATE accounts SET units = (units + ? - ?) WHERE id = ?", $tradeAmount, $commissionAmount, $topAskUser) === false)
            { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update Accounts Failure: #11"); }
            //GIVE COMMISSION TO ADMIN/OWNER
            if ($commissionAmount > 0)
            {   if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commissionAmount, $adminid) === false)
                    { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update Accounts Failure: #11a"); }
            }

            ///////////
            //PORTFOLIO
            ///////////
            $askPortfolio = query("SELECT quantity FROM portfolio WHERE (symbol=? AND id=?)", $symbol, $topBidUser);
            $askPortfolio = $askPortfolio[0]["quantity"];
            // DELETE IF TRADE IS ALL THEY OWN
            if($askPortfolio == 0) {if (query("DELETE FROM portfolio WHERE (id = ? AND symbol = ?)", $topAskUser, $symbol) === false)
                 { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #14"); } }
            // QUANTITY WERE REMOVED WHEN PUT INTO ORDERBOOK BUT NEED TO UPDATE PRICE
            elseif($askPortfolio ==1) {if (query("UPDATE portfolio SET price = (price - ? - ?) WHERE (id = ? AND symbol = ?)", $tradeAmount, $commissionAmount, $topAskUser, $symbol) === false)
                 { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #14a"); } }
            else { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #14b"); }

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
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #19"); } }
            //ERROR: TO MANY ROWS
            else { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #20"); }  //apologize(var_dump(get_defined_vars()));

            ///////////
            //TRADE
            ///////////  
            if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $topBidUser, $topAskUser, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount, $tradeType, $topBidUID, $topAskUID) === false)  { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #21a"); }


            ///////////
            //HISTORY
            ///////////  
            //UPDATE HISTORY BUYER (COMMISSION AND TRADE TOTAL)
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topBidUser, 'BUY', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount) === false) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #21b"); }
            //UPDATE HISTORY SELLER (NO COMMISSION AND TRAD EAMOUNT)
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topAskUser, 'SELL', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount) === false) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #21c"); }
            //UPDATE HISTORY ADMIN (COMMISSION AND TRADE TOTAL)
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $adminid, 'COMMISSION', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount) === false) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #21d"); }

            //ALL THINGS OKAY, COMMIT TRANSACTIONS
            query("COMMIT;"); //If no errors, commit changes
            query("SET AUTOCOMMIT=1");

            //NEGATIVE VALUE CHECK
            negativeValues();

            //CHECK TO SEE IF ORDER HAS ZERO QUANTITY
            zeroQuantityCheck($symbol);
                
            //RECALCULATE VALUES FOR DO-WHILE //RECHECK FROM BEGINNING TO SEE IF ANY MORE ORDERS TO PROCESS)
            list($asks,$bids,$topAskPrice,$topBidPrice,$tradeType) = OrderbookTop($symbol);
            @$topBidPrice  = (float)$topBidPrice; //convert string to float
            @$topAskPrice  = (float)$topAskPrice; //convert string to float
        } //IF TRADES ARE POSSIBLE
        elseif($topBidPrice < $topAskPrice)
        {
            return('No Trades Possible');
        } //{apologize("No trades possible!");} //TRADES ARE NOT POSSIBLE
        else {apologize("ERROR!");}

    } //BOTTOM of WHILE STATEMENT
    
    $topAskPrice = ($asks[0]["price"]); //limit price
    $topBidPrice = ($bids[0]["price"]); 
    $topAskUID = ($asks[0]["uid"]); //order id; unique id
    $topAskSymbol = ($asks[0]["symbol"]); //symbol of equity
    $topAskSide = ($asks[0]["side"]); //bid or ask
    $topAskDate = ($asks[0]["date"]);
    $topAskType = ($asks[0]["type"]); //limit or market
    $topAskSize = ($asks[0]["quantity"]); //size or quantity of trade
    $topAskUser = ($asks[0]["id"]); //user id
    $topBidUID = ($bids[0]["uid"]); //order id; unique id
    $topBidSymbol = ($bids[0]["symbol"]);
    $topBidSide = ($bids[0]["side"]); //bid or ask
    $topBidDate = ($bids[0]["date"]);
    $topBidType = ($bids[0]["type"]); //limit or market
    $topBidSize = ($bids[0]["quantity"]);
    $topBidUser = ($bids[0]["id"]);
    $topBidUnits = ($bids[0]["total"]);
    //LAST TRADE INFO TO RETURN ON FUNCTION
    if ($topAskType == 'market') { $topAskPrice = 'market'; } //null//$tradePrice;}     //since the do while loop gives it the next orders price, not the last traded
    if ($topBidType == 'market') { $topBidPrice = 'market'; } //null// $tradePrice;}     //since the do while loop gives it the next orders price, not the last traded
    $orderbook['topAskPrice'] = $topAskPrice;
    $orderbook['topAskUID'] = $topAskUID; //order id; unique id
    $orderbook['topAskSymbol'] = $topAskSymbol; //symbol of equity
    $orderbook['topAskSide'] = $topAskSide; //bid or ask
    $orderbook['topAskDate'] = $topAskDate;
    $orderbook['topAskType'] = $topAskType; //limit or market
    $orderbook['topAskSize'] = $topAskSize; //size or quantity of trade
    $orderbook['topAskUser'] = $topAskUser; //user id
    $orderbook['topBidPrice'] = $topBidPrice;
    $orderbook['topBidUID'] = $topBidUID; //order id; unique id
    $orderbook['topBidSymbol'] = $topBidSymbol;
    $orderbook['topBidSide'] = $topBidSide; //bid or ask
    $orderbook['topBidDate'] = $topBidDate;
    $orderbook['topBidType'] = $topBidType; //limit or market
    $orderbook['topBidSize'] = $topBidSize;
    $orderbook['topBidUser'] = $topBidUser;

    
    
    
    $orderbook['orderProcessed'] = $orderProcessed;
    if (empty($tradePrice)) {$tradePrice = 0;} //if no trades so should be empty
    $orderbook['tradePrice'] = $tradePrice;
    $orderbook['tradeType'] = $tradeType;
    return $orderbook;
} //END OF FUNCTION


////////////////////////////////////
//PLACE ORDER
////////////////////////////////////
function placeOrder($symbol, $type, $side, $quantity, $price, $id)
{   //require 'constants.php'; //for $divisor
    $divisor = 0.25;

    if (empty($symbol) || empty($quantity) ||  empty($type) || empty($side)) { apologize("Please fill all required fields (Symbol, Quantity, Type, Side)."); } //check to see if empty
    if ($type=="limit"){ if(empty($price)){apologize("Limit order requires price");}}
    
    //QUERY TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    if (count($symbolCheck) != 1) {apologize("Incorrect Symbol. Not listed on the exchange!");} //row count
    //CHECKS INPUT
    if (preg_match("/^\d+$/", $quantity) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    if (!ctype_alnum($symbol)) {apologize("Symbol must be alphanumeric!");}
    if(!ctype_alpha($type) || !ctype_alpha($side)) { apologize("Type and side must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
    if (!is_int($quantity) ) { apologize("Quantity must be numeric!");} //if quantity is numeric
    if($quantity < 0){apologize("Quantity must be positive!");}
    $symbol = strtoupper($symbol); //cast to UpperCase

    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit



    if($type=='limit')
    {
        //CHECK PRICE
        if (empty($price)) { apologize("Limit orders require price."); }
        $priceModulus = fmod($price, $divisor); //$divisor set in constants
        if($priceModulus != 0){apologize("Not correct increment. $divisor");} //checks to see if quarter increment
        if (!is_float($price)) { apologize("Price is not a number");} //if quantity is numeric

        //NEW VARS FOR DB INSERT

        if($side=='a')//limit
        {   $transaction = 'ASK';
            $tradeAmount = 0;

            //CHECK TO SEE IF SELLER HAS ENOUGH SHARES
            $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
            if(empty($userQuantity)){$userQuantity = 0;}
            $userQuantity = @(float)$userQuantity[0]["quantity"];
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN units
            if ($userQuantity < $quantity)
            {   query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You only have: " . $userQuantity . ". Attempted to sell: " . $quantity . "." );
            }
            else
            {   if(query("UPDATE portfolio SET quantity = (quantity - ?) WHERE (id = ? AND symbol = ?)", $quantity, $id, $symbol) === false)
            { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure 1"); } //add it to the orderbook
            }
        }

        if($side=='b')//limit
        {   $transaction = 'BID';
            $tradeAmount = $price * $quantity;        // calculate total value (stock's price * quantity)
            $tradeAmount = round($tradeAmount, 2);  //redundant...

            //QUERY CASH & UPDATE
            $unitsQ =	query("SELECT units FROM accounts WHERE id = ?", $id); //query db how much cash user has
            $userUnits = (float)$unitsQ[0]['units'];	//convert array from query to value
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN units
            if ($userUnits < $tradeAmount) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You do not have enough for this transaction. You only have: " . $userUnits . ". Attempted to buy: " . $tradeAmount . "." ); }
            if ($userUnits < 0) {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You have a negative balance!");}
            else
            {   if(query("UPDATE accounts SET units = (units - ?) WHERE id = ?", $tradeAmount, $id) === false)
            {   query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure 2");
            }
            }
        }

    }

    if($type=='market')
    {


        if ($side == 'a')//on market
        {
            $transaction = 'ASK';
            $otherSide='b';
            $tradeAmount =0;

            //CHECK TO SEE IF SELLER HAS ENOUGH SHARES
            $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
            if(empty($userQuantity)){$userQuantity = 0;}
            $userQuantity = @(float)$userQuantity[0]["quantity"];
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN units
            if ($userQuantity < $quantity)
            {   query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You only have: " . $userQuantity . ". Attempted to sell: " . $quantity . "." );
            }
            else
            {   if(query("UPDATE portfolio SET quantity = (quantity - ?) WHERE (id = ? AND symbol = ?)", $quantity, $id, $symbol) === false)
            { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure 3"); }
            }
        }

        if($side=='b')//on market
        {
            $transaction = 'BID';
            $otherSide='a';
            //NEW VARS FOR DB INSERT
            $bidFunds = query("SELECT units FROM accounts WHERE id = ?", $id);
            $tradeAmount = $bidFunds[0]["units"]; //market orders lock all of the users funds
            $tradeAmount = round($tradeAmount, 2);  //redundant...

            //QUERY CASH & UPDATE
            $unitsQ =	query("SELECT units FROM accounts WHERE id = ?", $id); //query db how much cash user has
            $userUnits = (float)$unitsQ[0]['units'];	//convert array from query to value
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN units
            if ($userUnits < $tradeAmount) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You do not have enough for this transaction. You only have: " . $userUnits . ". Attempted to buy: " . $tradeAmount . "." ); }
            if ($userUnits <= 0) {query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You do not have enough funds!");}
            else
            {   if(query("UPDATE accounts SET units = (units - ?) WHERE id = ?", $tradeAmount, $id) === false)
            {   query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure 4");
            }
            }
        }

        //CHECK FOR LIMIT ORDERS
        $limitOrdersQ = query("SELECT SUM(quantity) AS limitorders FROM orderbook WHERE (type = 'limit' AND side = ?)", $otherSide);
        $limitOrders = $limitOrdersQ[0]['limitorders'];
        if (is_null($limitOrders) || $limitOrders == 0) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("No limit orders.");}

        $price=0;//market order

    }


    //UPDATE HISTORY
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)", $id, $transaction, $symbol, $quantity, $price, $tradeAmount) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Insert History Failure 3"); }

    //INSERT INTO ORDERBOOK
    if (query("INSERT INTO orderbook (symbol, side, type, price, total, quantity, id) VALUES (?, ?, ?, ?, ?, ?, ?)", $symbol, $side, $type, $price, $tradeAmount, $quantity, $id) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Insert Orderbook Failure"); }


    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    
    return array($transaction, $symbol, $tradeAmount, $quantity);
}


?>
