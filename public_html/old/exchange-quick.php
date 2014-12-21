<?php

require("../includes/config.php");

 $id = $_SESSION["id"]; //get id from session
 
 $symbolgold = 'XAU'; //'gold'
 $symbolsilver = 'XAG'; //'silver'
 
 
// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    @$quantity = (int)$_POST["quantity"]; //not set on market orders
    $quantity = sanatize("quantity", $quantity);
    $price=0; //market order, price is meaningless

    @$metalTransaction = $_POST["metalTransaction"];// buyGold, buySilver, sellGold, sellSilver
        if($metalTransaction=='buyGold') {$symbol=$symbolgold; $side='b'; }
        elseif($metalTransaction=='buySilver') { $symbol=$symbolsilver; $side='b';}
        elseif($metalTransaction=='sellGold') { $symbol=$symbolgold; $side='a'; }
        elseif($metalTransaction=='sellSilver') {$symbol=$symbolsilver; $side='a'; }
        else{apologize('Unknown action!');}// //dump all variables if i hit error
        //apologize(var_dump(get_defined_vars()));
    
    //FORMATS AND SCRUBS VARIABLES
    $type = 'market';
    //apologize($symbol . " " . $type . " " . $side . "/ x" . $quantity . "/ $" . $price . "/ ID" . $id);
    
    
    try {placeOrder($symbol, $type, $side, $quantity, $price, $id);}
    catch(Exception $e) {apologize($e->getMessage());}
    
    try {processOrderbook($symbol);}
    catch(Exception $e) {apologize($e->getMessage());}

    redirect("exchange-quick.php");
}
else{

    $id = $_SESSION["id"]; //get id from session

    $trades = query("SELECT * FROM trades WHERE ((symbol='SILVER' OR symbol=?) AND (buyer=? OR seller=?)) ORDER BY uid DESC LIMIT 0, 5", $symbolgold, $id, $id);

    $goldAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol=? ORDER BY symbol ASC", $_SESSION["id"], $symbolgold);
   @$goldAmount=$goldAmount[0]["quantity"];
    $goldbids =	query("SELECT price FROM orderbook WHERE (symbol=? AND side='b' AND type = 'limit') ORDER BY price DESC, uid DESC LIMIT 0, 1", $symbolgold);
    $goldasks =	query("SELECT price FROM orderbook WHERE (symbol=? AND side='a' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbolgold);
    
    @$gold["ask"]= getPrice($goldasks[0]["price"]);
    $gold["premium"]=0; //buying has no commission //($gold["ask"]*$commission);
    $gold["buy"]=($gold["ask"]+$gold["premium"]);
    
    @$gold["bid"]=getPrice($goldbids[0]["price"]);
    $gold["discount"]=($gold["bid"]*$commission); 
    $gold["sell"]=($gold["bid"]-$gold["discount"]);
    
    $silverAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol=?", $id, $symbolsilver);
    @$silverAmount=$silverAmount[0]["quantity"];
    $silverbids =	query("SELECT price FROM orderbook WHERE (symbol=? AND side='b' AND type = 'limit') ORDER BY price DESC, uid ASC LIMIT 0, 1", $symbolsilver);
    $silverasks =	query("SELECT price FROM orderbook WHERE (symbol=? AND side='a' AND type = 'limit') ORDER BY price ASC, uid ASC LIMIT 0, 1", $symbolsilver);
    
    @$silver["ask"]=getPrice($silverasks[0]["price"]);
    $silver["premium"]=0; //buying has no commission //($silver["ask"]*$commission);
    $silver["buy"]=($silver["ask"]+$silver["premium"]);
    @$silver["bid"]=getPrice($silverbids[0]["price"]);
    $silver["discount"]=($silver["bid"]*$commission);
    $silver["sell"]=($silver["bid"]-$silver["discount"]);


    render("exchange-quick_form.php", ["title" => "Quick Trade", "trades" => $trades, "goldAmount" => $goldAmount, "gold" => $gold, "silverAmount" => $silverAmount, "silver" => $silver]);
}// else render form

?>
