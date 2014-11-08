<?php

// configuration
require("../includes/config.php");

//GIVES ME INFO ON THE MONEY SUPPLY AND THE STOCK SUPPLY TO ENSURE IT AINT EXPANDING! BUGS!!!


$symbol='A';

    //COMPANY INFORMATION
        $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $publicQuantity = $public[0]["quantity"];
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE symbol =? AND side='a'", $symbol);	  // query user's portfolio
        $askQuantity = $askQuantity[0]["quantity"];
        $publicTotal = $askQuantity+$publicQuantity;


        $moneySupply =	query("SELECT SUM(units) AS units FROM accounts");	  // query user's portfolio
        $moneySupplyUnits = $moneySupply[0]["units"];

        $bidTotal =	query("SELECT SUM(total) AS total FROM orderbook WHERE side='b'");	  // query user's portfolio
        $bidTotal = $bidTotal[0]["total"];

        $moneySupplyTotal = $bidTotal+$moneySupplyUnits;





echo("<br>Public Quantity: " . $publicQuantity);
echo("<br>Ask Quantity: " . $askQuantity);
echo("<br>Public Total: " . $publicTotal);
echo("<br>");
echo("<br>Money Units: " . $moneySupplyUnits);
echo("<br>Bid Total: " . $bidTotal);
echo("<br>Money Total: " . $moneySupplyTotal);

//} // else render quote_form
//else
//{
//}

echo(var_dump(get_defined_vars()));

?>
