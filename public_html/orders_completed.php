<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Orders";
$limit = "LIMIT 0, 10"; //active orders
$limit2 = "LIMIT 0, 10"; //order history
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

        $limit = "";
        $tabletitle = (htmlspecialchars($symbol) . " Ask Orders");
    }
    
    
    if (isset($_POST["side"]))
    {
        if($_POST["side"]=='b'){$option = "AND side = 'b'";
            $limit = "";
            $tabletitle = "Bid Orders";}
        else{$option = "AND side = 'a'";
            $limit = "";
            $tabletitle = "Ask Orders";}
    }
    
    
    if (isset($_POST["history"]))
    {
        $history = $_POST["history"];
        if ($history == "all") {$limit = ""; $tabletitle = "All";}
    }
    
}
/*
else
{

} //else !post , 
*/
$orders = query("SELECT * FROM orderbookcompleted WHERE (id = ? $option) ORDER BY uid DESC $limit", $id);
$ordertotal = query("SELECT SUM(total) AS sumtotal FROM orderbookcompleted WHERE (id = ? $option)", $id);
$history = query("SELECT ouid, date, symbol, transaction, total FROM history WHERE (id = ? $option2) ORDER BY uid DESC $limit", $id);
render("orders_completed_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders,  "ordertotal" => $ordertotal, "history" => $history]);

?>

