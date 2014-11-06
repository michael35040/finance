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
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    @$side = $_POST["side"]; //buy/bid or sell/ask 
    @$price = (float)$_POST["price"]; //not set on market orders
    @$type = $_POST["type"]; //limit or market


list($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal) = placeOrder($symbol, $quantity, $type, $side, $id);
@$tradeTotal = (float)$tradeTotal; //convert string to float
@$commissionTotal = (float)$commissionTotal; //convert string to float
@$quantity = (int)$quantity; //convert string to float


    render("success_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $tradeTotal, "quantity" => $quantity, "commissiontotal" => $commissionTotal]); // render success form


} //if post
else
{
    $stocks =	query("SELECT * FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    render("exchange_form.php", ["title" => "Exchange", "stocks" => $stocks, "assets" => $assets]); // render buy form
}
// apologize(var_dump(get_defined_vars())); //dump all variables if i hit error  
?>
