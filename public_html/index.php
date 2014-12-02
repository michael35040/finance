<?php

//NOT USING AS IT HAS ITS OWN AUTHENTICATION, COULD ADD INDEX.php TO IT BUT DON'T REALLY NEED ANYTHING FROM IT.
//require("../includes/config.php"); // configuration 

//attempting to stop header errors
ob_start();
// enable sessions
session_start();

if(isset($_SESSION["id"]))
//{ apologize(var_dump(get_defined_vars())); }//dump all variables if i hit error
{ header('Location: account.php');}
else
//{ apologize(var_dump(get_defined_vars())); }//dump all variables if i hit error
{ header('Location: info/index.php');}
?>
