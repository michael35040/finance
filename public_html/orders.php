<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Open Orders";

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if(empty($_POST["uid"])){apologize("No order selected!");}
    $uid = (int)$_POST["uid"];

    if($uid=='all')
    { //CANCEL ALL USERS ORDERS
        if(query("UPDATE orderbook SET type = 'cancel' WHERE id = ?", $id) === false)
        { apologize("Unable to cancel all orders!"); }
    }
    else
    { //CANCEL ONLY 1 ORDER
        if(query("UPDATE orderbook SET type = 'cancel' WHERE uid = ?", $uid) === false)
        { apologize("Unable to cancel order!"); }
    }

redirect('orders.php');
}

else {
    $orders = query("SELECT * FROM orderbook WHERE (id = ?) ORDER BY uid ASC", $id);

    render(
        "orders_form.php",
        [
            "title" => $title,
            "orders" => $orders
        ]);

} //else !post
?>

