<?php
require("../includes/config.php");
// if form was submitted

$id =  $_SESSION["id"];
//$limit = "LIMIT 0, 10";
$title = "Transparency";


$assets["XBT"] = 1037.423455;
$assets["XAU"] = 40.00;
$assets["XAG"] = 40.00;
$assets["USD"] = 172473.63;
$assets["EUR"] = 0.00;
$assets["GBP"] = 0.00;
$assets["CNY"] = 0.00;
$assets["JPY"] = 0.00;
$assets["TOT"] = 590613.87;


$obligations["XBT"] = 885.731546;
$obligations["XAU"] = 28.43055;
$obligations["XAG"] = 28.43055;
$obligations["USD"] = 116883.83;
$obligations["EUR"] = 7448.52;
$obligations["GBP"] = 2927.93;
$obligations["CNY"] = 8303.87;
$obligations["JPY"] = 99332.99;
$obligations["TOT"] = 482934.71;

//apologize(var_dump(get_defined_vars()));

/*
render("transparency_form.php", [
    "title" => $title,
    "assets" => $assets,
    "obligations" => $obligations
]);
*/




//$stocks = $infos;
//apologize(var_dump(get_defined_vars()));

/*
$assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
foreach ($assets as $row)		// for each of user's stocks
{
    $symbol = $row["symbol"];
    $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
    if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
    $totalPortfolio = $public[0]["quantity"]; //shares held

    $public =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (symbol =? AND side='a')", $symbol);	  // query user's portfolio
    if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
    $totalOrderbook = $public[0]["quantity"]; //shares held

    $obligations2["$symbol"] = ($totalPortfolio+$totalOrderbook);

}
*/

?>



<p>Below is a record our financial obligations to our members along with the amount of assets in our full reserve. Our real-time transparency system enables anyone at any time to confirm our solvency and ensure that his or her value is safe.</p>

<table border="3" style="text-align:center;">
    <tr>
        <td></td>
        <td>XBT</td>
        <td>XAU</td>
        <td>XAG</td>
        <td>USD</td>
        <td>EUR</td>
        <td>GBP</td>
        <td>CNY</td>
        <td>JPY</td>
        <td><strong>TOTAL (USD)</strong></td>
    </tr>
    <tr>
        <td>Assets</td>
        <td><?php echo(number_format($assets["XBT"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["XAU"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["XAG"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["USD"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["EUR"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["GBP"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["CNY"],4,".",",")); ?></td>
        <td><?php echo(number_format($assets["JPY"],4,".",",")); ?></td>
        <td><strong><?php echo(number_format($assets["TOT"],4,".",",")); ?></strong></td>
    </tr>

    <?php

        $quantityAsset =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", 'XBT');	  // query user's portfolio
    if(empty($obligations["XBT"]){$quantityAsset[0]["quantity"]=0;}
    $obligations["XBT"] = $XBT[0]["quantity"];
        $XAU =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", 'XAU');	  // query user's portfolio
    if(empty($obligations["XAU"]){$XBT[0]["quantity"]=0;}
    $obligations["XAU"] = $XAU[0]["quantity"];
        $XAG =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", 'XAG');	  // query user's portfolio
    $obligations["XAG"] = $XAG[0]["quantity"];

    //apologize(var_dump(get_defined_vars()));

    ?>

    <tr>
        <td>Obligations</td>
        <td><?php echo(number_format($obligations["XBT"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["XAU"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["XAG"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["USD"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["EUR"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["GBP"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["CNY"],4,".",",")); ?></td>
        <td><?php echo(number_format($obligations["JPY"],4,".",",")); ?></td>
        <td><strong><?php echo(number_format($obligations["TOT"],4,".",",")); ?></strong></td>
    </tr>
</table>
*XBT: Bitcoin (BTC)<br>
*XAU: Gold (Au)<br>
*XAG: Silver (Ag)<br>


