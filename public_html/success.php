<?php

//buy/sell/exchange/etc form > success_form.php > success.php > successPRG_form.php 
//POST-REDIRECT-GET: TO PREVENT FORM RESUBMISSIONS!
    
require("../includes/config.php");  // configuration  
//require("../includes/constants.php"); //global finance constants


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
  echo("Not successful!");
}
else
{
    //GO TO SUCCESS PRG (POST-REDIRECT-GET) FORM TO PREVENT RESUBMISSIONS!
    render("successPRG_form.php", ["title" => "Success"]);
}
  
  
?>
