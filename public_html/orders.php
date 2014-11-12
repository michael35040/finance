<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Open Orders";
$limit = "LIMIT 0, 50";

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["cancel"]))
        //if(empty($_POST["cancel"])){apologize("No order selected!");}
        //else
    {
        $uid = $_POST["cancel"];
        if ($uid == 'ALL') { //CANCEL ALL USERS ORDERS
            if (query("UPDATE orderbook SET type = 'cancel' WHERE id = ?", $id) === false) {
                apologize("Unable to cancel all orders!");
            }
        } else { //CANCEL ONLY 1 ORDER
            if (query("UPDATE orderbook SET type = 'cancel' WHERE uid = ?", $uid) === false) {
                apologize("Unable to cancel order!");
            }
        }
        redirect('orders.php');
    }
    if (isset($_POST["history"])) {
        $history = $_POST["history"];
        if ($history == "all") {
            $limit = "";
            $tabletitle = "All";
            $orders = query("SELECT * FROM orderbook WHERE (id = ?) ORDER BY uid DESC", $id);
            $history = query("SELECT * FROM history WHERE id = ? ORDER BY uid DESC $limit", $id);
            render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders, "history" => $history]);
        }
        if ($history == "limit") {
            $limit = "LIMIT 0, 10";
            $tabletitle = "Last 10";
            $orders = query("SELECT * FROM orderbook WHERE (id = ?) ORDER BY uid DESC", $id);
            $history = query("SELECT * FROM history WHERE id = ? ORDER BY uid DESC $limit", $id);
            render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders, "history" => $history]);
        }
    }
}
else
{
    $limit = "LIMIT 0, 10";
    $tabletitle = "Last 10";
    $orders = query("SELECT * FROM orderbook WHERE (id = ?) ORDER BY uid DESC", $id);
    $history = query("SELECT * FROM history WHERE id = ? ORDER BY uid DESC $limit", $id);
    render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders, "history" => $history]);

} //else !post
?>

