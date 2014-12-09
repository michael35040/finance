<?php
require("../includes/config.php");
// if form was submitted

$id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['symbol'])){ $symbol=$_POST['symbol'];}
    else{apologize("Unknown symbol!"); exit();}

    $title = $symbol . " (Orderbook)";
    $bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid DESC", $symbol, 'b');
    $asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, uid ASC", $symbol, 'a');

    render("information-orderbook_form.php",[
        "title" => $title,
        "symbol" => $symbol,
        "bids" => $bids,
        "asks" => $asks
    ]);
}
else{
    //apologize("No symbol selected!");
    redirect("information.php");
}
?>


