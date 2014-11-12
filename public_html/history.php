<?php
require("../includes/config.php");
// if form was submitted

$id =  $_SESSION["id"];
$limit = "LIMIT 0, 10";
$title = "History";
//history post submit button was press
if(isset($_POST['history']))
{
    if ($_POST['history'] == 'all')
    {
        $limit = "";
        $title = "All History";
    } //for unlimited option
} 

//HISTORY
$history = query("SELECT * FROM history WHERE id = ? ORDER BY uid DESC $limit", $id);

render(
    "history_form.php",
    [
        "title" => $title,
        "history" => $history,
    ]);

?>
