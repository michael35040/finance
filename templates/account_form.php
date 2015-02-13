

<script type="text/javascript" src="https://www.google.com/jsapi"></script>




<style>
    .nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
</style>







<table class="table table-striped table-condensed table-bordered" >
    <tr  class="success">
        <td colspan="3" style="font-size:20px; text-align: center;">ACCOUNT</td>
    </tr>
    <tr>
        <td><strong>Name: </strong><?php echo(htmlspecialchars($fname . " " . $lname)); ?></td>
        <td><strong>Email: </strong><?php echo(htmlspecialchars($email)); ?></td>
        <td><span style="text-align:right"><strong>Account #: </strong><?php echo(number_format($id, 0, '.', '')); ?></span></td>
    </tr>
</table>





<?php if(!empty($notifications)) {?>
    <table class="table table-striped table-condensed table-bordered" >
    <tr  class="danger">
        <td colspan="3" style="font-size:20px; text-align: center;">NOTIFICATIONS</td>
    </tr>
    <?php foreach ($notifications as $notification) { ?>
        <tr>
            <td colspan="3"><form method="post" action="portfolio.php"><button type="submit" class="btn btn-danger btn-xs" name="cancel" value="<?php echo($notification["uid"]) ?>"><span class="glyphicon glyphicon-remove-circle"></span></button></form>
                <?php echo(htmlspecialchars("[" . date('F j, Y, g:ia', strtotime($notification["date"])) . "] " . $notification["notice"])); ?>
            </td>
        </tr>
    <?php
    } //if foreach
    ?>
    <tr>
        <td colspan="3"><form  method="post" action="portfolio.php"><button type="submit" class="btn btn-danger btn-xs" name="cancel" value="ALL"><span class="glyphicon glyphicon-remove-circle"></span></button></form>
            <strong>Remove All</strong>
        </td>
    </tr>
    </table><?php } //!empty ?>






























<table class="table table-condensed  table-bordered" >
    <tr>
        <td><b>Symbol</b></td>
        <td><b>Amount (Sum of Ledger All)</b></td>
    </tr>
    <?php
    $accounts = query("SELECT `symbol`, SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`category`!='order') GROUP BY `symbol`"); //trade, order, deposit, withdraw, transfer


    foreach ($accounts as $row) {

        if($row["symbol"]==$unittype){$row["amount"]=getPrice($row["amount"]);}
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["symbol"]) . "</td>");
        echo("<td>" . number_format(($row["amount"]),0,".",",") . "</td>");
        echo("<tr>");

    }
    ?>
</table>





<table class="table table-condensed  table-bordered" >
    <tr>
        <td><b>Symbol</b></td>
        <td><b>Amount (Sum of Ledger User)</b></td>
    </tr>
    <?php


        //NOT CALCULATING UNITTYPE CORRECTLY
        //I BELIEVE IT IS BECAUSE IT IS BLOCKING ORDER WHICH
        //THIS IS SHOWING HIGHER THAN THE OTHER SO IT IS NOT SUBTRACTING OPEN ORDERS
        //BUT THE SHARES ARE SHOWING CORRECTLY
    $accounts = query("SELECT `symbol`, SUM(`amount`) AS 'amount' FROM `ledger` WHERE (`user`=? AND `category`!='order') GROUP BY `symbol`", $id); //trade, order, deposit, withdraw, transfer


    foreach ($accounts as $row) {

        if($row["symbol"]==$unittype){$row["amount"]=getPrice($row["amount"]);}
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["symbol"]) . "</td>");
        echo("<td>" . number_format(($row["amount"]),0,".",",") . "</td>");
        echo("<tr>");

    }
    ?>
</table>









































<script>
    google.load("visualization", "1", {packages:["table"]});
    google.setOnLoadCallback(drawTable);

    function drawTable() {
        var tabledata = new google.visualization.DataTable();
        tabledata.addColumn('string', 'Asset');
        tabledata.addColumn('number', 'Total');
        tabledata.addColumn('number', 'Rate (<?php echo(strtoupper($unittype)); ?>)');
        tabledata.addColumn('number', 'Value');
        /*
         tabledata.addColumn('number', 'Available');
         tabledata.addColumn('number', 'Locked');
         tabledata.addColumn('number', 'Control');
         tabledata.addColumn('number', 'Purchase');
         tabledata.addColumn('number', 'Profit');
         tabledata.addColumn('number', 'Change');
         */
        tabledata.addRows([
            /*['Mike',  {v: 10000, f: '$10,000'}, true],*/
            [
                <?php echo("'" . strtoupper($unittype) . "',"); ?>
                <?php  $totalUnits = ($units+$bidLocked); echo("{v: " . $totalUnits . ", f: '" . number_format($totalUnits, $decimalplaces, ".", ",") . "'},"); ?>
                <?php echo("{v: " . 1 . ", f: '$" . number_format(1, $decimalplaces, ".", ",") . "'},"); ?>
                <?php  $totalUnits = ($units+$bidLocked); echo("{v: " . $totalUnits . ", f: '$" . number_format($totalUnits, $decimalplaces, ".", ",") . "'},"); ?>

                <?php // echo("{v: " . $units . ", f: '" . number_format($units, $decimalplaces, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . $bidLocked . ", f: '" . number_format($bidLocked, $decimalplaces, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . $totalUnits . ", f: '" . number_format($totalUnits, $decimalplaces, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . 0 . ", f: '" . number_format(0, 0, ".", ",") . "%'},"); ?>
                <?php // echo("{v: " . 0 . ", f: '$" . number_format(0, $decimalplaces, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . 0 . ", f: '$" . number_format(0, $decimalplaces, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . 0 . ", f: '" . number_format(0, $decimalplaces, ".", ",") . "%'},"); ?>

            ],
            <?php     foreach ($portfolio as $row) { ?>
            [
                <?php echo("'" . $row['symbol'] . "',"); ?>
                <?php echo("{v: " . ($row["quantity"]+$row["locked"]) . ", f: '" . number_format(($row["quantity"]+$row["locked"]), 0, ".", ",") . "'},"); ?>
                <?php echo("{v: " . $row['price'] . ", f: '$" . number_format($row['price'], 2, ".", ",") . "'},"); ?>
                <?php echo("{v: " . $row['total'] . ", f: '$" . number_format($row['total'], 2, ".", ",") . "'},"); //market value ?>

                <?php // echo("{v: " . $row['quantity'] . ", f: '" . number_format($row['quantity'], 0, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . $row['locked'] . ", f: '" . number_format($row['locked'], 0, ".", ",") . "'},"); ?>
                <?php // echo("{v: " . $row['control'] . ", f: '" . number_format($row['control'], 0, ".", ",") . "%'},"); ?>
                <?php // echo("{v: " . $row['value'] . ", f: '$" . number_format($row['value'], 2, ".", ",") . "'},"); ?>
                <?php // $pricechange = ($row["total"] - $row["value"]); echo("{v: " . $pricechange . ", f: '$" . number_format($pricechange, 2, ".", ",") . "'},"); ?>
                <?php // if ($row["value"] > 0) {$percentchange = 100 * (($row["total"] / $row["value"]) - 1);} else {$percentchange = 0;} echo("{v: " . $percentchange . ", f: '" . number_format($percentchange, 2, ".", ",") . "%'},"); ?>
            ],
            <?php
            }?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(tabledata, {showRowNumber: false});
    }

</script>

<div id="table_div"></div>




















<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        var chartdata = google.visualization.arrayToDataTable([
            <?php
            echo("['Asset', 'Value'],");
            foreach ($portfolio as $asset) // for each of user's stocks
            {       $value = number_format(($asset["total"]), $decimalplaces, '.', '');
                    $asset = htmlspecialchars($asset["symbol"]);
                    echo("['" . $asset . "', " . $value . "],");
            }
            echo("['" . htmlspecialchars($unittype) . "', " . number_format(($units+$bidLocked), $decimalplaces, '.', '') . "],");
           // echo("['Locked', " . number_format(($bidLocked), $decimalplaces, '.', '') . "]");
        ?>

        ]);
        var options = {
            //title: 'Portfolio Assets by Value',
            //width: 500,
            height: 500,
            //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
            //is3D: true,
            //legend: {position: 'none'},
            pieSliceText: 'label'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(chartdata, options);

    }
</script>

<div id="piechart"></div>


























<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#ADVANCE">ADVANCE</button>


<!-- Modal -->
<div class="modal fade" id="ADVANCE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">NETWORTH</h4>
</div>
<div class="modal-body">





















<table class="table table-striped table-condensed table-bordered" >

<tr  class="success">
    <td colspan="2" style="font-size:20px; text-align:center;">NETWORTH</td>
</tr>

<!-- NETWORTH ROW -->
<tr class="active">
    <td style="width:50%">
        <strong>TOTAL</strong>
    </td>
    <td style="width:50%">
        <strong><div style="text-align:right">
                <?php
                $networth = ($portfolioTotal + $units + $bidLocked);
                echo($unitsymbol . htmlspecialchars(number_format($networth, $decimalplaces, ".", ","))); //networth defined previously
                ?>
            </div></strong>
    </td>
</tr>


<tr>
    <td colspan="2">















        <table class="table table-condensed  table-bordered" >
            <tr  class="success">
                <td colspan="8" style="font-size:20px; text-align: center;">ACCOUNTS</td>
            </tr>
            <tr   class="active">
                <th>Asset</th>
                <th>Locked*</th>
                <th>Available</th>
                <th><div style="text-align:right">Value</div></th>
            </tr>
            <tr><!--USD-->
                <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td></td>
                <td><?php echo("<form action='orders.php' method='post'><span class='nobutton'><button type='submit' name='side' value='b'>" . $unitsymbol . number_format($bidLocked,$decimalplaces,".",",") . "</button></span></form>"); ?></td>
                <td><?php echo($unitsymbol . number_format($units,$decimalplaces,".",",")) ?></td>
                <td><div style="text-align:right"><?php echo($unitsymbol . number_format(($units+$bidLocked),$decimalplaces,".",",")) ?></div></td>
            </tr>

        </table>



    </td></tr><tr><td colspan="2">






        <table class="table table-striped table-condensed table-bordered" >
            <tr class="success">
                <td colspan="10" style="font-size:20px; text-align: center;">PORTFOLIO</td>
            </tr> <!--blank row breaker-->
            <tr  class="active">
                <th>Asset</th>
                <th>Type</th>
                <th>Control</th>
                <th>Available</th>
                <th><span class='nobutton'><form action='orders.php' method='post'><button type='submit' name='side' value='a'><b>Locked</b></button></form></span></th>
                <th>Total</th>
                <th>Price</th>
                <th>Purchase</th>
                <th>Loss/Gain</th>
                <th><div style="text-align:right">Value</div></th>
            </tr>
            <!-- STOCKS ROW -->
            <?php $i = 0;
            foreach ($portfolio as $row) {
                echo("<tr>");
                /*symbol*/      echo("<td><span class='nobutton'><form method='post' action='information.php'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . $row['symbol'] . "</button></form></span></td>"); // . htmlspecialchars($row["symbol"]) .
                /*type*/        echo("<td>" . ucfirst($row['type']) . "</td>");  //htmlspecialchars
                /*control*/     if($row['type']=='stock'){echo("<td>" . (number_format($row["control"], 2, ".", ",")) . "%</td>"); }else{echo("<td>N/A</td>");} //htmlspecialchars
                /*quantity*/    echo("<td>" . (number_format($row["quantity"], 0, ".", ",")) . "</td>");
                /*locked*/      echo("<td><span class='nobutton'><form method='post' action='orders.php'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . (number_format($row["locked"], 0, ".", ",")) . "</button></form></span></td>");
                /*total*/       echo("<td>" . (number_format(($row["quantity"]+$row["locked"]), 0, ".", ",")) . "</td>");  //htmlspecialchars
                /*price*/       echo("<td>" . $unitsymbol . (number_format($row["price"], $decimalplaces, ".", ",")) . "</td>");
                /*purchase*/    echo("<td>" . $unitsymbol . (number_format($row["value"], $decimalplaces, ".", ",")) . "</td>");

                                    $pricechange = ($row["total"] - $row["value"]);
                                    if ($row["value"] > 0) {$percentchange = 100 * (($row["total"] / $row["value"]) - 1);} else { $percentchange = 0;} echo("<td>");
                                    //ARROWS START
                                    if ($row['value'] < $row['total']) { echo("<font color='#00FF00'>&#x25B2;</font>");} //money is up
                                    elseif ($row['value'] > $row['total']) {echo("<font color='#FF0000'>&#x25BC;</font>");}  //money is down
                                    else {echo("&#x25C4;");}  //eft:[&#x25C4;]   right: [&#x25BA;] //even left and right arrow
                                    //ARROWS END
                /*pricechange*/ echo($unitsymbol . number_format($pricechange, $decimalplaces, ".", ",") . " (<i>" . number_format($percentchange, 2, ".", ",") . "</i>%)  </td>");
                /*mkt val*/     echo("<td><div style='text-align:right'>" . $unitsymbol . (number_format($row["total"], $decimalplaces, ".", ",")) . "</div></td></tr>");
                $i++;
            } //foreach statement
            if ($i == 0) {
                echo("<tr><td colspan='10'>No assets currently held.</td></tr>");
                $portfolioTotal = 0;  //set to zero for networth calc
                ?>
                <tr  class="active">
                    <td colspan="7"><strong>SUBTOTAL</strong> (<?php echo($i); ?> Assets)</td>
                    <td><strong>0</strong></td>
                    <td><strong>0</strong></td>
                    <td><strong>0</strong></td>
                </tr>
            <?php
            } else {
                ?>
                <!-- TOTAL STOCK WORTH -->
                <tr  class="active">
                    <td colspan="7"><strong>SUBTOTAL</strong> (<?php echo($i); ?> Assets)</td>
                    <td><strong>
                            <?php //calculate value of purchase price
                            echo($unitsymbol . number_format($purchaseprice, $decimalplaces, ".", ",")); //display purchase price
                            ?></strong>
                    </td>
                    <td><strong>
                            <?php
                            $change = ($portfolioTotal - $purchaseprice);
                            if ($purchaseprice > 0) {$percent = 100 * (($portfolioTotal / $purchaseprice) - 1);} // total/purchase}
                            else {$percent = 0;}

                            //ARROWS START
                            if ($purchaseprice < $portfolioTotal) {
                                echo("<font color='#00FF00'>&#x25B2;</font>");
                            } //money is up
                            elseif ($purchaseprice > $portfolioTotal) {
                                echo("<font color='#FF0000'>&#x25BC;</font>");
                            }  //money is down
                            else {
                                echo("&#x25C4;"); //eft:[&#x25C4;]   right: [&#x25BA;]
                            } //even left and right arrow
                            //ARROWS END
                            echo($unitsymbol . number_format($change, $decimalplaces, ".", ",") . " (<i>" . number_format($percent, 2, ".", ",") . "</i>%) "); //display change
                            ?></strong>
                    </td>
                    <td><div style="text-align:right">
                            <strong>
                                <?php
                                echo($unitsymbol . number_format($portfolioTotal, $decimalplaces, ".", ",")); //display market value
                                ?></strong>
                        </div></td>
                </tr>

            <?php
            } //$i==0 else statement
            ?>
        </table>











        <table class="table table-striped table-condensed table-bordered" >
            <tr class="success">
                <td colspan="6" style="font-size:20px; text-align: center;">ACTIVITY</td>
            </tr>
            <tr class="active">
                <th>Assets</th>
                <th>Orders</th>
                <th>Trades</th>
                <th>Volume</th>
                <th>Value</th>
                <th>Commissions</th>
            </tr>

            <tr>

                <td><?php echo(number_format($count["assets"], 0, '.', ',')); ?></td>
                <td><?php echo(number_format($count["orders"], 0, '.', ',')); ?></td>
                <td><?php echo(number_format($count["trades"], 0, '.', ',')); ?></td>
                <td><?php echo(number_format($count["volume"], 0, '.', ',')); ?></td>
                <td><?php echo($unitsymbol . number_format($count["value"], $decimalplaces, '.', ',')); ?></td>
                <td><?php echo($unitsymbol . number_format($count["commission"], $decimalplaces, '.', ',')); ?></td>

            </tr>
        </table>





    </td>
</tr>


</table>










</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

















