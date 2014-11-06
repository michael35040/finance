<?php
require("../includes/config.php");
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}


clear_all();

redirect("index.php");
?>
