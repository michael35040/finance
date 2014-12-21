<?php
require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));
//apologize(var_dump(get_defined_vars())); //dump all variables anywhere (displays in header)

$id =  $_SESSION["id"];
$title = "Transparency";


//if ($id != 1) { apologize("Unauthorized!"); exit();} else {} //if adminid


render("transparency_form.php", ["title" => $title,]);

?>


