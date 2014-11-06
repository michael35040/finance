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

     if (empty($symbol) || empty($price) || empty($quantity) || empty($type) || empty($side)) { apologize("Incomplete form!"); } //check to see if empty
    
    list($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal) = placeOrder($symbol, $type, $side, $quantity, $price, $id);
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
