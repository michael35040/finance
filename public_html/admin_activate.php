<?php
require("../includes/config.php");
$id = $_SESSION["id"];
$title = "Activate Users";
$limit = "LIMIT 0, 50";
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
if (isset($_POST["activate"]))
{
  $id = $_POST["activate"];
  if ($id == 'ALL') { //CANCEL ALL USERS ORDERS
  if (query("UPDATE users SET activate=1 WHERE id = ?", $id) === false) {
  apologize("Unable to activate all users!");
}
} else { //CANCEL ONLY 1 ORDER
  if (query("UPDATE orderbook SET type = 'activate' WHERE uid = ?", $uid) === false) {
  apologize("Unable to activate user!");
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


//activate users 

//query users that are inactive 
$inactiveUsers = query("select id from users where active=0;")


//list users
for each $inactiveUsers as $user
{
echo("
//form button to update
query("update users set active=1 where id=?", $userid;)


//list active users to deactivate

?>
