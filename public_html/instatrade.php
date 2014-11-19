<?php

require("../includes/config.php");

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    @$symbol = $_POST["symbol"]; //assign post variables to local variables, not really needed but makes coding easier
    @$type = $_POST["type"]; //limit or market
    @$side = $_POST["side"]; //buy/bid or sell/ask
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    @$price = (float)$_POST["price"]; //not set on market orders

    @$metalTransaction = $_POST["metalTransaction"];// buyGold, buySilver, sellGold, sellSilver
    
    //apologize(var_dump(get_defined_vars()));
    
        if($metalTransaction=='buyGold'){$symbol='GOLD';$side='bid';}
        elseif($metalTransaction=='buySilver'){$symbol='SILVER';$side='bid';}
        elseif($metalTransaction=='sellGold'){$symbol='GOLD';$side='ask';}
        elseif($metalTransaction=='sellSilver'){$symbol='SILVER';$side='ask';}
        else{apologize('Unknown action!');}// //dump all variables if i hit error
    //FORMATS AND SCRUBS VARIABLES
    $price = sanatize("price", $price);
    $quantity = sanatize("quantity", $quantity);
    $symbol = strtoupper($symbol); //cast to UpperCase
    
    if($symbol!='GOLD' || $symbol!='SILVER'){apologize('Invalid metal type! Gold or Silver only.');}
    $type = 'market';
    $side = sanatize("alphabet", $side);
    
    try {list($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal) = placeOrder($symbol, $type, $side, $quantity, $price, $id);}
    catch(Exception $e) {apologize($e->getMessage());}
    
    try {$processOrderbook = processOrderbook($symbol);}
    catch(Exception $e) {apologize($e->getMessage());} 

    redirect("instatrade.php");
}
else{
    render("instatrade_form.php", ["title" => "Instant Trade"]);
}// else render form

?>
