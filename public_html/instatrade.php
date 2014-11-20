<?php

require("../includes/config.php");

 $id = $_SESSION["id"]; //get id from session
 
// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    @$symbol = $_POST["symbol"]; //assign post variables to local variables, not really needed but makes coding easier
    @$type = $_POST["type"]; //limit or market
    @$side = $_POST["side"]; //buy/bid or sell/ask
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    $quantity = sanatize("quantity", $quantity);


    $goldAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='GOLD'", $id);
    $goldAmount=$goldAmount[0]["quantity"];
    $goldbids =	query("SELECT price FROM orderbook WHERE (symbol='GOLD' AND side='b' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $goldasks =	query("SELECT price FROM orderbook WHERE (symbol='GOLD' AND side='a' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $gold["ask"]=(float)$goldasks[0]["price"];
    $gold["premium"]=($gold["ask"]*0.03);
    $gold["buy"]=($gold["ask"]+$gold["premium"]);
    $gold["bid"]=(float)$goldbids[0]["price"];
    $gold["discount"]=($gold["bid"]*0.03);
    $gold["sell"]=($gold["bid"]-$gold["discount"]);

    $silverAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='SILVER'", $id);
    $silverAmount=$silverAmount[0]["quantity"];
    $silverbids =	query("SELECT price FROM orderbook WHERE (symbol='SILVER' AND side='b' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $silverasks =	query("SELECT price FROM orderbook WHERE (symbol='SILVER' AND side='a' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $silver["ask"]=(float)$silverasks[0]["price"];
    $silver["premium"]=($silver["ask"]*0.03);
    $silver["buy"]=($silver["ask"]+$silver["premium"]);
    $silver["bid"]=(float)$silverbids[0]["price"];
    $silver["discount"]=($silver["bid"]*0.03);
    $silver["sell"]=($silver["bid"]-$silver["discount"]);


    @$metalTransaction = $_POST["metalTransaction"];// buyGold, buySilver, sellGold, sellSilver
        if($metalTransaction=='buyGold')
        {   $symbol='GOLD';
            $side='b';
            $price=($gold["buy"]*$quantity);
        }
        elseif($metalTransaction=='buySilver')
        {   $symbol='SILVER';
            $side='b';
            $price=($gold["sell"]*$quantity);
        }
        elseif($metalTransaction=='sellGold')
        {   $symbol='GOLD';
            $side='a';
            $price=($silver["buy"]*$quantity);
        }
        elseif($metalTransaction=='sellSilver')
        {   $symbol='SILVER';
            $side='a';
            $price=($silver["sell"]*$quantity);
        }
        else{apologize('Unknown action!');}// //dump all variables if i hit error
        //apologize(var_dump(get_defined_vars()));
    
    //FORMATS AND SCRUBS VARIABLES
    $type = 'market';

    //apologize($symbol . " " . $type . " " . $side . "/ x" . $quantity . "/ $" . $price . "/ ID" . $id);
    
    
    try {list($transaction, $symbol, $tradeTotal, $quantity, $commissionTotal) = placeOrder($symbol, $type, $side, $quantity, $price, $id);}
    catch(Exception $e) {apologize($e->getMessage());}
    
    try {$processOrderbook = processOrderbook($symbol);}
    catch(Exception $e) {apologize($e->getMessage());} 

    redirect("instatrade.php");
}
else{

    $id = $_SESSION["id"]; //get id from session

    $trades = query("SELECT * FROM trades WHERE ((symbol='SILVER' OR symbol='GOLD') AND (buyer=? OR seller=?)) ORDER BY uid DESC LIMIT 0, 5", $id, $id);

    $goldAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='GOLD' ORDER BY symbol ASC", $_SESSION["id"]);
    $goldAmount=$goldAmount[0]["quantity"];
    $goldbids =	query("SELECT price FROM orderbook WHERE (symbol='GOLD' AND side='b' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $goldasks =	query("SELECT price FROM orderbook WHERE (symbol='GOLD' AND side='a' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $gold["ask"]=(float)$goldasks[0]["price"];
    $gold["premium"]=($gold["ask"]*0.03);
    $gold["buy"]=($gold["ask"]+$gold["premium"]);
    $gold["bid"]=(float)$goldbids[0]["price"];
    $gold["discount"]=($gold["bid"]*0.03);
    $gold["sell"]=($gold["bid"]-$gold["discount"]);

    $silverAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='SILVER'", $id);
    $silverAmount=$silverAmount[0]["quantity"];
    $silverbids =	query("SELECT price FROM orderbook WHERE (symbol='SILVER' AND side='b' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $silverasks =	query("SELECT price FROM orderbook WHERE (symbol='SILVER' AND side='a' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1");
    $silver["ask"]=(float)$silverasks[0]["price"];
    $silver["premium"]=($silver["ask"]*0.03);
    $silver["buy"]=($silver["ask"]+$silver["premium"]);
    $silver["bid"]=(float)$silverbids[0]["price"];
    $silver["discount"]=($silver["bid"]*0.03);
    $silver["sell"]=($silver["bid"]-$silver["discount"]);


    render("instatrade_form.php", ["title" => "Instant Trade", "trades" => $trades, "goldAmount" => $goldAmount, "gold" => $gold, "silverAmount" => $silverAmount, "silver" => $silver]);
}// else render form

?>
