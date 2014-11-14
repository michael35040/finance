<?php

require("../includes/config.php");  // configuration  
//         apologize(var_dump(get_defined_vars()));       //dump all variables if i hit error
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

elseif(isset($_POST['update']))
{
    @$symbol=$_POST["symbol"];
    $symbolCheck = query("SELECT symbol FROM assets WHERE symbol =?", $symbol);
    $countOwnersRows = count($symbolCheck);
    if ($countOwnersRows != 1) {apologize("Symbol does not exist."); }

    @$symbol = $_POST["symbol"];
    @$newSymbol = $_POST["newSymbol"];
    @$name = $_POST["name"];
    @$userid = $_POST["userid"]; //owner or chief executive
    @$url = $_POST["url"];
    @$type = $_POST["type"]; //share or commodity
    @$rating = $_POST["rating"]; //1 - 10
    @$description = $_POST["description"];

    try {$message = updateSymbol($symbol, $newSymbol, $userid, $name, $type, $url, $rating, $description);}
    catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

    redirect("assets.php", ["title" => $message]); // render success form

}

elseif(isset($_POST['symbol']))
{
    $symbol=$_POST['symbol'];
    $assetinfo = query("SELECT * FROM assets WHERE symbol=?", $symbol);
    render("admin_update_form.php", ["title" => "Update Form", "assetinfo" => $assetinfo]); // render buy form //***/to remove C/***/
}



else
{
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query user's portfolio
    render("admin_symbol_form.php", ["title" => "Update Form", "assets" => $assets]); // render buy form //***/to remove C/***/
}


?>