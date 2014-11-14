<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session


$purchaseprice = query("SELECT SUM(price) AS purchaseprice FROM portfolio WHERE id = ?", $_SESSION["id"]); //calculate purchase price

$bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=? AND side='b')", $id); // query user's portfolio
$bidLocked = $bidLocked[0]["total"]; //shares trading


// render portfolio (pass in new portfolio table and cash)
render("index_form.php", ["title" => "Accounts", "purchaseprice" => $purchaseprice, "bidLocked" => $bidLocked]);
?>
