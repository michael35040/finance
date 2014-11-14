<?php
require("../includes/config.php");  // configuration  

$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol = $_POST["symbol"];
        //CHECK TO SEE IF SYMBOL EXISTS
        $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);//Checks to see if they already own stock to determine if we should insert or update tables
        $countOwnersRows = count($symbolCheck);
        if ($countOwnersRows != 1) {apologize("Symbol does not exist."); }
    @$userid = $_POST["userid"]; //owner or chief executive
    @$issued = $_POST["issued"]; //current amount of shares made public, issued for IPO
    @$fee = $_POST["fee"]; //fee?

    @$offering = $_POST["offering"];

    if(empty($symbol)){apologize("Please fill out symbol");}
    if(empty($userid)){apologize("Please fill out userid");}
    if(empty($issued)){apologize("Please fill out issued");}
    if(empty($fee)){apologize("Please fill out fee");}
   // apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
if($offering=='followon')
{
    try {$message = publicOffering2($symbol, $userid, $issued, $fee);}
    catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
}
elseif($offering=='initial')
{
    @$name = $_POST["name"];
    @$type = $_POST["type"]; //share or commodity
    @$url = $_POST["url"];
    @$rating = $_POST["rating"]; //1 - 10
    @$description = $_POST["description"];
    
try {$message = publicOffering($symbol, $name, $userid, $issued, $type, $fee, $url, $rating, $description);}
catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
}
else{apologize("Unknown offering type.");}

//redirect("assets.php", ["title" => "Success"]); // render success form
redirect("assets.php", ["title" => $message]); // render success form
  
}
else
{
render("admin_offering_form.php", ["title" => "Public Offering"]); // render buy form //***/to remove C/***/
}
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
?>
