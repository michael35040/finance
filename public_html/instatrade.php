<?php

require("../includes/config.php");

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//placeOrder(Market,$symbol,$quantity)
}
else{
    $gold["ask"]=1100;
    $gold["bid"]=1000;
    $gold["premium"]=3;
    $gold["discount"]=2;

    //$userinfo = query("SELECT username, email, phone FROM users WHERE id = ( ? )", $_SESSION["id"]);
    render("instatrade_form.php", ["title" => "Instant Trade", "gold" => $gold]);}// else render form

?>
