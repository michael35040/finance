<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Open Orders";

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    $uid = (int)$_POST["uid"];

    if (query("UPDATE orderbook SET type = 'cancel' WHERE uid = ?", $uid) === false)
    { throw new Exception("Update Order Error!"); }

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

