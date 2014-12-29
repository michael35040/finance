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






















<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#activity">ACTIVITY</button>


<!-- Modal -->
<div class="modal fade" id="activity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">ACTIVITY</h4>
</div>
<div class="modal-body">









<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
<tr>
    <td colspan="8" class="success"><strong>ACTIVITY</strong></td>
</tr>
<tr class="active">
    <td>PERIOD</td><td>USERS</td><td>ASSETS</td><td>TRANSFERS</td><td>ORDERS</td><td>TRADES</td><td>TRADE VOLUME</td><td>TRADE VALUE</td>
</tr>
<?php
//TODAY D1
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["usersday1"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["assetsday1"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["ordersday1"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 1 DAY) AND NOW())"); // query database for user
$dash["tradesday1"] = $count[0]["total"];
$dash["valueday1"] = $count[0]["value"];
$dash["volumeday1"] = $count[0]["volume"];
?>
<tr>
    <td>Day 1</td>
    <td><?php echo(number_format($dash["usersday1"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday1"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday1"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday1"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday1"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday1"]), 2, '.', ',')); ?></td>
</tr>
<?php
//YESTERDAY D2
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 48 HOUR)");
$dash["usersday2"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 48 HOUR)");
$dash["assetsday2"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 48 HOUR)");
$dash["ordersday2"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 48 HOUR)");
$dash["tradesday2"] = $count[0]["total"];
$dash["valueday2"] = $count[0]["value"];
$dash["volumeday2"] = $count[0]["volume"];
?>
<tr>
    <td>Day 2</td>
    <td><?php echo(number_format($dash["usersday2"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday2"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday2"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday2"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday2"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday2"]), 2, '.', ',')); ?></td>
</tr>
<?php
//D3
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 72 HOUR)");
$dash["usersday3"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 72 HOUR)");
$dash["assetsday3"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 72 HOUR)");
$dash["ordersday3"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 48 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 72 HOUR)");
$dash["tradesday3"] = $count[0]["total"];
$dash["valueday3"] = $count[0]["value"];
$dash["volumeday3"] = $count[0]["volume"];
?>
<tr>
    <td>Day 3</td>
    <td><?php echo(number_format($dash["usersday3"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday3"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday3"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday3"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday3"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday3"]), 2, '.', ',')); ?></td>
</tr>
<?php
//D4
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 96 HOUR)");
$dash["usersday4"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 96 HOUR)");
$dash["assetsday4"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 96 HOUR)");
$dash["ordersday4"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 72 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 96 HOUR)");
$dash["tradesday4"] = $count[0]["total"];
$dash["valueday4"] = $count[0]["value"];
$dash["volumeday4"] = $count[0]["volume"];
?>
<tr>
    <td>Day 4</td>
    <td><?php echo(number_format($dash["usersday4"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday4"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday4"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday4"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday4"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday4"]), 2, '.', ',')); ?></td>
</tr>
<?php
//D5
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 120 HOUR)");
$dash["usersday5"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 120 HOUR)");
$dash["assetsday5"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 120 HOUR)");
$dash["ordersday5"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 96 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 120 HOUR)");
$dash["tradesday5"] = $count[0]["total"];
$dash["valueday5"] = $count[0]["value"];
$dash["volumeday5"] = $count[0]["volume"];
?>
<tr>
    <td>Day 5</td>
    <td><?php echo(number_format($dash["usersday5"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday5"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday5"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday5"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday5"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday5"]), 2, '.', ',')); ?></td>
</tr>
<?php
//D6
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 144 HOUR)");
$dash["usersday6"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 144 HOUR)");
$dash["assetsday6"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 144 HOUR)");
$dash["ordersday6"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 120 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 144 HOUR)");
$dash["tradesday6"] = $count[0]["total"];
$dash["valueday6"] = $count[0]["value"];
$dash["volumeday6"] = $count[0]["volume"];
?>
<tr>
    <td>Day 6</td>
    <td><?php echo(number_format($dash["usersday6"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday6"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday6"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday6"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday6"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday6"]), 2, '.', ',')); ?></td>
</tr>
<?php
//D7
$count = query("SELECT COUNT(id) AS total FROM users WHERE `registered` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `registered` > DATE_SUB(NOW(), INTERVAL 168 HOUR)");
$dash["usersday7"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE `date` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 168 HOUR)");
$dash["assetsday7"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE `date` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 168 HOUR)");
$dash["ordersday7"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE `date` < DATE_SUB(NOW(), INTERVAL 144 HOUR) AND `date` > DATE_SUB(NOW(), INTERVAL 168 HOUR)");
$dash["tradesday7"] = $count[0]["total"];
$dash["valueday7"] = $count[0]["value"];
$dash["volumeday7"] = $count[0]["volume"];
?>
<tr>
    <td>Day 7</td>
    <td><?php echo(number_format($dash["usersday7"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsday7"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersday7"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesday7"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeday7"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday7"]), 2, '.', ',')); ?></td>
</tr>
<?php
//WEEK
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["usersweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["assetsweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["ordersweek"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 7 DAY) AND NOW())"); // query database for user
$dash["tradesweek"] = $count[0]["total"];
$dash["valueweek"] = $count[0]["value"];
$dash["volumeweek"] = $count[0]["volume"];
?>
<tr class="active">
    <td>Last 7d</td>
    <td><?php echo(number_format($dash["usersweek"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsweek"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersweek"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesweek"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumeweek"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valueweek"]), 2, '.', ',')); ?></td>
</tr>
<?php
//MONTH
$count = query("SELECT COUNT(id) AS total FROM users WHERE (`registered`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["usersmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["assetsmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["ordersmonth"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades WHERE (`date`  BETWEEN DATE_SUB(now(), INTERVAL 30 DAY) AND NOW())"); // query database for user
$dash["tradesmonth"] = $count[0]["total"];
$dash["valuemonth"] = $count[0]["value"];
$dash["volumemonth"] = $count[0]["volume"];
?>
<tr class="active">
    <td>Last 30d</td>
    <td><?php echo(number_format($dash["usersmonth"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetsmonth"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["ordersmonth"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradesmonth"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumemonth"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valuemonth"]), 2, '.', ',')); ?></td>
</tr>
<?php
//TOTAL
$count = query("SELECT COUNT(id) AS total FROM users"); // query database for user
$dash["userstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM assets"); // query database for user
$dash["assetstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total FROM orderbook"); // query database for user
$dash["orderstotal"] = $count[0]["total"];
$count = query("SELECT COUNT(uid) AS total, SUM(total) AS value, SUM(quantity) AS volume FROM trades"); // query database for user
$dash["tradestotal"] = $count[0]["total"];
$dash["valuetotal"] = $count[0]["value"];
$dash["volumetotal"] = $count[0]["volume"];
?>
<tr class="active">
    <td>Total</td>
    <td><?php echo(number_format($dash["userstotal"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["assetstotal"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format(0, 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["orderstotal"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["tradestotal"], 0, '.', ',')); ?></td>
    <td><?php echo(number_format($dash["volumetotal"], 0, '.', ',')); ?></td>
    <td><?php echo($unitsymbol . number_format(getPrice($dash["valuetotal"]), 2, '.', ',')); ?></td>
</tr>
</table>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>



















<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#measure">UNITS OF MEASURE</button>


<!-- Modal -->
<div class="modal fade" id="measure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">UNITS OF MEASURE</h4>
            </div>
            <div class="modal-body">









<table class="table table-condensed  table-bordered" >
                    <thead>
                    <tr class="success">
                        <th colspan="3">UNITS OF MEASURE</th>
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





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




















<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#LEDGER">LEDGER</button>


<!-- Modal -->
<div class="modal fade" id="LEDGER" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">LEDGER</h4>
</div>
<div class="modal-body">








<table class="table table-condensed  table-bordered" >
    <tr class="success">
        <th colspan="6">LEDGER</th>
    </tr>
    <tr   class="active" >
        <th>Asset</th>
        <th>Type</th>
        <th>Price</th>
        <th>Assets/Reserves<br>Issued (Storage)</th>
        <th>Liabilities (in Circulation)<br>Total (Account/Order Book)</th>
        <th>Reserve<br>Ratio</th>
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
        <td><?php echo($unittype2); ?></td>
        <td><?php echo($unitsymbol . number_format(1,$decimalplaces,".",",")); ?></td>
        <td><?php echo(number_format(getPrice($totalUnits),$decimalplaces,".",",")); ?></td>
        <td><!--total(accounts/bid orders)-->
            <?php echo(number_format(getPrice($totalUnits),$decimalplaces,".",",")); ?> (<?php echo(number_format(getPrice($unitsAccounts),$decimalplaces,".",",")); ?>/<?php echo(number_format(getPrice($unitsLocked),$decimalplaces,".",",")); ?>)
        </td>
        <td><?php echo(number_format((($totalUnits/$totalUnits)*100),2,".",",") . "%"); ?></td>
        


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

        //ASSET PRICE
        $AskPrice =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a' AND id=1)", $symbol);	  // query user's portfolio
        if(empty($AskPrice[0]["price"])){$AskPrice[0]["price"]=0;}
        //ASSETS PRICE
        $AskPrice = getPrice($AskPrice[0]["price"]);
        echo('<td>');
        echo($unitsymbol . number_format($AskPrice,$decimalplaces,".",","));
        echo('</td>');


        //OBLIGATIONS - ASSETS ISSUED
        $issued = $row["issued"]; //total issued
        echo('<td>');
        echo(number_format($issued,0,".",","));
        if($type=='commodity')
        {
            $storage = query("SELECT SUM(asw*quantity) AS weight FROM storage WHERE symbol=?", $symbol);
            //CONVERT FROM OZT TO GRAMS
            $storage = $storage[0]["weight"]*31.1034768; $unitofmeasure='g';
            //IF LESS THAN GRAM = MILLIGRAM (mg)
            if($storage<1){$storage=$storage*1000; $unitofmeasure='mg';}
            //IF MORE THAN 1000 GRAMS: KILOGRAM (kg)
            if($storage>1000){$storage=$storage/1000; $unitofmeasure='kg';}
            //IF MORE THAN 1million grams: Megagrams (Mg)
            if($storage>1000000){$storage=$storage/1000000; $unitofmeasure='Mg';}

            echo(' (' . number_format($storage,2,".",",") . $unitofmeasure . ')');
        }
        echo('</td>');


        //LIABILITIES - ASSETS IN CIRCULATION
        //PORTFOLIO
        $obligationPortfolio =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE (symbol =?)", $symbol);
        if(empty($obligationPortfolio[0]["quantity"])){$obligationPortfolio[0]["quantity"]=0;}
        $totalPortfolio = $obligationPortfolio[0]["quantity"];
        //ORDERBOOK
        $obligationOrderbook =	query("SELECT SUM(quantity) AS quantity, price FROM orderbook WHERE (symbol =? AND side='a')", $symbol);
        if(empty($obligationOrderbook[0]["quantity"])){$obligationOrderbook[0]["quantity"]=0;}
        $totalOrderbook = $obligationOrderbook[0]["quantity"];
        //TOTAL
        $obligations = ($totalPortfolio+$totalOrderbook);
        //$obligationMV = ($AskPrice*$obligations);
        echo('<td>');
        echo(number_format($obligations,0,".",","));
        echo(' (');
        echo(number_format($totalPortfolio,0,".",","));
        echo('/');
        echo(number_format($totalOrderbook,0,".",","));
        echo(')</td>');


        //RATIO
        echo('<td>');
        echo(number_format((($obligations/$issued)*100),2,".",",") . "%");
        echo('</td>');


        echo('</tr>');
    }

    ?>



</table>



</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>











































<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#storage">STORAGE</button>


<!-- Modal -->
<div class="modal fade" id="storage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">STORAGE</h4>
            </div>
            <div class="modal-body">




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




</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>






























<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#VELOCITY">VELOCITY</button>


<!-- Modal -->
<div class="modal fade" id="VELOCITY" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">VELOCITY</h4>
            </div>
            <div class="modal-body">






            <table class="table table-condensed  table-bordered" >
    <thead>
    </thead>
    <tbody>
    <tr class="success">
        <th colspan="4">XAU - TRANSFER VELOCITY 24h</th>
    </tr>
    <tr class="active">
        <th>Distribution</th>
        <th>Transfers</th>
        <th>Weight</th>
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
    <tr class="active">
        <td>TOTAL</td>
        <td>10,097</td>
        <td>26.68 kg</td>
    </tr>
    </tbody>
</table>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
















<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#COMMISSION">COMMISSION</button>


<!-- Modal -->
<div class="modal fade" id="COMMISSION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">COMMISSION</h4>
            </div>
            <div class="modal-body">


<?php
//COMMISSIONS
$commissionsPaid = query("SELECT SUM(commission) AS commission FROM trades WHERE (type='limit' OR type='market')"); // query database for user
$commissionsPaid = $commissionsPaid[0]["commission"];

?>


<table class="table table-condensed table-striped table-bordered" id="commissions" style="border-collapse:collapse;text-align:center;vertical-align:middle;">
    <tr>
        <td colspan="7" class="success"><strong>COMMISSIONS</strong></td>
    </tr>
    <tr>
        <td>$<?php echo(number_format(getPrice($commissionsPaid), 2, '.', ',')); ?></td>
    </tr>
</table>



</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>





<p>
    <b>Notes: </b>
    All weights displayed are fine weight. Totals are rounded for display.
</p>
