<?php 

require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));
$id = $_SESSION["id"];
$title = "Convert";


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{

    $symbol1 = $_POST["symbol1"];    
    $symbol2 = $_POST["symbol2"];    
    $amount = (int)$_POST["quantity"]; 
    
    if(empty($symbol1)){apologize("Please fill out all required fields. Asset 1 is empty.");}
    if(empty($symbol2)){apologize("Please fill out all required fields. Asset 2 is empty.");}
    if(empty($amount)){apologize("Please fill out all required fields. Amount is empty.");}
    if(!is_numeric($amount)){apologize("Invalid Quantity");}
    
    convertAsset($id, $symbol1, $symbol2, $amount);
    redirect("account.php");
}
else
{
    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	

    $stocksQ = query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	 
    foreach ($stocksQ as $row)	
    {
        $stock["symbol"] = $row["symbol"]; 
        $stock["quantity"] = $row["quantity"];
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol=? AND side='a')", $id, $stock["symbol"]);	
        $askQuantity = $askQuantity[0]["quantity"]; 
        $stock["locked"] = (int)$askQuantity;
        $stocks[] = $stock;
    }

    render("convert_form.php", [
        "title" => $title,
        "assets" => $assets,
        "stocks" => $stocks
    ]);

}
?>
