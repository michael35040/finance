<?php
require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));
$id = $_SESSION["id"];
$title = "Convert";


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    @$symbol1 = $_POST["symbol1"];    //assign post variables to local variables, not really needed but makes coding easier
    @$symbol2 = $_POST["symbol2"];    //assign post variables to local variables, not really needed but makes coding easier
    @$amount = (int)$_POST["quantity"]; //not set on market orders

    convertAsset($id, $symbol1, $symbol2, $amount);
    redirect("account.php")
}
else
{

    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio

    $stocksQ = query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
    $stocks = []; //to send to next page
    foreach ($stocksQ as $row)		// for each of user's stocks
    {   $stock = [];
        $stock["symbol"] = $row["symbol"]; //set variable from stock info
        $stock["quantity"] = $row["quantity"];
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a')", $id, $stock["symbol"]);	  // query user's portfolio
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
        $stock["locked"] = (int)$askQuantity;
        $stocks[] = $stock;
    }

    render("convert_form.php", [
        "title" => $title,
        "assets" => $assets,
        "stocks" => $stocks,
    ]);

}

