<?php
require("../includes/config.php");
// if form was submitted
$title = "Trades";
$id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['symbol'])){ $symbol=$_POST['symbol'];} 
    else{apologize("Unknown symbol!"); exit();}
    
    $trades =	query("SELECT * FROM trades WHERE (symbol = ?) ORDER BY date ASC", $symbol);
    $tradestotal =	query("SELECT SUM(price) AS totalprice, SUM(total) AS totaltotal, SUM(quantity) AS totalquantity, SUM(commission) AS totalcommission, COUNT(uid) AS totaltrades FROM trades WHERE (symbol = ?) ORDER BY date ASC", $symbol);
    
    render("information-trades_form.php",[
        "title" => $title,
        "trades" => $trades,
        "tradestotal" => $tradestotal
        ]);
}
else{
 apologize("No symbol selected!");
}
?>


