<?php
require("../includes/config.php");
// if form was submitted

$id =  $_SESSION["id"];
$limit = "LIMIT 0, 5";
$title = "History";
//history post submit button was press
if(isset($_POST['history']))
{
    if ($_POST['history'] == 'all')
    {
        $limit = "";
        $title = "History All";
    } //for unlimited option
    /* redundant statements, if this or limit...
        elseif ($_POST['history'] == 'limit')
                {$limit = "LIMIT 0, 5"; $title = "History";} //for unlimited option
        else    {$limit = "LIMIT 0, 5"; $title = "History";} //for unlimited option
    */
} 

//HISTORY
$history = query("SELECT * FROM history WHERE id = ? ORDER BY uid DESC $limit", $id);
//TRADES
$trades =	query("SELECT * FROM trades WHERE (buyer = ? OR seller = ?) ORDER BY uid DESC $limit", $id, $id);	  // query user's portfolio

render(
    "history_form.php",
    [
        "title" => $title,
        "history" => $history,
        "trades" => $trades
    ]);

?>
