

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

//CHART 1
        var data = google.visualization.arrayToDataTable([
            <?php
            echo("['Asset', 'Value'],");
            foreach ($portfolio as $asset) // for each of user's stocks
            {       $value = number_format(($asset["total"]), 0, '.', '');
                    $asset = htmlspecialchars($asset["symbol"]);
                    echo("['" . $asset . "', " . $value . "],");
            } ?>
        ]);
        var options = {
            title: 'Portfolio Assets by Value',
            //width: 500,
            height: 500,
            pieSliceText: 'label',
            //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
            //is3D: true,
            legend: {position: 'none'}
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);


//CHART 2     
        var data2 = google.visualization.arrayToDataTable([
            ['Accounts', 'Value'],
            ['<?php echo($unitdescription); ?>', <?php echo(number_format($units, 0, ".", "")) ?>],
            ['Locked', <?php echo(number_format($bidLocked, 0, ".", "")) ?>],
            ['Portfolio', <?php echo(number_format($portfolioTotal, 0, ".", "")) ?>]
        ]);
        var options2 = {
            title: 'Networth by Asset Value',
            pieSliceText: 'label',
            legend: {position: 'none'},
            // width: 500,
            //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
            //is3D: true,
            height: 500
        };
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);


    }
</script>



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
        <td colspan="3" style="font-size:20px; text-align: center;">USER</td>
    </tr>
    <tr>
        <td><strong>Name: </strong><?php echo(htmlspecialchars($fname . " " . $lname)); ?></td>
        <td><strong>Email: </strong><?php echo(htmlspecialchars($email)); ?></td>
        <td><span style="text-align:right"><strong>ID: </strong><?php echo(number_format($id, 0, '.', '')); ?></span></td>
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
    <tr  class="success">
        <td colspan="8" style="font-size:20px; text-align: center;">ACCOUNTS</td>
    </tr>
    <tr   class="active">
        <!--<th>Account #</th>-->
        <th>Type</th>
        <th>Description</th>
        <th>Locked*</th>
        <th>Available</th>
        <th><div style="text-align:right">Total</div></th>
    </tr>
        <tr><!--USD-->
            <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //  echo($id); $i++; echo("-" . $i); ?></td> -->
            <td><?php echo(strtoupper($unittype)) //set in finance.php ?></td></td>
            <td><?php echo($unitdescription); ?></td>
            <td><?php echo("<form action='orders.php' method='post'><span class='nobutton'><button type='submit' name='side' value='b'>" . $unitsymbol . number_format($bidLocked,2,".",",") . "</button></span></form>"); ?></td>
            <td><?php echo($unitsymbol . number_format($units,2,".",",")) ?></td>
            <td><div style="text-align:right"><?php echo($unitsymbol . number_format(($units+$bidLocked),2,".",",")) ?></div></td>
        </tr>
</table>






















<table class="table table-striped table-condensed table-bordered" >

    <tr class="success">
        <td colspan="8" style="font-size:20px; text-align: center;">PORTFOLIO</td>
    </tr> <!--blank row breaker-->

    <tr  class="active">
        <th>Asset</th>
        <th>Total (Control)</th>
        <th>Available</th>
        <th>Locked*</th>
        <th>Price</th>
        <th>Purchase</th>
        <th>Loss/Gain</th>
        <th><div style="text-align:right">Market Value</div></th>
    </tr>

<?php /*
    <tr><!--USD-->
        <td><?php //echo(strtoupper($unittype)); //echo($unitdescription); //set in finance.php ?></td>
        <td><?php //echo($unitsymbol . number_format(($bidLocked + $units),2,".",",")) ?></td>
        <td><?php //echo($unitsymbol . number_format($units,2,".",",")) ?></td>
        <td><?php //echo($unitsymbol . number_format($bidLocked, 2, ".", ",")) ?></td>
        <td><!--Price--></td>
        <td><!--Purchase--></td>
        <td><!--Loss/Gain--></td>
        <td><!--<div style="text-align:right">Market Value</div>--></td>
    </tr>
*/ ?>

    <!-- STOCKS ROW -->
    <?php $i = 0;
    foreach ($portfolio as $row) {
        $totalOwned=($row["quantity"]+$row["locked"]);
        echo("<tr>");
        echo("<td><span class='nobutton'><form method='post' action='information.php'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . $row['symbol']
            . "</button></form></span></td>");
        // . htmlspecialchars($row["symbol"]) .
        echo("<td>" . (number_format($totalOwned, 0, ".", ",")) . " (" . (number_format($row["control"], 2, ".", ",")) . "%)</td>");  //htmlspecialchars
        echo("<td>" . (number_format($row["quantity"], 0, ".", ",")) . "</td>");
        //echo("<td>" . (number_format($row["locked"], 0, ".", ",")) . "</td>");

        echo("<td><span class='nobutton'><form method='post' action='orders.php'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . (number_format($row["locked"], 0, ".", ","))
            . "</button></form></span></td>");


        echo("<td>" . $unitsymbol . (number_format($row["price"], 2, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . (number_format($row["value"], 2, ".", ",")) . "</td>");
        $pricechange = ($row["total"] - $row["value"]);
        if ($row["value"] > 0) {
            $percentchange = 100 * (($row["total"] / $row["value"]) - 1); // total/purchase
        } else {
            $percentchange = 0;
        }

        echo("<td>");

        //ARROWS START
        if ($row['value'] < $row['total']) {
            echo("<font color='#00FF00'>&#x25B2;</font>");
        } //money is up
        elseif ($row['value'] > $row['total']) {
            echo("<font color='#FF0000'>&#x25BC;</font>");
        }  //money is down
        else {
            echo("&#x25C4;");  //eft:[&#x25C4;]   right: [&#x25BA;]
        } //even left and right arrow
        //ARROWS END

        echo($unitsymbol . number_format($pricechange, 2, ".", ",") . " (<i>" . number_format($percentchange, 2, ".", ",") . "</i>%)  </td>");

        echo("<td><div style='text-align:right'>" . $unitsymbol . (number_format($row["total"], 2, ".", ",")) . "</div></td></tr>");
        $i++;
    } //foreach statement


    if ($i == 0) {
        echo("<tr><td colspan='8'>No assets currently held.</td></tr>");
        $portfolioTotal = 0;  //set to zero for networth calc
        ?>
        <tr  class="active">
            <td colspan="5"><strong>SUBTOTAL</strong> (<?php echo($i); ?> Assets) <i>&nbsp;&nbsp;&nbsp;&nbsp;<span class='nobutton'><form action='orders.php' method='post'><button type='submit' name='side' value='a'>*Pending Ask Orders</button></form></span></i></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
            <td><strong>0</strong></td>
        </tr>

    <?php
    } else {
        ?>


        <!-- TOTAL STOCK WORTH -->
        <tr  class="active">
            <td colspan="5"><strong>SUBTOTAL</strong> (<?php echo($i); ?> Assets) <i>&nbsp;&nbsp;&nbsp;&nbsp;<span class='nobutton'><form action='orders.php' method='post'><button type='submit' name='side' value='a'>*Pending Ask Orders</button></form></span></i></td>
            <td><strong>
                    <?php //calculate value of purchase price
                    echo($unitsymbol . number_format($purchaseprice, 2, ".", ",")); //display purchase price
                    ?></strong>
            </td>
            <td><strong>
                    <?php
                    $change = ($portfolioTotal - $purchaseprice);
                    if ($purchaseprice > 0) {$percent = 100 * (($portfolioTotal / $purchaseprice) - 1);} // total/purchase}
                    else {$percent = 0;}

                    //ARROWS START
                    if ($value < $portfolioTotal) {
                        echo("<font color='#00FF00'>&#x25B2;</font>");
                    } //money is up
                    elseif ($value > $portfolioTotal) {
                        echo("<font color='#FF0000'>&#x25BC;</font>");
                    }  //money is down
                    else {
                        echo("&#x25C4;"); //eft:[&#x25C4;]   right: [&#x25BA;]
                    } //even left and right arrow
                    //ARROWS END

                    echo($unitsymbol . number_format($change, 2, ".", ",") . " (<i>" . number_format($percent, 2, ".", ",") . "</i>%) "); //display change


                    ?></strong>
            </td>
            <td><div style="text-align:right">
                    <strong>
                        <?php
                        echo($unitsymbol . number_format($portfolioTotal, 2, ".", ",")); //display market value
                        ?></strong>
                </div></td>
        </tr>

    <?php
    } //$i==0 else statement
    ?>

</table>









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
                    echo($unitsymbol);
                    $networth = ($portfolioTotal + $units + $bidLocked);
                    echo(htmlspecialchars(number_format($networth, 2, ".", ","))); //networth defined previously
                    ?>
                </div></strong>
        </td>
    </tr>
    <?php if($i!=0){ ?>
        <tr>
            <td><div id="piechart"></div></td>
            <td><div id="piechart2"></div></td>
        </tr>
    <?php } ?>


</table>














<table class="table table-striped table-condensed table-bordered" >
    <tr  class="success">
        <td colspan="6" style="font-size:20px; text-align: center;">ACTIVITY</td>
    </tr>
    <tr>
        <td><strong>Assets: </strong><?php echo(number_format($count["assets"], 0, '.', ',')); ?></td>
        <td><strong>Orders: </strong><?php echo(number_format($count["orders"], 0, '.', ',')); ?></td>
        <td><strong>Trades: </strong><?php echo(number_format($count["trades"], 0, '.', ',')); ?></td>
        <td><strong>Trade Volume: </strong><?php echo(number_format($count["volume"], 0, '.', ',')); ?></td>
        <td><strong>Trade Value: </strong><?php echo($unitsymbol . number_format($count["value"], 2, '.', ',')); ?></td>
        <td><div style="text-align:right"><strong>Commissions: </strong><?php echo($unitsymbol . number_format($count["commission"], 2, '.', ',')); ?><div></td>
    </tr>
</table>


