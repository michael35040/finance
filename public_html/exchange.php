<?php
require("../includes/config.php");  // configuration
$id = $_SESSION["id"]; //get id from session
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol = $_POST["symbol"];	//assign post variables to local variables, not really needed but makes coding easier
    @$type = $_POST["type"]; //limit or market
    @$side = $_POST["side"]; //buy/bid or sell/ask 
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    @$price = (float)$_POST["price"]; //not set on market orders

    //CHECKS
    if (empty($symbol) || empty($type) || empty($side) || empty($quantity) || empty($price)) { apologize("Please fill all required fields."); } //check to see if empty
    //FORMATS AND SCRUBS VARIABLES
    if (!ctype_alpha($symbol) || !ctype_alpha($type) || !ctype_alpha($side)) { apologize("Symbol, Type, and Side must be alphabetic!");} //if symbol is alpha (alnum for alphanumeric)
    if (!is_numeric ($quantity) || !is_numeric ($price)) { apologize("Price and Quantity must be numeric!");} //if quantity is numeric
    if (($quantity<0) || ($price<0)) { apologize("Price and Quantity must be positive!");} //if quantity is numeric
    if (preg_match("/^\d+$/", $quantity) == false) { apologize("The quantity must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)

    $symbol = strtoupper($symbol); //cast to UpperCase


    list($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal) = placeOrder($symbol, $type, $side, $quantity, $price, $id);

    redirect("orders.php");

    //@$tradeTotal = (float)$tradeTotal; //convert string to float
    //@$commissionTotal = (float)$commissionTotal; //convert string to float
    //@$quantity = (int)$quantity; //convert string to float
   // render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $tradeTotal, "quantity" => $quantity, "commissiontotal" => $commissionTotal]); // render success form
    } //if post
else
{
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio

    $stocksQ = query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $stocks = []; //to send to next page
    foreach ($stocksQ as $row)		// for each of user's stocks
    {   $stock = [];
        $stock["symbol"] = $row["symbol"]; //set variable from stock info
        $stock["quantity"] = $row["quantity"];
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a')", $id, $stock["symbol"]);	  // query user's portfolio
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
        $stock["locked"] = (int)$askQuantity;
        $stocks[] = $stock;
    }
 //apologize(var_dump(get_defined_vars())); //dump all variables if i hit error


    render("exchange_form.php", ["title" => "Exchange", "stocks" => $stocks, "assets" => $assets]); // render buy form
}
// apologize(var_dump(get_defined_vars())); //dump all variables if i hit error  
?>
