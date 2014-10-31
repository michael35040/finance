<?php

//buy/sell/exchange/etc form > success_form.php > success.php > successPRG_form.php 
//POST-REDIRECT-GET: TO PREVENT FORM RESUBMISSIONS!

if (isset($transaction))
{

  
        //set as session to store for POST-REDIRECT-GET cycle.  
        @$_SESSION['PRGtransaction'] = $transaction;
        @$_SESSION['PRGsymbol'] = $symbol;
        @$_SESSION['PRGvalue'] = $value; //trade Total
        @$_SESSION['PRGquantity'] = $quantity;
        @$_SESSION['PRGcommissiontotal'] = $commissiontotal;

        //FOR Trans_ID on next page.        
        $history = query("SELECT `uid` FROM `history` WHERE `id` = ? ORDER BY `uid` DESC LIMIT 1", $_SESSION["id"]); //this takes the id to the next page
        $_SESSION["PRGconfirmation"] = $history[0]["uid"]; //generate session id

        redirect("success.php");
        //header("HTTP/1.1 303 See Other");
        //header("Location: success.php");

//PRG END
}
else
{
redirect("history.php");  
}
?>