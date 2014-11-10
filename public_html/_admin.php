<?php
require("../includes/config.php");
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

//if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
if(isset($_POST['admin']))
{
    if ($_POST['admin'] == 'all'){clear_all();}
    if ($_POST['admin'] == 'orderbook'){clear_orderbook();}
    if ($_POST['admin'] == 'trades'){clear_trades();}
    if ($_POST['admin'] == 'info')
    {   $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio");	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $publicQuantity = $public[0]["quantity"];
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE side='a'");	  // query user's portfolio
        $askQuantity = $askQuantity[0]["quantity"];
        $publicTotal = $askQuantity+$publicQuantity;
        $moneySupply =	query("SELECT SUM(units) AS units FROM accounts");	  // query user's portfolio
        $moneySupplyUnits = $moneySupply[0]["units"];
        $bidTotal =	query("SELECT SUM(total) AS total FROM orderbook WHERE side='b'");	  // query user's portfolio
        $bidTotal = $bidTotal[0]["total"];
        $moneySupplyTotal = $bidTotal+$moneySupplyUnits;
        echo("<br>Public Quantity: " . $publicQuantity);
        echo("<br>Ask Quantity: " . $askQuantity);
        echo("<br>Public Total: " . $publicTotal);
        echo("<br>");
        echo("<br>Money Units: " . $moneySupplyUnits);
        echo("<br>Bid Total: " . $bidTotal);
        echo("<br>Money Total: " . $moneySupplyTotal);
    }
    if ($_POST['admin'] == 'test')
    {   echo date("Y-m-d H:i:s");
        $startDate =  time();
        $createStocks = createStocks();
        $endDate =  time();
        echo("<br>");
        echo date("Y-m-d H:i:s");
        echo("<br>");
        $endDate =  time();
        $totalTime = $endDate-$startDate;
        $speed=$createStocks/$totalTime;
        echo("Created " . $createStocks . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");
    
        echo date("Y-m-d H:i:s");
        $startDate =  time();
        //$randomOrders = createStocks();
        try {$randomOrders = randomOrders();}
        catch(Exception $e) {echo('Message: [' . $symbol . '] ' . $e->getMessage() . '<br>');}         //catch exception
        $endDate =  time();
        echo("<br>");
        echo date("Y-m-d H:i:s");
        echo("<br>");
        $endDate =  time();
        $totalTime = $endDate-$startDate;
        $speed=$randomOrders/$totalTime;
        echo("Created " . $randomOrders . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");
    
        echo date("Y-m-d H:i:s");
        $startDate =  time();
        //$randomOrders = createStocks();
        try {$processOrderbook = processOrderbook();}
        catch(Exception $e) {echo('Message: [' . $symbol . '] ' . $e->getMessage() . '<br>');}         //catch exception
        $endDate =  time();
        echo("<br>");
        echo date("Y-m-d H:i:s");
        echo("<br>");
        $endDate =  time();
        $totalTime = $endDate-$startDate;
        $speed=$processOrderbook/$totalTime;
        echo("Created " . $processOrderbook . " orders in " . $totalTime . " seconds! " . $speed . " orders/sec<br><br>");
    }
    if ($_POST['admin'] == 'process')
    {
        if($_POST["symbol"] == 'ALL')
        {
            try {processOrderbook();}
            catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
        }
        else
        {
            try {processOrderbook($_POST["symbol"]);}
            catch(Exception $e) {echo 'Message: ' .$e->getMessage();}
        }
    }

redirect("admin.php");
}
else
{
   $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC"); // query assets
   $title = "Process Orderbook";
    require("../templates/header.php");
  ?>
<form action="_admin.php"  class="symbolForm" method="post"   >
    <fieldset>
    <table>
    <tr>
       <td>
            <div class="input-group" >
            <select name="symbol"  class="form-control" >
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
                                        </select>
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-info">
                            <b> SUBMIT </b>
                        </button>
                        </span>
                                    </div><!-- /input-group -->

        </td>
    </tr>
</table>

    </fieldset>
</form>

  <?php
  require("../templates/footer.php");
} //else !post


