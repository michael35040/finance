<?php
require("../includes/config.php");
// if form was submitted

//Guess
//$history = query("SELECT * FROM history WHERE (id = ? AND (TRANSACTION='TRANSFER' OR TRANSACTION='DEPOSIT' OR TRANSACTION='WITHDRAW')) ORDER BY uid DESC $limit", $id);
//$error = query("SELECT * FROM error WHERE (id = ?) ORDER BY uid DESC $limit", $id);

render(
    "guess_form.php",
    [
        //"title" => $title,
        //"history" => $history,
        //"error" => $error,
    ]);

?>
