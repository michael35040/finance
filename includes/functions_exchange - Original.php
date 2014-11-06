<?php

////////////////////////////////////
////////////////////////////////////
//EXCHANGE MARKET
////////////////////////////////////
/////////////////////////////////////
function orderbook($symbol)
{
    require("constants.php");//for $commission
    ////////////////////////
    //PROCESS MARKET ORDERS
    ////////////////////////

    $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol);
    if (!empty($marketOrders)) {
        $marketSide = ($marketOrders[0]["side"]);
        $tradeType = 'market';

        if ($marketSide == 'b') {
            $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            if (empty($asks)){
                if (query("DELETE FROM orderbook WHERE (symbol = ? AND type = 'market' AND side = ?)", $symbol, $marketSide) === false)
                {apologize("Unable to delete unfilled market bid orders.");}
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'no market bid orders', 'functions.php ln351') === false)
                {   //UPDATE HISTORY
                    apologize("Insert History Failure 1");
                }
                //var_dump(get_defined_vars());
                apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting all bid market orders.");
            }
            $bids = $marketOrders;
            @$topAskPrice = ($asks[0]["price"]); //limit price
            @$topBidPrice = ($asks[0]["price"]);
        } elseif ($marketSide == 'a') {
            $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            if (empty($bids)){
                if (query("DELETE  FROM orderbook WHERE (symbol = ? AND type = 'market' AND side = ?)", $symbol, $marketSide) === false)
                {apologize("Unable to delete unfilled market ask orders.");}
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'no market ask orders', 'functions.php ln351') === false)
                {   //UPDATE HISTORY
                    apologize("Insert History Failure 1");
                }
                //var_dump(get_defined_vars());
                apologize("Market orders require limit orders. No bid limit orders for the ask market order. Deleting all ask market orders.");
            }
            $asks = $marketOrders;
            $topAskPrice = ($bids[0]["price"]); //limit price
            $topBidPrice = ($bids[0]["price"]);
        } else {
            apologize("Market Side Error!");
        }
    } elseif (empty($marketOrders)) {
        $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
        $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
        if (empty($asks)){apologize("No ask limit orders. Unable to cross any orders.");}
        if (empty($bids)){apologize("No bid limit orders. Unable to cross any orders.");}
        @$topAskPrice = ($asks[0]["price"]); //limit price
        @$topBidPrice = ($bids[0]["price"]);
        $tradeType = 'limit';

    } else {
        apologize("Market Order Error!");
    }

    //price in above market arg
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





    //$tradePrice = null; //set here for return in case no orders are processed.

    $orderProcessed = 0; //orders processed

    ////////////////////////
    //PROCESS LIMIT ORDERS
    ////////////////////////
    while ($topBidPrice >= $topAskPrice) {
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
            if ($topBidSize < $topAskSize)
            {
                $tradeSize = $topBidSize; //BID IS SMALLER SO DELETE AND UPDATE ASK ORDER
                $quantityRemaining = ($topAskSize - $topBidSize); //ask has larger qty; update their order with new qty after trade if not 0
                //UPDATE ASK ORDER;
                if (query("UPDATE orderbook SET quantity = ? WHERE uid = ?", $quantityRemaining, $topAskUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Size OB Failure: #3");
                }
                // DELETE BID ORDER
                if (query("DELETE FROM orderbook WHERE uid = ?", $topBidUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Delete OB Failure: #4");
                }
            } elseif ($topBidSize > $topAskSize) {
                $tradeSize = $topAskSize;
                $quantityRemaining = $topBidSize - $topAskSize; //bid has larger qty; update their order with new qty after trade if not 0
                //UPDATE BID; DELETE ASK
                if (query("UPDATE orderbook SET quantity = ? WHERE uid = ?", $quantityRemaining, $topBidUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Update OB Failure: #5");
                }
                // DELETE ASK
                if (query("DELETE FROM orderbook WHERE uid = ?", $topAskUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Delete OB Failure: #6");
                }
            } elseif ($topBidSize == $topAskSize) {
                $tradeSize = $topAskSize;
                $quantityRemaining = $topBidSize - $topAskSize; //should be 0 since objects are equal
                //DELETE BOTH ORDERS AFTER TRADE
                if (query("DELETE FROM orderbook WHERE uid = ?", $topBidUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Delete OB Failure: #7");
                }
                if (query("DELETE FROM orderbook WHERE uid = ?", $topAskUID) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Delete OB Failure: #8");
                }
            } else {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Size Failure: #9");
            }

            if (!isset($commission)) { //if commission is NOT set, make it zero
                $commission = 0;
            } //set in constants.php
            

            $commissionAmount = ($commission * ($tradePrice * $tradeSize));
            $tradeAmount = ($tradePrice * $tradeSize);
            $tradeTotal = ($tradeAmount + $commissionAmount);

            if ($tradeSize == 0){
                //var_dump(get_defined_vars());
                apologize("Trade Size is 0");} //catch if trade size is null or zero
            if ($tradeAmount == 0){
                //var_dump(get_defined_vars());
                apologize("Trade Amount is 0");}


            ///////////
	//BID INFO
	//////////
            $bidFunds = query("SELECT locked FROM accounts WHERE id = ?", $topBidUser);
            @$bidFunds = $bidFunds[0]["locked"];
            if ($bidFunds < $tradeTotal) 
            { //since the buyer does not have enough money, delete the his orders ID
                query("ROLLBACK"); //rollback all previous stuff
                query("SET AUTOCOMMIT=1");
                if (query("DELETE FROM orderbook WHERE (side = 'b' AND id = ? AND symbol = ?)", $topBidUser, $symbol) === false)
                {
                    apologize("Delete OB Failure: #7");
                }            
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $topBidUID, 'BidFunds<TradeTotal', 'functions.php ln533') === false)
	    	    {   //UPDATE HISTORY
	           	apologize("Insert History Failure 1");
	    	    }
                //var_dump(get_defined_vars());
                apologize("Buyer does not have enough funds. Buyers bid orders deleted");
            } 
            elseif ($bidFunds >= $tradeTotal)  //buyer has enough money
            {
	            ///////////////////////
	            //REMOVE LOCKED FROM BID USER
	            ///////////////////////
	            if (query("UPDATE accounts SET locked = (locked - ?) WHERE id = ?", $tradeTotal, $topBidUser) === false) {   //MOVE CASH TO LOCKED FUNDS
	                query("ROLLBACK"); //rollback on failure
	                query("SET AUTOCOMMIT=1");
	                apologize("Update Accounts Failure: #10");
	            }
	            ///////////////////////
	            //GIVE UNITS TO ASK USER
	            //////////////////////
	            if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $tradeAmount, $topAskUser) === false) //tradeAmount since they don't get the commission
	            {   
	                query("ROLLBACK"); //rollback on failure
	                query("SET AUTOCOMMIT=1");
	                apologize("Update Accounts Failure: #11");
	            }
	            ///////////////////////
	            //GIVE UNITS TO ADMIN/OWNER
	            ////////////////////////
	            if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $commissionAmount, 1) === false) //just the commission
	            {   //MOVE CASH TO LOCKED FUNDS
	                query("ROLLBACK"); //rollback on failure
	                query("SET AUTOCOMMIT=1");
	                apologize("Update Accounts Failure: #11a");
	            }
            } //elseif buyfunds >= tradetotall
            else{
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Failue: #12. Bid Fund & Trade Total");}
	//////////
	//ASK INFO            
	/////////            
            $askQuantityLocked = query("SELECT quantity, locked FROM portfolio WHERE (id = ? AND symbol = ?)", $topAskUser, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
            @$askQuantity = (float)$askQuantityLocked[0]["quantity"];
            @$askLocked = (float)$askQuantityLocked[0]["locked"];
            ////////////////
            //REMOVE SHARES FROM ASK USER
            ////////////////
            // checks to see if they are selling more than they have.
            if ($tradeSize > $askLocked):
            { //SELLER DOES NOT HAVE ENOUGH SHARES, DELETE SELL ORDER//Not enough money for trade, need to delete order from orderbook
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                if (query("DELETE FROM orderbook WHERE (symbol=? AND side='a' AND id=?)", $symbol, $topAskUser) === false)
                {
                    apologize("Delete OB Failure: #8");
                }
                if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", $topAskUser, 'tradeSize>askLocked', 'functions.php ln588') === false)
                {   //UPDATE HISTORY
                    apologize("Insert History Failure 1");
                }
                //var_dump(get_defined_vars());
                apologize("Seller does not have enough quantity. All seller's ask orders deleted.");
           }
            
	    // delete from portfolio if the trade size is all they have left in locked and they have none left in qty 
            elseif ($tradeSize == $askLocked && $askQuantity == 0): //update portfolio sells what they have, delete the row
            {
                if (query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $topAskUser, $symbol) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Failure: #14");
                }
            }
            //if user still has some shares in quantity, order could be one of many from locked or they have some left in qty
            elseif ($tradeSize <= $askLocked && $askQuantity >= 0): //sells less than what they have and it only updates the line
            {
                if (query("UPDATE portfolio SET locked = (locked - ?), price = (price - ?) WHERE id = ? AND symbol = ?", $tradeSize, $tradeAmount, $topAskUser, $symbol) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Failure: #15");
                }
            } else: {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Failure: #16");
            }
            endif;

            ////////////////
            //GIVE SHARES TO BID USER
            ////////////////
            $bidQuantityRows = query("SELECT symbol FROM portfolio WHERE (id = ? AND symbol = ?)", $topBidUser, $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
            $countRows=count($bidQuantityRows);
            if (count($countRows) == 0)
            {
                if (query("INSERT INTO portfolio (id, symbol, quantity, price) VALUES (?, ?, ?, ?)", $topBidUser, $symbol, $tradeSize, $tradeTotal) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Failure: #18, Bid Quantity & Trade Size");
                } //update portfolio
            } //updates if stock already owned
            elseif ($countRows == 1) //else update db
            {
                if (query("UPDATE portfolio  SET quantity = (quantity + ?), price = (price + ?) WHERE (id = ? AND symbol = ?)", $tradeSize, $tradeTotal, $topBidUser, $symbol) === false) {
                    query("ROLLBACK"); //rollback on failure
                    query("SET AUTOCOMMIT=1");
                    apologize("Failure: #19");
                } //update portfolio
            } else {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                //apologize(var_dump(get_defined_vars()));
                //apologize("Failure: #20");
            } //apologizes if first two conditions are not meet

            ////////////////
            //CREATE TRADE & HISTORY
            ////////////////
            if (query("INSERT INTO trades (symbol, buyer, seller, quantity, price, commission, total, type, bidorderuid, askorderuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $symbol, $topBidUser, $topAskUser, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal, $tradeType, $topBidUID, $topAskUID) === false) {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Failure: #21a");
            }
            //UPDATE HISTORY BUYER
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topBidUser, 'BUY', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal) === false)
            {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Failure: #21b");
            }
            //UPDATE HISTORY SELLER
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $topAskUser, 'SELL', $symbol, $tradeSize, $tradePrice, $commissionAmount, $tradeTotal) === false)
            {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Failure: #21c");
            }
            //UPDATE HISTORY ADMIN
            if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", 1, 'COMMISSION', $symbol, $topBidUser, $tradePrice, $commissionAmount, $topAskUser) === false)
	    {   //UPDATE HISTORY 
	        query("ROLLBACK"); //rollback on failure	           
	        query("SET AUTOCOMMIT=1");
           	apologize("Insert History Failure 3");
	    }  
	    
	    
            query("COMMIT;"); //If no errors, commit changes
            query("SET AUTOCOMMIT=1");


        } elseif ($topBidPrice < $topAskPrice) //TRADES ARE NOT POSSIBLE
        {
            //var_dump(get_defined_vars());
            apologize("NO TRADES POSSIBLE!");
        } else {
            apologize("ERROR!");
        }

        ///////////////
        //RECALCULATE VALUES FOR DO-WHILE
        //RECHECK FROM BEGINNING TO SEE IF ANY MORE ORDERS TO PROCESS)
        //////////////



        $marketOrders = query("SELECT * FROM orderbook WHERE (symbol = ? AND type = 'market') ORDER BY uid ASC LIMIT 0, 1", $symbol);
        if (!empty($marketOrders)) {
            $marketSide = ($marketOrders[0]["side"]);
            $tradeType = 'market';

            if ($marketSide == 'b') {
                $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
                if (empty($asks)){
                    if (query("DELETE FROM orderbook WHERE (symbol = ? AND type = 'market' AND side = ?)", $symbol, $marketSide) === false)
                    {apologize("Unable to delete unfilled market bid orders.");}
                    if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'no market bid orders', 'functions.php ln351') === false)
                    {   //UPDATE HISTORY
                        apologize("Insert History Failure 1");
                    }
                    //var_dump(get_defined_vars());
                    apologize("Market orders require limit orders. No ask limit orders for the bid market order. Deleting all bid market orders.");
                }
                $bids = $marketOrders;
                @$topAskPrice = ($asks[0]["price"]); //limit price
                @$topBidPrice = ($asks[0]["price"]);
            } elseif ($marketSide == 'a') {
                $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
                if (empty($bids)){
                    if (query("DELETE  FROM orderbook WHERE (symbol = ? AND type = 'market' AND side = ?)", $symbol, $marketSide) === false)
                    {apologize("Unable to delete unfilled market ask orders.");}
                    if (query("INSERT INTO error (id, type, description) VALUES (?, ?, ?)", 0, 'no market ask orders', 'functions.php ln351') === false)
                    {   //UPDATE HISTORY
                        apologize("Insert History Failure 1");
                    }
                    //var_dump(get_defined_vars());
                    apologize("Market orders require limit orders. No bid limit orders for the ask market order. Deleting all ask market orders.");
                }
                $asks = $marketOrders;
                $topAskPrice = ($bids[0]["price"]); //limit price
                $topBidPrice = ($bids[0]["price"]);
            } else {
                apologize("Market Side Error!");
            }
        } elseif (empty($marketOrders)) {
            $bids = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbol, 'b');
            $asks = query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbol, 'a');
            if (empty($asks)){apologize("No ask limit orders. Unable to cross any orders.");}
            if (empty($bids)){apologize("No bid limit orders. Unable to cross any orders.");}
            @$topAskPrice = ($asks[0]["price"]); //limit price
            @$topBidPrice = ($bids[0]["price"]);
            $tradeType = 'limit';

        } else {
            apologize("Market Order Error!");
        }

        //price in above market arg
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








    } //BOTTOM of WHILE STATEMENT


    //LAST TRADE INFO TO RETURN ON FUNCTION
    if ($topAskType == 'market'){$topAskPrice = 'market';}//null//$tradePrice;} //since the do while loop gives it the next orders price, not the last traded
    if ($topBidType == 'market'){$topBidPrice = 'market';}//null// $tradePrice;} //since the do while loop gives it the next orders price, not the last traded
    $orderbook['topBidPrice'] =  $topBidPrice;
    $orderbook['topAskUID'] = $topAskUID; //order id; unique id
    $orderbook['topAskSymbol'] = $topAskSymbol; //symbol of equity
    $orderbook['topAskSide'] = $topAskSide; //bid or ask
    $orderbook['topAskDate'] = $topAskDate;
    $orderbook['topAskType'] = $topAskType; //limit or market
    $orderbook['topAskSize'] = $topAskSize;  //size or quantity of trade
    $orderbook['topAskUser'] = $topAskUser; //user id

    $orderbook['topAskPrice'] =  $topAskPrice;
    $orderbook['topBidUID'] = $topBidUID; //order id; unique id
    $orderbook['topBidSymbol'] = $topBidSymbol;
    $orderbook['topBidSide'] = $topBidSide; //bid or ask
    $orderbook['topBidDate'] = $topBidDate;
    $orderbook['topBidType'] = $topBidType; //limit or market
    $orderbook['topBidSize'] = $topBidSize;
    $orderbook['topBidUser'] = $topBidUser;

    $orderbook['orderProcessed'] = $orderProcessed;
    if(empty($tradePrice)){$tradePrice=0;}//if no trades so should be empty
    $orderbook['tradePrice'] =  $tradePrice;
    $orderbook['tradeType'] =  $tradeType;


    return $orderbook;

} //END OF FUNCTION


?>
