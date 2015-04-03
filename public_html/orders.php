<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Orders";
$tabletitle = "Last 10";
$option = '';
$option2 = '';

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
        $option2 = 'AND symbol = "' . $symbol . '"';


        //apologize(var_dump(get_defined_vars()));

        $tabletitle = (htmlspecialchars($symbol) . " Ask Orders");
    }
    
    
    if (isset($_POST["side"]))
    {
        if($_POST["side"]=='b'){$option = "AND side = 'b'";
            $tabletitle = "Bid Orders";}
        else{$option = "AND side = 'a'";
            $tabletitle = "Ask Orders";}
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
    
    
    if (isset($_POST["history"]))
    {
        $history = $_POST["history"];
        if ($history == "all") {$tabletitle = "All";}
    }
    
}
/*
else
{

} //else !post , 
*/
$orders = query("SELECT * FROM orderbook WHERE (id = ? $option) ORDER BY uid DESC", $id);
$ordertotal = query("SELECT SUM(total) AS sumtotal FROM orderbook WHERE (id = ? $option)", $id);
render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders,  "ordertotal" => $ordertotal]);

?>

