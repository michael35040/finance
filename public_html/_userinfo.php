<?php

// configuration
require("../includes/config.php");

//GIVES ME INFO ON THE MONEY SUPPLY AND THE STOCK SUPPLY TO ENSURE IT AINT EXPANDING! BUGS!!!


$symbol='A';

    //COMPANY INFORMATION
        $public =	query("SELECT SUM(quantity) AS quantity,  SUM(locked) AS locked FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        if(empty($public[0]["locked"])){$public[0]["locked"]=0;}
        $publicLocked = $public[0]["locked"];
        $publicQuantity = $public[0]["quantity"];
        $publicTotal = $publicLocked+$publicQuantity;

        $moneySupply =	query("SELECT SUM(units) AS units,  SUM(locked) AS locked FROM accounts");	  // query user's portfolio
        $moneySupplyUnits = $moneySupply[0]["units"];
        $moneySupplyLocked = $moneySupply[0]["locked"];
        $moneySupplyTotal = $moneySupplyLocked+$moneySupplyUnits;

echo("<br>Public Quantity: " . $publicQuantity);
echo("<br>Public Locked: " . $publicLocked);
echo("<br>Public Total: " . $publicTotal);
echo("<br>");
echo("<br>Money Units: " . $moneySupplyUnits);
echo("<br>Money Locked: " . $moneySupplyLocked);
echo("<br>Money Total: " . $moneySupplyTotal);

//} // else render quote_form
//else
//{
//}

?>
