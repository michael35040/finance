<?php
require("../includes/config.php");
// if form was submitted

$id =  $_SESSION["id"];
$limit = "LIMIT 0, 10";
$title = "Trades";
//history post submit button was press
if(isset($_POST['trades']))
{
    if ($_POST['trades'] == 'all')
    {
        $limit = "";
        $title = "All Trades";
    } //for unlimited option
}
//TRADES
$trades =	query("SELECT * FROM trades WHERE (buyer = ? OR seller = ?) ORDER BY uid DESC $limit", $id, $id);	  // query user's portfolio

render(
    "trades_form.php",
    [
        "title" => $title,
        "trades" => $trades
    ]);

?>
