<?php
require("../includes/config.php");
// if form was submitted
$title = "History";
$id =  $_SESSION["id"];
$limit = "LIMIT 0, 10";
$tabletitle = "Last 10";
//history post submit button was press
if(isset($_POST['history']))
{ $history = $_POST['history'];
  $history = sanatize("alphabet", $history);
    if ($_POST['history'] == 'all')
    {   
        $limit = "";
        $title = "All History";
        $tabletitle = "All";
    } //for unlimited option
} 

//HISTORY
$history = query("SELECT * FROM history WHERE (id = ? AND (TRANSACTION='PO' OR TRANSACTION='TRANSFER' OR TRANSACTION='DEPOSIT' OR TRANSACTION='WITHDRAW')) ORDER BY uid DESC $limit", $id);
$error = query("SELECT * FROM error WHERE (id = ?) ORDER BY uid DESC $limit", $id);

render(
    "history_form.php",
    [
        "title" => $title,
        "history" => $history,
        "error" => $error,
        "tabletitle" => $tabletitle,
    ]);

?>
