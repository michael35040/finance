<?php

////////////////////////////////////
//PLACE ORDER
////////////////////////////////////
function placeOrder($symbol, $quantity, $type, $side, $id)
{
    if (empty($symbol) || empty($quantity) ||  empty($type) || empty($side)) { apologize("Please fill all required fields (Symbol, Quantity, Type, Side)."); } //check to see if empty

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
    $commissionTotal = $commission * $tradeAmount; //commission set in finance.php//$commission = 00.0599; //CHANGE THIS VARIABLE TO SET COMMISSION PERCENTAGE //(Ex 00.1525 is 15.25%)
    $tradeTotal = ($tradeAmount + $commissionTotal);

    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    if($type=='market')
    {
            //check to see if any limit orders exists
            $price=0;//market order
            if ($side == 'a')
                {$otherSide='b';}
            elseif ($side=='b')
                {   $otherSide='a';
                    //lock all of the users funds for market orders
                    $bidFunds = query("SELECT units FROM accounts WHERE id = ?", $id);
                    $lockedUnits = $bidFunds[0]["units"]; 
                }
            else{   query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("error");}
            $limitOrdersQ = query("SELECT SUM(quantity) AS limitorders FROM orderbook WHERE (type = 'limit' AND side = ?)", $otherSide);
            $limitOrders = $limitOrdersQ[0]['limitorders'];
            if (is_null($limitOrders) || $limitOrders == 0 || $limitorder < $quantity){
                query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                apologize("Market Orders require an active Limit Order on the exchange for matching. Not enough or no Limit Orders currently on the exchange.");}

    }

        if ($side == 'b'):
        {
            $transaction = 'BID';
            if($type=='limit') { $lockedUnits=$tradeTotal; }
            //QUERY CASH & UPDATE
            $units =	query("SELECT units FROM accounts WHERE id = ?", $id); //query db how much cash user has
            $units = $units[0]['units'];	//convert array from query to value
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
            if ($units < $lockedUnits)
            {
                query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                apologize("You do not have enough for this transaction. You only have: " . $units . ". Attempted to buy: " . $tradeTotal . "." );
            }
            else 
            {
                if(query("UPDATE accounts SET units = (units - ?), locked = (locked + ?) WHERE id = ?", $lockedUnits, $lockedUnits, $id) === false) //MOVE CASH TO LOCKED FUNDS
                {
                    query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Updates Accounts Failure");
                }
            }

        } // transaction type for history	//b for bid
        elseif ($side == 'a'):
        {
            $lockedUnits = 0; //all sell ask orders lock zero units
            $transaction = 'ASK'; //QUERY CASH & UPDATE
            $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
            $userQuantity = @(float)$userQuantity[0]["quantity"];
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
            if ($userQuantity < $quantity)
            {
                query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                apologize("You do not have enough for this transaction. You only have: " . $userQuantity . ". Attempted to sell: " . $quantity . "." );
            }
            else 
            {
                if(query("UPDATE portfolio SET quantity = (quantity - ?), locked = (locked + ?) WHERE (id = ? AND symbol = ?)", $quantity, $quantity, $id, $symbol) === false) //MOVE CASH TO LOCKED FUNDS
                {
                    query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Updates Accounts Failure");
                }
            }
        }	// transaction type for history //a for ask
        else: { apologize("Order Side Error."); }
        endif;

        if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, $transaction, $symbol, $quantity, $price, $commissionTotal, $tradeTotal) === false)
        {   //UPDATE HISTORY
                query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
            apologize("Insert History Failure 3");
        }
        if (query("INSERT INTO orderbook (symbol, side, type, price, locked, quantity, id) VALUES (?, ?, ?, ?, ?, ?, ?)", $symbol, $side, $type, $price, $lockedUnits, $quantity, $id) === false)
        {   //INSERT INTO ORDERBOOK
            query("ROLLBACK");  query("SET AUTOCOMMIT=1"); //rollback on failure
            apologize("Insert Orderbook Failure");
        }


    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
    
    return array($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal);
}



////////////////////////////////////
//CANCEL ORDER
////////////////////////////////////
function cancelOrder($uid)
{  
    $order = query("SELECT * FROM orderbook WHERE uid = ? ORDER BY uid ASC LIMIT 0, 1", $uid);

    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
    //Delete market order from orderbook since no limit ask orders exist
    if (query("DELETE FROM orderbook WHERE (uid = ?)", uid) === false) {
        query("ROLLBACK");
        query("SET AUTOCOMMIT=1");
        apologize("Failure Cancel 1");
    }

    $side=$order[0]["side"];
    if($side=='a')
    {
        //unlock locked shares
        if (query("UPDATE portfolio SET quantity = (quantity + ?), locked = (locked - ?) WHERE (symbol = ? AND id = ?)", $order[0]['size'], $order[0]['size'], $order[0]['symbol'], $order[0]['id']) === false)
        {
            query("ROLLBACK");
            query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 2");
        }
        ///insert event into errors
        if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting/canceling order', 'functions_echange.php') === false) {
            query("ROLLBACK");
            query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 3");
        }
        //var_dump(get_defined_vars());
        //apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting market order.");
        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");
    }
    elseif($side=='b')
    {
        //unlock locked shares
        if (query("UPDATE accounts SET units = (units + ?), locked = (locked - ?) WHERE id = ?", $order[0]["locked"], $order[0]["locked"], $order[0]["id"]) === false) //MOVE CASH TO LOCKED FUNDS
        {
            query("ROLLBACK");
            query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 2");
        }
        ///insert event into errors
        if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'deleting/canceling order', 'functions_echange.php') === false) {
            query("ROLLBACK");
            query("SET AUTOCOMMIT=1");
            apologize("Failure Cancel 3");
        }
        //var_dump(get_defined_vars());
        //apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting market order.");
        query("COMMIT;"); //If no errors, commit changes
        query("SET AUTOCOMMIT=1");
    }
}


function marketOrderCheck($symbol) 
{
        $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol);
        if (!empty($marketOrders)) 
        {
            @$marketSide=$marketOrders[0]["side"];
            $tradeType = 'market';
            if ($marketSide == 'b') 
            {
                $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
                while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'b') && (empty($asks))) 
                {  //cancel all bid market orders since there are no limit ask orders.
                    cancelOrder($marketOrders[0]["uid"]);
                    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol, 'b');
                    $asks = query("SELECT 	* FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
                }
                $bids = $marketOrders;
                //assign top price to the ask since it is a bid market order
                @$topAskPrice = ($asks[0]["price"]); //limit price
                @$topBidPrice = ($asks[0]["price"]);
                @$lockedAmount = ($marketOrders[0]["locked"]);
            }
            elseif($marketSide == 'a') 
            {
                $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
                while ((!empty($marketOrders)) && ($marketOrders[0]["side"] == 'a') && (empty($bids))) 
                {
                    cancelOrder($marketOrders[0]["uid"]);
                    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol, 'a');
                    $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
                }
                $asks = $marketOrders;
                //assign top price to the bid since it is an ask market order
                @$topAskPrice = ($bids[0]["price"]);
                @$topBidPrice = ($bids[0]["price"]);
                @$lockedAmount = ($bids[0]["locked"]);
            }
            else 
            {
            apologize("Market Side Error!");
            }
        }
        elseif(empty($marketOrders)) {
            $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            if (empty($asks)) {
                apologize("No ask limit orders. Unable to cross any orders.");
            }
            if (empty($bids)) {
                apologize("No bid limit orders. Unable to cross any orders.");
            }
            @$topAskPrice = ($asks[0]["price"]); //limit price
            @$topBidPrice = ($bids[0]["price"]);
            $tradeType = 'limit';
            @$lockedAmount = ($bids[0]["locked"]);

        }
        else 
        {
        apologize("Market Order Error!");
        }

    return array($asks, $bids, $topAskPrice, $topBidPrice, $tradeType, $lockedAmount);
}

////////////////////////////////////
//EXCHANGE MARKET
////////////////////////////////////
function orderbook($symbol) {
        //require 'constants.php'; //for $commission
        $commission = 0.05;  //constants.php
        $adminid = 1; //constants.php
        
        ////////////////////////
        //PROCESS MARKET ORDERS
        ////////////////////////
        if(empty($symbol)){apologize("No symbol selected!");}

        //QUERY TO SEE IF SYMBOL EXISTS
        $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
        if (count($symbolCheck) != 1) //row count
            {apologize("Incorrect Symbol. Not listed on the exchange!");}

        list($asks,$bids,$topAskPrice,$topBidPrice,$tradeType, $lockedAmount) = marketOrderCheck($symbol);
        @$topBidPrice  = (float)$topBidPrice; //convert string to float
        @$topAskPrice  = (float)$topAskPrice; //convert string to float

        ////////////////////////
        //PROCESS LIMIT ORDERS
        ////////////////////////
        $orderProcessed = 0; //orders processed
        while ($topBidPrice >= $topAskPrice) {
            //price in above market arg
            @$lockedAmount = (float)$lockedAmount; //convert string to float
            @$topAskUID = ($asks[0]["uid"]); //order id; unique id
            @$topAskSymbol = ($asks[0]["symbol"]); //symbol of equity
            @$topAskSide = ($asks[0]["side"]); //bid or ask
            @$topAskDate = ($asks[0]["date"]);
            @$topAskType = ($asks[0]["type"]); //limit or market
            @$topAskSize = ($asks[0]["quantity"]); //size or quantity of trade
            @$topAskUser = ($asks[0]["id"]); //user id
            //price in above market arg
            @$topBidUID = ($bids[0]["uid"]); //order id; unique id
            @$topBidSymbol = ($bids[0]["symbol"]);
            @$topBidSide = ($bids[0]["side"]); //bid or ask
            @$topBidDate = ($bids[0]["date"]);
            @$topBidType = ($bids[0]["type"]); //limit or market
            @$topBidSize = ($bids[0]["quantity"]);
            @$topBidUser = ($bids[0]["id"]);
            //apologize(var_dump(get_defined_vars())); //dump all variables if i hit error

            $orderProcessed++; //orders processed plus 1

            if ($topBidPrice >= $topAskPrice) //TRADES ARE POSSIBLE
            {
                //DETERMINE EXECUTED PRICE (bid or ask) BY EARLIER DATE TIME (using UID instead of DATE)
                //UID is unique where you can have 2 similar date times.
                //per market rules, first to orderbook sets trade price if they cross
                //ie. bid comes in at 40, then ask comes in at  38, it executes at 40
                //or ask comes in at 38, then bid comes in at 40, it executes at 38
                if ($topBidDate < $topAskDate) //CHECK TO SEE IF THIS SETS THE LATEST DATE, FIRST TO HIT MARKET AS THE TRADE PRICE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                {
                    $tradePrice = $topBidPrice;
                } elseif ($topBidDate > $topAskDate) {
                    $tradePrice = $topAskPrice;
                } elseif ($topBidDate == $topAskDate) {
                    //same time so give cheapest ask/bid as trade price
                    if ($topBidPrice <= $topAskPrice) {
                        $tradePrice = $topBidPrice;
                    } //bid is cheapest so that is trade price
                    elseif ($topBidPrice > $topAskPrice) {
                        $tradePrice = $topAskPrice;
                    } //ask is cheapest
                    else {
                        apologize("Date/Price Failure: #1");
                    }
                } else {
                    apologize("Date Failure: #2");
                }

                query("SET AUTOCOMMIT=0");
                query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit

                //DETERMINE TRADE SIZE
                if ($topBidSize < $topAskSize) {
                    $tradeSize = $topBidSize; //BID IS SMALLER SO DELETE AND UPDATE ASK ORDER
                    $quantityRemaining = ($topAskSize - $topBidSize); //ask has larger qty; update their order with new qty after trade if not 0
                    //UPDATE ASK ORDER;
                    if (query("UPDATE orderbook SET quantity = ? WHERE uid = ?", $quantityRemaining, $topAskUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Size OB Failure: #3");
                    }
                    // DELETE BID ORDER
                    if (query("DELETE FROM orderbook WHERE uid = ?", $topBidUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Delete OB Failure: #4");
                    }
                } elseif ($topBidSize > $topAskSize) {
                    $tradeSize = $topAskSize;
                    $quantityRemaining = $topBidSize - $topAskSize; //bid has larger qty; update their order with new qty after trade if not 0
                    //UPDATE BID; DELETE ASK
                    if (query("UPDATE orderbook SET quantity = ? WHERE uid = ?", $quantityRemaining, $topBidUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Update OB Failure: #5");
                    }
                    // DELETE ASK
                    if (query("DELETE FROM orderbook WHERE uid = ?", $topAskUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Delete OB Failure: #6");
                    }
                } elseif ($topBidSize == $topAskSize) {
                    $tradeSize = $topAskSize;
                    $quantityRemaining = $topBidSize - $topAskSize; //should be 0 since objects are equal
                    //DELETE BOTH ORDERS AFTER TRADE
                    if (query("DELETE FROM orderbook WHERE uid = ?", $topBidUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Delete OB Failure: #7");
                    }
                    if (query("DELETE FROM orderbook WHERE uid = ?", $topAskUID) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Delete OB Failure: #8");
                    }
                } else {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Size Failure: #9");
                }
                //if commission is NOT set, make it zero
                if (!isset($commission)) { $commission = 0;} //set in constants.php
                $commissionAmount = ($commission * ($tradePrice * $tradeSize));
                $tradeAmount = ($tradePrice * $tradeSize);
                $tradeTotal = ($tradeAmount + $commissionAmount);
                if ($tradeSize == 0) {apologize("Trade Size is 0"); } //catch if trade size is null or zero
                if ($tradeAmount == 0) {apologize("Trade Amount is 0");}

                ///////////
                //BID INFO
                //////////
                $bidFunds = query("SELECT locked, units FROM accounts WHERE id = ?", $topBidUser);
                $bidFundsLocked = $bidFunds[0]["locked"];
                $bidFundsUnits = $bidFunds[0]["units"];
                if ($bidFundsUnits < 0) {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    cancelOrder($topBidUID);
                    apologize("Buyer has negative units. Buyers bid orders deleted");
                }
                $returnAmount = ($bidFundsLocked - $tradeTotal); //lockedAmount locked in exchange.php
                //check funds
                if ($bidFundsLocked < $tradeTotal)
                {
                   //since the buyer does not have enough money, delete the his orders ID
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    cancelOrder($topBidUID);
                    apologize("Buyer does not have enough funds. Buyers bid orders deleted");
                }
                //determine what to return to bid user
                else //if($bidFundsLocked >= $tradeTotal) //buyer has enough money
                {
                    ///////////////////////
                    //REMOVE LOCKED FUNDS AND RETURN LEFT OVER UNITS TO BID USER
                    ///////////////////////
                    if (query("UPDATE accounts SET units = (units + ?), locked = (locked - ?) WHERE id = ?", $returnAmount, $tradeTotal, $topBidUser) === false) 
                        { //MOVE CASH TO LOCKED FUNDS
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Update Accounts Failure: #10");
                        }
                    ///////////////////////
                    //GIVE UNITS TO ASK USER
                    //////////////////////
                    if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $tradeAmount, $topAskUser) === false) //tradeAmount since they don't get the commission
                    {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Update Accounts Failure: #11");
                    }
                    if ($commissionAmount > 0)
                    {
                        ///////////////////////
                        //GIVE UNITS TO ADMIN/OWNER
                        ////////////////////////
                        if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commissionAmount, $adminid) === false) //just the commission
                        { //MOVE CASH TO LOCKED FUNDS
                            query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                            apologize("Update Accounts Failure: #11a");
                        }
                    }
                } //else //if($bidFundsLocked >= $tradeTotal) 
                
                //////////
                //ASK INFO            
                /////////            
                $askQuantityLocked = query("SELECT quantity, locked FROM portfolio WHERE (id = ? AND symbol = ?)", $topAskUser, $symbol); //Checks to see if they already own stock to determine if we should insert or update tables
                @$askQuantity = (float) $askQuantityLocked[0]["quantity"];
                @$askLocked = (float) $askQuantityLocked[0]["locked"];
                ////////////////
                //REMOVE SHARES FROM ASK USER
                ////////////////
                // checks to see if they are selling more than they have.
                if ($tradeSize > $askLocked): { //SELLER DOES NOT HAVE ENOUGH SHARES, DELETE SELL ORDER//Not enough money for trade, need to delete order from orderbook
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    cancelOrder($topAskUID);
                    apologize("Seller does not have enough quantity. All seller's ask orders deleted.");
                }

                // delete from portfolio if the trade size is all they have left in locked and they have none left in qty 
                elseif($tradeSize == $askLocked && $askQuantity == 0): //update portfolio sells what they have, delete the row
                    {
                        if (query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $topAskUser, $symbol) === false) {
                            query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                            apologize("Failure: #14");
                        }
                    }
                    //if user still has some shares in quantity, order could be one of many from locked or they have some left in qty
                elseif($tradeSize <= $askLocked && $askQuantity >= 0): //sells less than what they have and it only updates the line
                    {
                        if (query("UPDATE portfolio SET locked = (locked - ?), price = (price - ?) WHERE id = ? AND symbol = ?", $tradeSize, $tradeAmount, $topAskUser, $symbol) === false) {
                            query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                            apologize("Failure: #15");
                        }
                    }
                else :{
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Failure: #16");
                }
                endif;

                ////////////////
                //GIVE SHARES TO BID USER
                ////////////////
                $bidQuantityRows = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $topBidUser, $symbol); //Checks to see if they already own stock to determine if we should insert or update tables
                $countRows = count($bidQuantityRows);
                if (count($countRows) == 0) {
                    if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $topBidUser, $symbol, $tradeSize, $tradeTotal) === false) {
                        query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                        apologize("Failure: #18, Bid Quantity & Trade Size");
                    } //update portfolio
                } //updates if stock already owned
                elseif($countRows == 1) //else update db
                    {
                        if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $tradeSize, $tradeTotal, $topBidUser, $symbol) === false) {
                            query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                            apologize("Failure: #19");
                        } //update portfolio
                    }
                else {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    //apologize(var_dump(get_defined_vars()));
                    //apologize("Failure: #20");
                } //apologizes if first two conditions are not meet

                ////////////////
                //CREATE TRADE & HISTORY
                ////////////////
                if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $topBidUser, $topAskUser, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal, $tradeType, $topBidUID, $topAskUID) === false) {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Failure: #21a");
                }
                //UPDATE HISTORY BUYER (COMMISSION AND TRADE TOTAL)
                if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topBidUser, 'BUY', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal) === false) {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Failure: #21b");
                }
                //UPDATE HISTORY SELLER (NO COMMISSION AND TRAD EAMOUNT)
                if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topAskUser, 'SELL', $symbol, $tradeSize, $tradePrice, 0, $tradeAmount) === false) {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Failure: #21c");
                }
                //UPDATE HISTORY ADMIN (COMMISSION AND TRADE TOTAL)
                if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $adminid, 'COMMISSION', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal) === false) {
                    query("ROLLBACK"); query("SET AUTOCOMMIT=1"); //rollback on failure
                    apologize("Failure: #21c");
                }

                query("COMMIT;"); //If no errors, commit changes
                query("SET AUTOCOMMIT=1");


            }
            elseif($topBidPrice < $topAskPrice) {apologize("NO TRADES POSSIBLE!");} //TRADES ARE NOT POSSIBLE
            else {apologize("ERROR!");}

            ///////////////
            //RECALCULATE VALUES FOR DO-WHILE
            //RECHECK FROM BEGINNING TO SEE IF ANY MORE ORDERS TO PROCESS)
            //////////////
            list($asks,$bids,$topAskPrice,$topBidPrice,$tradeType, $lockedAmount) = marketOrderCheck($symbol);
            @$topBidPrice  = (float)$topBidPrice; //convert string to float
            @$topAskPrice  = (float)$topAskPrice; //convert string to float

        } //BOTTOM of WHILE STATEMENT


        //LAST TRADE INFO TO RETURN ON FUNCTION
        if ($topAskType == 'market') {
            $topAskPrice = 'market';
        } //null//$tradePrice;} //since the do while loop gives it the next orders price, not the last traded
        if ($topBidType == 'market') {
            $topBidPrice = 'market';
        } //null// $tradePrice;} //since the do while loop gives it the next orders price, not the last traded
        $orderbook['topBidPrice'] = $topBidPrice;
        $orderbook['topAskUID'] = $topAskUID; //order id; unique id
        $orderbook['topAskSymbol'] = $topAskSymbol; //symbol of equity
        $orderbook['topAskSide'] = $topAskSide; //bid or ask
        $orderbook['topAskDate'] = $topAskDate;
        $orderbook['topAskType'] = $topAskType; //limit or market
        $orderbook['topAskSize'] = $topAskSize; //size or quantity of trade
        $orderbook['topAskUser'] = $topAskUser; //user id

        $orderbook['topAskPrice'] = $topAskPrice;
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


?>
