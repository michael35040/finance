<?php

require("../includes/config.php");

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//placeOrder(Market,$symbol,$quantity)
}
else{
    //$goldAsk;$goldBid;$silverAsk;$silverBid;$premium;$discount
    
    $userinfo = query("SELECT username, email, phone FROM users WHERE id = ( ? )", $_SESSION["id"]);
    render("instatrade_form.php", ["title" => "Instant Trade", "userinfo" => $userinfo]);}// else render form

?>
