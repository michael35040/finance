<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session


// render portfolio (pass in new portfolio table and cash)
render("index_form.php", ["title" => "Accounts"]);

?>
