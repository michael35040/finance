<?php
require("../includes/config.php");
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

//if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted

   $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query assets
   $title = "Process Orderbook";
    require("../templates/header.php");
  ?>
<form action="_admin.php"  class="symbolForm" method="post"   >
    <fieldset>
<table class="table table-condensed table-striped table-bordered" id="admin" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <tr><th colspan=2>ADMIN TESTING</th></tr>
    <tr><td><input type="radio" name="admin" value="all"></td>          <td>Clear All</td></tr>
    <tr><td><input type="radio" name="admin" value="test"></td>          <td>New Environment</td></tr>
    <tr><td><input type="radio" name="admin" value="orderbook"></td>    <td>Clear Orderbook</td></tr>
    <tr><td><input type="radio" name="admin" value="trades"></td>       <td>Clear Trades</td></tr>
    <tr><td><input type="radio" name="admin" value="info"></td>         <td>Monetary Info</td></tr> 
    <tr><td><input type="radio" name="admin" value="createstocks"></td> <td>Create Stocks</td></tr>
    <tr><td><input type="radio" name="admin" value="randomorders"></td> <td>Random Orders</td></tr>
    <tr><td><input type="radio" name="admin" value="process"></td>      <td>Process Orders*</td></tr>
    <tr><td><input type="radio" name="admin" value="delete"></td>      <td>Delete Stocks*</td></tr>

    <tr><td colspan="2">        <select name="symbol"  class="form-control" >
                <?php
                if (empty($assets)) {
                    echo("<option value=' '>No Assets</option>");
                } else {
                    //echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                    echo ('    <option value="ALL">-All Assets-</option>');
                    foreach ($assets as $asset) {
                        $symbol = $asset["symbol"];
                        echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                    }
                }
                ?>
            </select></td></tr>

    <tr><td colspan='2'>
            <button type="submit" class="btn btn-info"><b> SUBMIT </b></button></span>
        </td></tr>
</table>

    </fieldset>
</form>
<hr>

<?php
if(isset($_POST['admin']))
{
    if ($_POST['admin'] == 'delete'){removeAsset($_POST['symbol']);}
    if ($_POST['admin'] == 'all'){clear_all();}
    if ($_POST['admin'] == 'test'){test();}
    if ($_POST['admin'] == 'orderbook'){clear_orderbook();}
    if ($_POST['admin'] == 'trades'){clear_trades();}
    if ($_POST['admin'] == 'info')
    {       $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio");	  // query user's portfolio
            if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $StockSupply = $public[0]["quantity"];
            $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE side='a'");	  // query user's portfolio
            if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $StockSupplyAsk = $askQuantity[0]["quantity"];
        $StockTotal = $StockSupplyAsk+$StockSupply;
        
            $moneySupply =	query("SELECT SUM(units) AS units FROM accounts");	  // query user's portfolio
            if(empty($moneySupply[0]["units"])){$moneySupply[0]["units"]=0;}
        $MoneySupply = $moneySupply[0]["units"];
            $bidTotal =	query("SELECT SUM(total) AS total FROM orderbook WHERE side='b'");	  // query user's portfolio
            if(empty($bidTotal[0]["total"])){$bidTotal[0]["total"]=0;}
        $MoneySupplyBids = $bidTotal[0]["total"];
        $moneySupplyTotal = $MoneySupply+$MoneySupplyBids;
        
        echo("<br>Stock Supply: " . $StockSupply);
        echo("<br>Stock Supply (Open Asks): " . $StockSupplyAsk);
        echo("<br>Total Stock Supply: " . $StockTotal);
        echo("<br>");
        echo("<br>Money Supply: " . $MoneySupply);
        echo("<br>Money Supply (Open Bids): " . $MoneySupplyBids);
        echo("<br>Total Money Supply: " . $moneySupplyTotal);
    }
    
    if ($_POST['admin'] == 'createstocks')    
    {
        try {createStocks();}
        catch(Exception $e) {echo 'Message: ' .$e->getMessage();}

    }
    if ($_POST['admin'] == 'randomorders')
    {   
        try {$randomOrders = randomOrders();}
        catch(Exception $e) {echo('Error: ' . $e->getMessage() . '<br>');}         //catch exception
    }
    if ($_POST['admin'] == 'process')
    {
        if(!isset($_POST['symbol'])){apologize("Please select a symbol!");}
        if($_POST["symbol"] == 'ALL')
        {
            try {$processOrderbook = processOrderbook();}
        catch(Exception $e) {echo('Error: ' . $e->getMessage() . '<br>');}         //catch exception
        }
        else
        {
            try {$processOrderbook = processOrderbook($_POST["symbol"]);}
        catch(Exception $e) {echo('Error: ' . $e->getMessage() . '<br>');}         //catch exception
        }
        echo($processOrderbook . " orders processed.");
    }
//redirect("admin.php");
}
  require("../templates/footer.php");



