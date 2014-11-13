<?php

require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol = $_POST["symbol"];
    @$newSymbol = $_POST["newSymbol"];
    @$name = $_POST["name"];
    //@$userid = $_POST["userid"]; //owner or chief executive
    @$owner = $_POST["owner"]; //email of owner or chief executive
    //@$fee = $_POST["fee"]; //fee
    //@$issued = $_POST["issued"]; //current amount of shares made public, issued for IPO
    @$url = $_POST["url"];
    @$type = $_POST["type"]; //share or commodity
    @$rating = $_POST["rating"]; //1 - 10
    @$description = $_POST["description"];
    updateSymbol($symbol, $newSymbol, $name, $type, $owner, $url, $rating, $description)
try {$message = updateSymbol($symbol, $newSymbol, $name, $type, $owner, $url, $rating, $description);}
catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

//redirect("assets.php", ["title" => "Success"]); // render success form
redirect("assets.php", ["title" => $message]); // render success form
  
}
else
{
render("admin_us_form.php", ["title" => "Update Symbol"]); // render buy form //***/to remove C/***/
}
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
