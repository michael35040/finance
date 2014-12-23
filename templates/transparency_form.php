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
    <thead>
    <tr class="active">
        <th colspan="4">Currently there are 5,152,000 accounts</th>
    </tr>
    <tr class="active">
        <th colspan="4">System Activity 24h</th>
    </tr>
    <tr class="active">
        <th>New Accounts</th>
        <th>Users Accessing</th>
        <th>Transfers</th>
        <th>Trades</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>194</td>
        <td>10,774</td>
        <td>10,100</td>
        <td>10,100</td>
    </tr>
    </tbody>
</table>













<table class="table table-condensed  table-bordered" >
    <thead>
    <tr class="active">
        <th colspan="3">Units of Measure</th>
    </tr>
    <tr class="active">
        <th>Abr.</th>
        <th>Name</th>
        <th>Conv.</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>mg</td>
        <td>milligrams</td>
        <td>0.001g</td>
    </tr>
    <tr>
        <td>g</td>
        <td>gram</td>
        <td>1g</td>
    </tr>
    <tr>
        <td>ozt</td>
        <td>troy ounce</td>
        <td>31.1034768g</td>
    </tr>
    <tr>
        <td>kg</td>
        <td>kilograms</td>
        <td>1,000g</td>
    </tr>
    <tr>
        <td>Mg</td>
        <td>megagrams</td>
        <td>1,000,000g</td>
    </tr>
    </tbody>
</table>

<table class="table table-condensed  table-bordered" >
    <thead>
    <tr   class="active" >
        <th>Notes</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Bullion is stored with LBMA member companies.</td><!--notes-->
    </tr>
    <tr>
        <td>All weights displayed are fine weight. Ounces are Troy.</td><!--notes-->
    </tr>
    <tr>
        <td>Totals are rounded to two decimal places for display.</td><!--notes-->
    </tr>
    </tbody>
</table>











<table class="table table-condensed  table-bordered" >
    <tr   class="active" >
        <th>Asset</th>
        <th>Type</th>
        <th>Price</th>
        <th>Issued (Storage)<br>Assets<br>Bullion Reserve SPT</th>
        <th>Obligations (in Circulation)<br>Liabilities<br>Total (Portfolios/Orderbooks)</th>
        <th>Market Value</th>
    </tr>
    <?php

    ////////////////////////
    //UNITS TOTAL AND IN CIRCULATION
    ////////////////////////
    //UNITS
    $unitsLocked =	query("SELECT SUM(total) AS total FROM orderbook WHERE (side='b')");	  // query user's portfolio
    if(empty($unitsLocked)){$unitsLocked[0]["total"]=0;}
    $unitsLocked = ($unitsLocked[0]["total"]); //shares trading
    $unitsAccounts =	query("SELECT SUM(units) as units FROM accounts");	 //query db
    if(empty($unitsAccounts)){$unitsAccounts[0]["units"]=0;}
    $unitsAccounts = ($unitsAccounts[0]["units"]);
    $totalUnits = $unitsAccounts + $unitsLocked;
    ?>
    <tr>
        <td><?php echo($unittype); ?></td>
        <td><?php echo('Currency'); ?></td>
        <td><?php echo($unitsymbol . number_format(1,$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalUnits),$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalUnits),$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalUnits),$decimalplaces,".",",")); ?></td>
    </tr>

    <?php







    ////////////////////////
    //REST OF ASSETS IN CIRCULATION
    ////////////////////////
    //ASSETS
    $assets =	query("SELECT symbol, issued, type FROM assets ORDER BY symbol ASC");	  // query user's portfolio
    foreach ($assets as $row)		// for each of user's stocks
    {
        echo('<tr>');

        $symbol = $row["symbol"];
        echo('<td>');
        echo($symbol);
        echo('</td>');

        //ASSETS TYPE
        $type = $row["type"]; //total issued
        echo('<td>');
        echo(ucfirst($type));
        echo('</td>');


        $AskPrice =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id=1)", $symbol);	  // query user's portfolio
        if(empty($AskPrice[0]["price"])){$AskPrice[0]["price"]=0;}
        //ASSETS PRICE
        $AskPrice = getPrice($AskPrice[0]["price"]);
        echo('<td>');
        echo($unitsymbol . number_format($AskPrice,$decimalplaces,".",","));
        echo('</td>');


        //ASSETS ISSUED
        $issued = $row["issued"]; //total issued
        echo('<td>' . number_format($issued,0,".",","));
        if($type=='commodity')
        {
            $storage = query("SELECT SUM(asw*quantity) AS weight FROM storage WHERE symbol=?", $symbol);
            $storage = $storage[0]["weight"]*31.1034768;
            echo(' (' . number_format($storage,$decimalplaces,".",",") . 'g)');
        }
        echo('</td>');

        $obligationPortfolio =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE (symbol =?)", $symbol);	  // query user's portfolio
        if(empty($obligationPortfolio[0]["quantity"])){$obligationPortfolio[0]["quantity"]=0;}
        $totalPortfolio = $obligationPortfolio[0]["quantity"]; //shares held
        $obligationOrderbook =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a')", $symbol);	  // query user's portfolio
        if(empty($obligationOrderbook[0]["quantity"])){$obligationOrderbook[0]["quantity"]=0;}
        $totalOrderbook = $obligationOrderbook[0]["quantity"]; //shares held
        //ASSETS IN CIRCULATION
        $obligations = ($totalPortfolio+$totalOrderbook); //total in circulation
        $obligationMV = ($AskPrice*$obligations);
        echo('<td>');
        echo(number_format($obligations,0,".",","));
        echo('(');
        echo(number_format($totalPortfolio,0,".",","));
        echo('/');
        echo(number_format($totalOrderbook,0,".",","));
        echo(')</td><td>');
        echo($unitsymbol . (number_format($obligationMV,$decimalplaces,".",",")));
        echo('</td>');


        echo('</tr>');
    }

    ?>



</table>




















<table class="table table-condensed  table-bordered" >
    <thead>
    <tr class="active">
        <th colspan="4">Velocity 24h</th>
    </tr>
    <tr class="active">
        <th>Metal</th>
        <th>Transfers</th>
        <th>Weight</th>
        <th>USD Equiv.</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Gold</td>
        <td>10,097</td>
        <td>26.68 kg</td>
        <td>$827,064.10</td>
    </tr>
    <tr>
        <td>Silver</td>
        <td>3</td>
        <td>145.11 g</td>
        <td>$85.71</td>
    </tr>
    </tbody>
</table>


<table class="table table-condensed  table-bordered" >
    <thead>
    <tr class="active">
        <th colspan="3">Distribution of Spends (XAU) 24h</th>
    </tr>
    <tr class="active">
        <th></th>
        <th>QTY</th>
        <th>Total</th>
    </tr>
    </thead>
    <?php
    function convertgram($total)
    {
        //CONVERT UNIT OF MEASURE TO APPROPRIATE UNIT (mg, g, kg, Mg)
        //everything in grams.
        //miligram
        if($total<1){$number = $total*1000; $unit = 'mg';}
        //gram
        if($total>=1 && $total<1000){$number = $total; $unit = 'g';}
        //kilogram
        if($total>=1000 && $total<1000000){$number = $total/1000; $unit = 'kg';}
        //megagram
        if($total>=1000000){$number = $total/1000000; $unit = 'Mg';}

        echo($number . $unit);
        return;

        //i.e. convergram($total); 
    }
    ?>
    <tbody>
    <tr>
        <td>0mg-1mg</td>
        <td>748</td>
        <td>407.83mg</td>
    </tr>
    <tr>
        <td>1mg-10mg</td>
        <td>2332</td>
        <td>9.67g</td>
    </tr>
    <tr>
        <td>10mg-100mg</td>
        <td>2407</td>
        <td>103.93mg</td>
    </tr>
    <tr>
        <td>1000mg-1g</td>
        <td>2816</td>
        <td>1.10kg</td>
    </tr>
    <tr>
        <td>1g-10g</td>
        <td>1408</td>
        <td>5.06kg</td>
    </tr>
    <tr>
        <td>10g-100g</td>
        <td>346</td>
        <td>10.58kg</td>
    </tr>
    <tr>
        <td>100g-1kg</td>
        <td>40</td>
        <td>9.83kg</td>
    </tr>
    <tr>
        <td>1kg-10kg</td>
        <td>0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>10kg-100kg</td>
        <td>0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>100kg-1Mg</td>
        <td>0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>1Mg-10Mg</td>
        <td>0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>10Mg+</td>
        <td>0</td>
        <td>0</td>
    </tr>
    </tbody>
</table>



























<?php
if(isset($_POST['storage']))
{
//get variables
    if ( empty($_POST['quantity']) ||  empty($_POST['userid'])) { apologize("Please fill all required fields."); } //check to see if empty
// if symbol or quantity empty
    $userid = sanatize('quantity', $_POST['userid']);
    $quantity = setPrice($_POST['quantity']);
    $transaction = strtoupper($_POST['transaction']);
    $symbol = $unittype;

    if($transaction=="WITHDRAW") {
        $totalq = query("SELECT units FROM accounts WHERE id = ?", $userid);
        @$total = (float)$totalq[0]["units"]; //convert array to value
        if ($quantity > $total)  //only allows user to deposit if they have less than
        {
            apologize("You only have " . number_format($total, 2, ".", ",") . " to withdraw!");
        }
        $quantity = ($quantity * -1);
    }


// transaction information
    query("SET AUTOCOMMIT=0");
    query("START TRANSACTION;"); //initiate a SQL transaction in case of error between transaction and commit
// update cash after transaction for user
    if (query("UPDATE accounts SET units = (units + ?) WHERE id = ?", $quantity, $userid) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P1.");} //update portfolio
//update transaction history for user
    if (query("INSERT INTO history (id, transaction, symbol, quantity, price, counterparty, total) VALUES (?, ?, ?, ?, ?, ?, ?)", $userid, $transaction, $symbol, 0, 0, $adminid, $quantity) === false)
    {query("ROLLBACK"); query("SET AUTOCOMMIT=1"); apologize("Database Failure #P2.");} //update portfolio
    query("COMMIT;"); //If no errors, commit changes
    query("SET AUTOCOMMIT=1");
}





$depository = query("SELECT depository, symbol, SUM(asw*quantity) AS weight, SUM(quantity) AS sumqty FROM storage GROUP BY depository, symbol");
$storage = query("SELECT * FROM storage WHERE 1"); // query database for user





$total = query("SELECT symbol, SUM(asw*quantity) AS weight FROM storage GROUP BY symbol");
foreach ($total as $row) {
    if (empty($total[0]["weight"])) {$total[0]["weight"] = 0;}
    $totalweight[$row["symbol"]] = $total[0]["weight"];
}
?>

<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <tr>
        <td colspan="12" class="success"><strong>STORAGE</strong></td>
    </tr>
    <tr class="active">
        <td>Depository</td>
        <td>Symbol</td>
        <td>Items (#)</td>
        <td>Weight (g)</td>
        <td>Weight (ozt)</td>
        <td>Portion (%)</td>

    </tr>
    <?php
    foreach ($depository as $row)
    {
        $weight=$row["weight"]; //*$row["quantity"];
        ?>
        <tr>
            <td><?php echo(htmlspecialchars($row["depository"])); ?></td>
            <td><?php echo(htmlspecialchars(strtoupper($row["symbol"]))); ?></td>
            <td><?php echo(number_format($row["sumqty"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format((31.1034768*$weight), 2, '.', ',')); ?></td>
            <td><?php echo(number_format($weight, 4, '.', ',')); ?></td>
            <td><?php echo(number_format((100*($weight/$totalweight[$row["symbol"]])), 2, '.', ',')); ?>%</td>
        </tr>
    <?php } ?>
</table>



















<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <tr>
        <td colspan="13" class="success"><strong>ITEMS</strong></td>
    </tr>
    <tr class="active">
        <td>UID</td>
        <td>Depository</td>
        <td>Symbol</td>
        <td>Description</td>
        <td>ASW</td>
        <td>Purity</td>
        <td>Country</td>
        <td>Year</td>
        <td>Weight (g)</td>
        <td>Weight (ozt)</td>
        <td># of Items</td>
        <td>Portion</td>

    </tr>

    <?php
    foreach ($storage as $row)
    {
        ?>
        <tr>

            <td><?php echo(number_format($row["uid"], 0, '.', ',')); ?></td>
            <td><?php echo(htmlspecialchars($row["depository"])); ?></td>
            <td><?php echo(htmlspecialchars(strtoupper($row["symbol"]))); ?></td>
            <td><?php echo(htmlspecialchars($row["description"])); ?></td>
            <td><?php echo(number_format($row["asw"], 2, '.', ',')); ?></td>
            <td><?php echo(number_format($row["purity"], 2, '.', ',')); ?></td>
            <td><?php echo(htmlspecialchars($row["country"])); ?></td>
            <td><?php echo(number_format($row["year"], 0, '.', '')); ?></td>
            <td><?php echo(number_format((31.1034768*$row["weight"]), 2, '.', ',')); ?></td>
            <td><?php echo(number_format($row["weight"], 4, '.', ',')); ?></td>
            <td><?php echo(number_format(($row["quantity"]), 0, '.', ',')); ?></td>
            <td><?php echo(number_format((100*($row["weight"]/$totalweight[$row["symbol"]])), 2, '.', ',')); ?>%</td>
        </tr>
    <?php } ?>
</table>

