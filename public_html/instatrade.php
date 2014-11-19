<?php

require("../includes/config.php");

// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//placeOrder(Market,$symbol,$quantity)
}
else{
    render("instatrade_form.php", ["title" => "Instant Trade"]);
}// else render form

?>
