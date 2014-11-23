<?php
require("../includes/config.php");  // configuration
$id = $_SESSION["id"]; //get id from session
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol = $_POST["symbol"];	//assign post variables to local variables, not really needed but makes coding easier
    @$type = $_POST["type"]; //limit or market
    @$side = $_POST["side"]; //buy/bid or sell/ask 
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    @$dollar = (int)$_POST["dollar"]; //not set on market orders
    @$cents = (int)$_POST["cents"]; //not set on market orders

    $dollar = sanatize("wholenumber", $dollar);
    if($cents!=0 && $cents!=25 && $cents!=50 && $cents!=75){apologize("Incorrect decimal!");}
    $cents=$cents/100;
    $price=$dollar+$cents;

    //FORMATS AND SCRUBS VARIABLES
    $price = sanatize("price", $price);
    $quantity = sanatize("quantity", $quantity);
    $symbol = sanatize("alphabet", $symbol);
    $type = sanatize("alphabet", $type);
    $side = sanatize("alphabet", $side);
    $symbol = strtoupper($symbol); //cast to UpperCase

    try {placeOrder($symbol, $type, $side, $quantity, $price, $id);}
    catch(Exception $e) {apologize($e->getMessage());}


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


    render("order_form.php", ["title" => "Order", "stocks" => $stocks, "assets" => $assets]); // render buy form
}
// apologize(var_dump(get_defined_vars())); //dump all variables if i hit error  
?>
