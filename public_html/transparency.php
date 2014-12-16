<?php
require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));

$id =  $_SESSION["id"];
$title = "Transparency";

render("transparency_form.php", [
    "title" => $title,
]);

?>

