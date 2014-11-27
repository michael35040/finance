<?php

// configuration
require("../includes/config.php");
$id = $_SESSION["id"]; //get id from session






if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    if (isset($_POST["cancel"])) {
        $uid = $_POST["cancel"];
        if ($uid == 'ALL') { //CANCEL ALL USERS ORDERS
            if (query("UPDATE orderbook SET status = '0' WHERE id = ?", $id) === false) {
                apologize("Unable to cancel all notifications!");
            }

        } else { //CANCEL ONLY 1 ORDER
            if (!ctype_digit($uid)) {
                apologize("Invalid notice #");
            }
            if (query("UPDATE notification SET status = '0' WHERE uid = ?", $uid) === false) {
                apologize("Unable to cancel notification!");
            }

        }
    }
}

    $notifications = query("SELECT * FROM notification WHERE (id =? AND status='1')", $id);

    $purchaseprice = query("SELECT SUM(price) AS purchaseprice FROM portfolio WHERE id = ?", $_SESSION["id"]); //calculate purchase price

    $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $id); // query user's portfolio
    $bidLocked = $bidLocked[0]["total"]; //shares trading


// render portfolio (pass in new portfolio table and cash)
    render("accounts_form.php", ["title" => "Accounts", "purchaseprice" => $purchaseprice, "bidLocked" => $bidLocked, "notifications" => $notifications]);






?>
