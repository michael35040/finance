<?php
//apologize(var_dump(get_defined_vars()));

/////////////////////////////////
//COMMISSION
///////////////////////////////////
function getCommission($total)
{
    $divisor = 0.25;
    $commission = 0.00;
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
function cancelOrder($indentity, $type)
{   
    if($type=="all") //delete all of the users orders based on ID/user
    {
        $order = query("SELECT * FROM orderbook WHERE id = ? LIMIT 0, 1", $indentity);
        while(!empty($order))
        {   query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
            if (query("DELETE FROM orderbook WHERE (uid = ?)", $indentity) === false) 
            {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                apologize("Failure Cancel 1"); }
            @$side=$order[0]["side"];
            if($side=='a')
            
            {   if (query("UPDATE portfolio SET quantity = (quantity + ?), locked = (locked - ?) WHERE (symbol = ? AND id = ?)", $order[0]['quantity'], $order[0]['quantity'], $order[0]['symbol'], $order[0]['id']) === false)
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 2"); }
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'ask') === false) 
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 3"); } }
            elseif($side=='b')
            
            {   if (query("UPDATE accounts SET units = (units + ?), locked = (locked - ?) WHERE id = ?", $order[0]["locked"], $order[0]["locked"], $order[0]["id"]) === false) //MOVE CASH TO LOCKED FUNDS
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 4");}
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'bid') === false) 
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 5"); } }
        $order = query("SELECT * FROM orderbook WHERE id = ? LIMIT 0, 1", $indentity);        
        }
    }
    else //type is single based on UID
    {
         $order = query("SELECT * FROM orderbook WHERE uid = ?", $indentity);
        if(!empty($order))
        {   query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
            if (query("DELETE FROM orderbook WHERE (uid = ?)", $indentity) === false) 
            {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                apologize("Failure Cancel 1"); }
            @$side=$order[0]["side"];
            if($side=='a')
            
            {   if (query("UPDATE portfolio SET quantity = (quantity + ?), locked = (locked - ?) WHERE (symbol = ? AND id = ?)", $order[0]['quantity'], $order[0]['quantity'], $order[0]['symbol'], $order[0]['id']) === false)
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 2"); }
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'ask') === false) 
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 3"); } }
            elseif($side=='b')
            
            {   if (query("UPDATE accounts SET units = (units + ?), locked = (locked - ?) WHERE id = ?", $order[0]["locked"], $order[0]["locked"], $order[0]["id"]) === false) //MOVE CASH TO LOCKED FUNDS
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 4");}
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting order', 'bid') === false) 
                {   query("ROLLBACK"); query("SET AUTOCOMMIT=1");
                    apologize("Failure Cancel 5"); } }       
    }
        //var_dump(get_defined_vars());
        //apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting market order.");
        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");
    } //!empty
}

////////////////////////////////////
//CHECK FOR 0 QTY ORDERS AND REMOVES
////////////////////////////////////
function zeroQuantityCheck($symbol)
{   $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (symbol = ? AND quantity = 0) LIMIT 0, 1", $symbol);
    $cancelOrders = 0;
    while(!empty($emptyOrders))
    {   $cancelOrders++;
        cancelOrder($emptyOrders[0]["uid"], "single");
        $emptyOrders = query("SELECT quantity, uid FROM orderbook WHERE (symbol = ? AND quantity = 0) LIMIT 0, 1", $symbol); }
    return($cancelOrders);
}

////////////////////////////////////
//CHECK FOR NEGATIVE VALUES
////////////////////////////////////
function negativeValues()
{   $negativeValueOrderbook = query("SELECT quantity, locked, uid FROM orderbook WHERE (quantity < 0 OR locked < 0) LIMIT 0, 1");
    if(!empty($negativeValueOrderbook)) { apologize(var_dump(get_defined_vars())); apologize("Negative Orderbook Values: " . $negativeValueOrderbook[0]["uid"]);}
        //eventually all users order using id
    $negativeValueAccounts = query("SELECT units, locked, id FROM accounts WHERE (units < 0 OR locked < 0) LIMIT 0, 1");
    if(!empty($negativeValueAccounts)) { apologize(var_dump(get_defined_vars())); apologize("Negative Accounts Values: " . $negativeValueAccounts[0]["id"]);}
        //eventually all users order using id    
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
                    cancelOrder($marketOrders[0]["uid"], "single");
                    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol, 'b');
                    $asks = query("SELECT 	* FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a'); }
                $bids = $marketOrders;
                //assign top price to the ask since it is a bid market order
                @$topAskPrice = ($asks[0]["price"]); //limit price
                @$topBidPrice = ($asks[0]["price"]); }
            elseif($marketSide == 'a')
            {   $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
                while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'a') && (empty($bids)))
                {   cancelOrder($marketOrders[0]["uid"], "single");
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
//EXCHANGE MARKET
////////////////////////////////////
function orderbook($symbol) 
{
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
        $topBidLocked = (float)($bids[0]["locked"]);

        $orderProcessed++; //orders processed plus 1

        if ($topBidPrice >= $topAskPrice) //TRADES ARE POSSIBLE
        {   //DETERMINE EXECUTED PRICE (bid or ask) BY EARLIER DATE TIME using UID
            if ($topBidUID < $topAskUID) { $tradePrice = $topBidPrice;} //with dates or uid, the smaller one is older  
            elseif ($topBidUID > $topAskUID) { $tradePrice = $topAskPrice; } 
            else {apologize("Date Failure: #2");}
            
            //START TRANSACTION
            query("SET AUTOCOMMIT=0");
            query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit


            //DETERMINE TRADE SIZE
            if ($topBidSize <= $topAskSize) { $tradeSize = $topBidSize;}  //BID IS SMALLER SO DELETE AND UPDATE ASK ORDER
            elseif ($topBidSize > $topAskSize) { $tradeSize = $topAskSize;}
            else {  query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Size Failure: #9"); } //rollback on failure
            if ($tradeSize == 0) {apologize("Trade Size is 0"); } //catch if trade size is null or zero
            

            $tradeAmount = ($tradePrice * $tradeSize);
            $tradeAmount = round($tradeAmount, 2);
            if ($tradeAmount == 0) {apologize("Trade Amount is 0");}
            
            $commissionAmount = getCommission($tradeAmount);

            ////////////
            //ORDERBOOK
            /////////////
            //UPDATE ASK ORDER
            if (query("UPDATE orderbook SET quantity=quantity-? WHERE uid=?", $tradeSize, $topAskUID) === false) 
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Size OB Failure: #3"); } //rollback on failure
            // UPDATE BID ORDER
            if (query("UPDATE orderbook SET quantity=quantity-? WHERE uid=?", $tradeSize, $topBidUID) === false) 
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update OB Failure: #5"); }
            // UPDATE BID ORDER LOCKED AMOUNT
            if (query("UPDATE orderbook SET locked=locked-? WHERE uid=?", $tradeAmount, $topBidUID) === false) 
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update OB Failure: #5a"); }            
 
            ///////////
            //ACCOUNTS
            ///////////           
            //BID INFO
            $bidFunds = query("SELECT locked, units FROM accounts WHERE id=?", $topBidUser);
            $bidFundsLocked = $bidFunds[0]["locked"];
            $bidFundsUnits = $bidFunds[0]["units"];
            //IF BUYER DOESN'T HAVE ENOUGH FUNDS CANCEL ORDER
            if ($bidFundsLocked < $tradeAmount || $bidFundsUnits < 0 || $bidFundsLocked < 0) 
                {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topBidUser, "all"); 
                apologize("Buyer does not have enough funds. Buyers orders deleted"); }
            //REMOVE LOCKED FUNDS
            else {  if (query("UPDATE accounts SET locked = (locked - ?) WHERE id = ?", $tradeAmount, $topBidUser) === false)
                        { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update Accounts Failure: #10");}
                    //GIVE UNITS TO ASK USER MINUS COMMISSION
                    if (query("UPDATE accounts SET units = (units + ? - ?) WHERE id = ?", $tradeAmount, $commissionAmount, $topAskUser) === false) 
                        { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update Accounts Failure: #11"); }
                    //GIVE COMMISSION TO ADMIN/OWNER
                    if ($commissionAmount > 0) 
                    {   if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commissionAmount, $adminid) === false) 
                        { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Update Accounts Failure: #11a"); } } 
            } //ELSE
            
            
            ///////////
            //PORTFOLIO
            ///////////  
            //checks for ownership for insert or update
            //ASK INFO            
            $askQuantityLocked = query("SELECT quantity, locked FROM portfolio WHERE (id = ? AND symbol = ?)", $topAskUser, $symbol); 
            @$askQuantity = (float) $askQuantityLocked[0]["quantity"];
            @$askLocked = (float) $askQuantityLocked[0]["locked"];
            
            //REMOVE SHARES FROM ASK USER
            //IF SELLER TRYING TO SELL MORE THEN THEY OWN CANCEL ORDER
            if ($tradeSize > $askLocked) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); cancelOrder($topAskUser, "all"); 
                apologize("Seller does not have enough quantity. All seller's orders deleted."); }
            // DELETE IF TRADE IS ALL THEY OWN 
            elseif($tradeSize == $askLocked && $askQuantity == 0)  //update portfolio sells what they have, delete the row
                {if (query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $topAskUser, $symbol) === false) { query("ROLLBACK"); 
                    query("SET AUTOCOMMIT=1"); apologize("Failure: #14"); } }
            // UPDATE IF ONLY A PARTIAL SALE
            elseif(($tradeSize <= $askLocked) && ($askQuantity >= 0)) 
            {   if (query("UPDATE portfolio SET locked = (locked - ?), price = (price - ? - ?) WHERE id = ? AND symbol = ?", $tradeSize, $tradeAmount, $commissionAmount, $topAskUser, $symbol) === false) 
                    { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #15"); } }
            else { query("ROLLBACK"); query("SET AUTOCOMMIT=1");apologize("Failure: #16"); }
            
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
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $adminid, 'COMMISSION', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeAmount) === false) { query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Failure: #21c"); }

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
        elseif($topBidPrice < $topAskPrice) {apologize("No trades possible!");} //TRADES ARE NOT POSSIBLE
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
    $topBidLocked = ($bids[0]["locked"]);
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

    if (preg_match("/^\d+$/", $quantity) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    if (!ctype_alnum($symbol)) {apologize("Symbol must be alphanumeric!");}
    if(!ctype_alpha($type) || !ctype_alpha($side)) { apologize("Type and side must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
    if (!is_int($quantity) ) { apologize("Quantity must be numeric!");} //if quantity is numeric
    if($quantity < 0){apologize("Quantity must be positive!");}
    $symbol = strtoupper($symbol); //cast to UpperCase

    if($type=='limit'){
        if (empty($price)) { apologize("Limit orders require price."); }
        $priceModulus = fmod($price, $divisor); //$divisor set in constants
        if($priceModulus != 0){apologize("Not correct increment. $divisor");} //checks to see if quarter increment
        if (!is_float($price)) { apologize("Price is not a number");} //if quantity is numeric
    }
    //NEW VARS FOR DB INSERT
    $tradeAmount = $price * $quantity;        // calculate total value (stock's price * quantity)
    $tradeAmount = round($tradeAmount, 2);  //redundant...

    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    if($type=='market')
    {   $price=0;//market order
        if ($side == 'a') {$otherSide='b';}
        elseif ($side=='b') 
        {   $otherSide='a';
            //lock all of the users funds for market orders
            $bidFunds = query("SELECT units FROM accounts WHERE id = ?", $id);
            $lockedUnits = $bidFunds[0]["units"]; }
        else {  query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("error");}
        $limitOrdersQ = query("SELECT SUM(quantity) AS limitorders FROM orderbook WHERE (type = 'limit' AND side = ?)", $otherSide);
        $limitOrders = $limitOrdersQ[0]['limitorders'];
        if (is_null($limitOrders) || $limitOrders == 0){ query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("No limit orders.");} }
    if ($side == 'b')
    {   $transaction = 'BID';
        if($type=='limit') { $lockedUnits=$tradeAmount; }
        //QUERY CASH & UPDATE
        $units =	query("SELECT units, locked FROM accounts WHERE id = ?", $id); //query db how much cash user has
        $units = (float)$units[0]['units'];	//convert array from query to value
        $userLocked = (float)$units[0]['locked']; //different then $lockedUnits which is the tradeAmount for limit or all of the units for market order
        //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
        if ($units < $lockedUnits) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You do not have enough for this transaction. You only have: " . $units . ". Attempted to buy: " . $tradeAmount . "." ); }
        if (($units < 0) || ($userLocked < 0)) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You have a negative balance!"); }
        else 
        {   if(query("UPDATE accounts SET units = (units - ?), locked = (locked + ?) WHERE id = ?", $lockedUnits, $lockedUnits, $id) === false) //MOVE CASH TO LOCKED FUNDS
            { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure"); } } 
        } // transaction type for history	//b for bid
        
    elseif ($side == 'a')
    {   $lockedUnits = 0; //all sell ask orders lock zero units
        $transaction = 'ASK'; //QUERY CASH & UPDATE
        $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
        if(empty($userQuantity)){$userQuantity = 0;}
        $userQuantity = @(float)$userQuantity[0]["quantity"];
        //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
        if ($userQuantity < $quantity) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("You only have: " . $userQuantity . ". Attempted to sell: " . $quantity . "." ); }
        else 
        {   if(query("UPDATE portfolio SET quantity = (quantity - ?), locked = (locked + ?) WHERE (id = ? AND symbol = ?)", $quantity, $quantity, $id, $symbol) === false) //MOVE CASH TO LOCKED FUNDS
                { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Updates Accounts Failure"); } }
    }	// transaction type for history //a for ask
    else { apologize("Order Side Error."); }
    //UPDATE HISTORY
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)", $id, $transaction, $symbol, $quantity, $price, $tradeAmount) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Insert History Failure 3"); }
    //INSERT INTO ORDERBOOK
    if (query("INSERT INTO orderbook (symbol, side, type, price, locked, quantity, id) VALUES (?, ?, ?, ?, ?, ?, ?)", $symbol, $side, $type, $price, $lockedUnits, $quantity, $id) === false) { query("ROLLBACK");  query("SET AUTOCOMMIT=1"); apologize("Insert Orderbook Failure"); }


    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    
    return array($transaction, $symbol, $tradeAmount, $quantity);
}


?>
