<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Orders";
$limit = "LIMIT 0, 10"; //active orders
$limit2 = "LIMIT 0, 10"; //order history
$tabletitle = "Last 10";
$option = '';

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    
    if (isset($_POST["symbol"]))
    {
        $symbol = $_POST["symbol"];
        $asset =	query("SELECT * FROM assets WHERE symbol=?", $symbol);
        if(empty($asset)) {apologize("Invalid Symbol!");}
        else{$symbol=$asset[0]["symbol"];}
        //$symbol = htmlspecialchars($_POST["symbol"]);
        //if (!ctype_alnum($symbol)){apologize("Invalid query!");}
        $option = 'AND side = "a" AND symbol = "' . $symbol . '"';
        $tabletitle = "D ";

        //apologize(var_dump(get_defined_vars()));

        $limit = ""; $tabletitle = (htmlspecialchars($symbol) . " Ask Orders");
    }
    
    
    if (isset($_POST["side"]))
    {
        if($_POST["side"]=='b'){$option = "AND side = 'b'"; $limit = ""; $tabletitle = "Bid Orders";}
        else{$option = "AND side = 'a'"; $limit = ""; $tabletitle = "Ask Orders";}
    }
    
    
    if (isset($_POST["cancel"]))
    {
        $uid = $_POST["cancel"];
        if ($uid == 'ALL') 
        { //CANCEL ALL USERS ORDERS
            if (query("UPDATE orderbook SET type = 'cancel' WHERE id = ?", $id) === false) {apologize("Unable to cancel all orders!");}
            
        } 
        else 
        { //CANCEL ONLY 1 ORDER
            if (!ctype_digit($uid)){apologize("Invalid order #");}
            if (query("UPDATE orderbook SET type = 'cancel' WHERE uid = ?", $uid) === false) {apologize("Unable to cancel order!");}
            
        }
    }
    
    
    if (isset($_POST["history2"])) 
    {
        $history2 = $_POST["history2"];
        if ($history2 == "all") {$limit2 = ""; $tabletitle = "All";}
    }
    
}
/*
else
{

} //else !post , 
*/
$orders = query("SELECT uid, date, symbol, side, type, quantity, price, total FROM orderbook WHERE (id = ? $option) ORDER BY uid DESC $limit", $id);
$ordertotal = query("SELECT SUM(total) AS sumtotal FROM orderbook WHERE (id = ? $option)", $id);
$history = query("SELECT ouid, date, symbol, transaction, total FROM history WHERE (id = ?) ORDER BY uid DESC $limit2", $id);
render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders,  "ordertotal" => $ordertotal, "history" => $history]);

?>

