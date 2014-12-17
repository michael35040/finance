<style>
    .nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
    .table, th
    {
        text-align: center;
    }
</style>

<table class="table table-condensed  table-bordered" >
    <tr   class="active" >
        <th>Asset</th>
        <th>Obligations</th>
        <th>Assets</th>
    </tr>
    <?php
    //OBLIGATIONS UNITS
    $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id<>1 AND side='b')");	  // query user's portfolio
    if($bidLocked[0]["total"]==null){$bidLocked[0]["total"]=0;}
    $obligationsLocked = ($bidLocked[0]["total"]); //shares trading
    $accounts =	query("SELECT SUM(units) as units FROM accounts WHERE id<>1");	 //query db
    if($accounts[0]["units"]==null){$accounts[0]["units"]=0;}
    $obligationsUnits = ($accounts[0]["units"]);
    $totalObligations = $obligationsLocked + $obligationsUnits;

    //ASSETS UNITS
    $bidLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (id=1 AND side='b')");	  // query user's portfolio
    if($bidLocked[0]["total"]==null){$bidLocked[0]["total"]=0;}
    $assetsLocked = ($bidLocked[0]["total"]); //shares trading
    $accounts =	query("SELECT SUM(units) as units FROM accounts WHERE id=1");	 //query db
    if($accounts[0]["units"]==null){$accounts[0]["units"]=0;}
    $assetsUnits = ($accounts[0]["units"]);
    $totalAssets = $assetsLocked + $assetsUnits;


    ?>
    <tr>
        <td><?php echo($unittype); ?></td>
        <td><?php echo(number_format(getPrice($totalObligations),$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalAssets),$decimalplaces,".",",")); ?></td>
    </tr>

    <?php
    $obligationMV = 0;
    $assetMV = 0;

    $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    foreach ($assets as $row)		// for each of user's stocks
    {
        $symbol = $row["symbol"];

        $obligationPortfolio =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE (symbol =? AND id<>1)", $symbol);	  // query user's portfolio
            if(empty($obligationPortfolio[0]["quantity"])){$obligationPortfolio[0]["quantity"]=0;}
            $totalPortfolio = $obligationPortfolio[0]["quantity"]; //shares held
        $obligationOrderbook =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id<>1)", $symbol);	  // query user's portfolio
            if(empty($obligationOrderbook[0]["quantity"])){$obligationOrderbook[0]["quantity"]=0;}
            $totalOrderbook = $obligationOrderbook[0]["quantity"]; //shares held
        $obligations = ($totalPortfolio+$totalOrderbook);


        $assetPortfolio =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE (symbol =? AND id=1)", $symbol);	  // query user's portfolio
            if(empty($assetPortfolio[0]["quantity"])){$assetPortfolio[0]["quantity"]=0;}
            $totalPortfolio = $assetPortfolio[0]["quantity"]; //shares held
        $assetOrderbook =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id=1)", $symbol);	  // query user's portfolio
            if(empty($assetOrderbook[0]["quantity"])){$assetOrderbook[0]["quantity"]=0;}
            $totalOrderbook = $assetOrderbook[0]["quantity"]; //shares held
        $assets = ($totalPortfolio+$totalOrderbook);

            //if(empty($obligationOrderbook[0]["price"])){$AskPrice=0;} //returning 0...
            if(empty($assetOrderbook[0]["price"])){$AskPrice=0;}
            else{$AskPrice=$assetOrderbook[0]["price"];}
        $obligationMV = ($AskPrice*$obligations) + $obligationMV;
        $assetMV = ($AskPrice*$assets) + $assetMV;

        ?>

        <tr>
            <td><?php echo($symbol); ?></td>
            <td><?php echo(number_format($obligations,$decimalplaces,".",",")); ?></td>
            <td><?php echo(number_format($assets,$decimalplaces,".",",")); ?></td>
        </tr>
    <?php
    }

    $obligationMV = $obligationMV+$totalObligations;
    $assetMV = $assetMV+$totalAssets;
    ?>

    <tr>

        <td><strong>TOTAL</strong></td>
        <td><strong><?php echo(number_format(getPrice($obligationMV),$decimalplaces,".",",")); ?></strong></td>
        <td><strong><?php echo(number_format(getPrice($assetMV),$decimalplaces,".",",")); ?></strong></td>

    </tr>

</table>


