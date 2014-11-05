<?php

require("../includes/config.php");  // configuration
//require("../includes/constants.php"); //global finance constants
$id = $_SESSION["id"]; //get id from session

//var_dump(get_defined_vars()); //dump all variables if i hit error

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    /////////////////////
    //VARS FOR EITHER NATIONAL OR LOCAL
    ////////////////////
    //CHANGES POST VAR TO LOCAL

    @$symbol = $_POST["symbol"];	//assign post variables to local variables, not really needed but makes coding easier
    @$quantity = $_POST["quantity"]; //quantity/volume/amount to trade
    @$side = $_POST["side"]; //buy/bid or sell/ask 

        @$price = (float)$_POST["price"]; //not set on market orders
        @$type = $_POST["type"]; //limit or market


    if (empty($symbol) || empty($quantity) ||  empty($type) || empty($side)) { apologize("Please fill all required fields (Symbol, Quantity, Type, Side)."); } //check to see if empty


    //QUERY TO SEE IF SYMBOL EXISTS
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    if (count($symbolCheck) != 1) //row count
    {apologize("Incorrect Symbol. Not listed on the exchange!");}


    //CHECKS //FORMATS AND SCRUBS VARIABLES

        if($type=='limit'){
            if (empty($price)) { apologize("Limit orders require price."); }
           // if (preg_match("/^\d+$/", $price) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)

            $priceModulus = fmod($price, $divisor); //$divisor set in constants
            if($priceModulus != 0){apologize("Not correct increment. $divisor");} //checks to see if quarter increment
            //if (!is_float($price)) { apologize("Price is not a number");} //if quantity is numeric
            //if (!ctype_digit($price)) { apologize("Price must be numeric!");} //if quantity is numeric
        }
        else 	{$price = 0; $type="market";}//market orders, forces variable
        if (preg_match("/^\d+$/", $quantity) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
        if (!ctype_alnum($symbol)) {apologize("Symbol must be alphanumeric!");}
        if(!ctype_alpha($type) || !ctype_alpha($side)) { apologize("Type and side must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
        if (!ctype_digit($quantity) ) { apologize("Quantity must be numeric!");} //if quantity is numeric
        $symbol = strtoupper($symbol); //cast to UpperCase


        //test for symbol existing
        //$test =	query("SELECT * FROM company WHERE (symbol = ?) ORDER BY price DESC, date ASC LIMIT 0, 5", $symbol);
        //if (count($test) < 1){apologize("Incorrect symbol!");} //check to see if exists in db


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
            if ($side == 'a'){$otherSide='b';}
            elseif ($side=='b'){$otherSide='a';}
            else {apologize("error");}
            $limitOrdersQ = query("SELECT SUM(quantity) AS limitorders FROM orderbook WHERE (type = 'limit' AND side = ?)", $otherSide);
            $limitOrders = $limitOrdersQ[0]['limitorders'];
            if (is_null($limitOrders) || $limitOrders == 0){apologize("Market Orders require an active Limit Order on the exchange for matching. <br>No Limit Order currently on the exchange.");}
        }

        if ($side == 'b'):
        {
            $transaction = 'BID';

            //QUERY CASH & UPDATE
            $units =	query("SELECT units FROM accounts WHERE id = ?", $id); //query db how much cash user has
            $units = $units[0]['units'];	//convert array from query to value
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
            if ($units < $tradeTotal)
            {
                apologize("You do not have enough for this transaction. You only have: " . $units . ". Attempted to buy: " . $tradeTotal . "." );
            }
            if (query("UPDATE accounts SET units = (units - ?), locked = (locked + ?) WHERE id = ?", $tradeTotal, $tradeTotal, $id) === false) //MOVE CASH TO LOCKED FUNDS
            {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Updates Accounts Failure");
            }


        } // transaction type for history	//b for bid
        elseif ($side == 'a'):
        {
            $transaction = 'ASK'; //QUERY CASH & UPDATE
            $userQuantity = query("SELECT quantity FROM portfolio WHERE (id = ? AND symbol = ?)", $id, $symbol);//
            $userQuantity = @(float)$userQuantity[0]["quantity"];
            //WILL CONDUCT ANOTHER CHECK AT ORDERBOOK PROCESS TO ENSURE USER UNITS > 0 and ENOUGH IN LOCKED
            if ($userQuantity < $quantity)
            {
                apologize("You do not have enough for this transaction. You only have: " . $userQuantity . ". Attempted to sell: " . $quantity . "." );
            }
            if (query("UPDATE portfolio SET quantity = (quantity - ?), locked = (locked + ?) WHERE (id = ? AND symbol = ?)", $quantity, $quantity, $id, $symbol) === false) //MOVE CASH TO LOCKED FUNDS
            {
                query("ROLLBACK"); //rollback on failure
                query("SET AUTOCOMMIT=1");
                apologize("Updates Accounts Failure");
            }
        }	// transaction type for history //a for ask
        else: { apologize("Order Side Error."); }
        endif;

        if (query("INSERT INTO history (id, transaction, symbol, quantity, price, commission, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $id, $transaction, $symbol, $quantity, $price, $commissionTotal, $tradeTotal) === false)
        {   //UPDATE HISTORY
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert History Failure 3");
        }
        if (query("INSERT INTO orderbook (symbol, side, type, price, quantity, id) VALUES (?, ?, ?, ?, ?, ?)", $symbol, $side, $type, $price, $quantity, $id) === false)
        {   //INSERT INTO ORDERBOOK
            query("ROLLBACK"); //rollback on failure
            query("SET AUTOCOMMIT=1");
            apologize("Insert Orderbook Failure");
        }


    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");

    render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $tradeTotal, "quantity" => $quantity, "commissiontotal" => $commissionTotal]); // render success form


} //if post
else
{
    $stocks =	query("SELECT * FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    render("exchange_form.php", ["title" => "Exchange", "stocks" => $stocks, "assets" => $assets]); // render buy form
}
//var_dump(get_defined_vars()); //dump all variables if i hit error  
?>