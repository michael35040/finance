<style>
.symbolForm {
display: inline-block;
text-align:center;
width:25%;
}
</style>

<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <!--script type="text/javascript" src="../public_html/js/jsapi"></script-->
    <!--script type="text/javascript" src="https://www.google.com/jsapi"></script-->
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart()
        {
<?php
            if($tradesGroupChart != null)
            {
                ?>


            /////////////////
            //CHART 1
            //TRADES GROUP
            ////////////////
            var data = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Price', 'Volume(k)'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES

                foreach ($tradesGroupChart as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '')/1000;
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options =
            {
                title: '<?php echo($symbol); ?> - TRADES/DAY',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Price(avg) & Volume(k)', minValue: 0}
            };
            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            //////////////
            //END CHART 1
            ////////////


            //////////
            //CHART 2
            //TRADES
            //////////
            var data1 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Price', 'Volume'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES

                foreach ($tradesChart as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options1 =
            {
                title: '<?php echo($symbol); ?> - TRADES',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Price & Quantity', minValue: 0}
            };
            var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);
            //////////
            //END CHART 2
            ////////////


<?php }   //tradesgroupchart != null ?>



<?php
if($bidsGroupChart != null)
{
 ?>
            //////////
            //CHART 3
            //ORDERBOOK
            //////////
            var data2 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Bids', 'Asks'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES


                foreach ($bidsGroupChart as $trade)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
                }

                foreach ($asksGroupChart as $trade)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $date .  ", " . $quantity . "],");
                }




                ?>
            ]);
            var options2 =
            {
                title: '<?php echo($symbol); ?> - ORDERBOOK',
                hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true}
            };
            //var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div2'));
            var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));

            chart2.draw(data2, options2);
            //////////
            //END CHART 2
            ////////////

 <?php }   //$bidsGroupChart != null ?>

        }
    </script>
</head>

<?php
//echo(var_dump(get_defined_vars()));


if(isset($asks[0]["price"])) {echo('<br>   Ask: ' . number_format(($asks[0]["price"]), 2, '.', ''));}
else {echo('<br>   Trade: None');}

if(isset($trades[0]["price"])) {echo('<br>   Trade: ' . number_format(($trades[0]["price"]), 2, '.', ''));}
else {echo('<br>   Trade: None');}

if(isset($bids[0]["price"])) {echo('<br>   Bid: ' . number_format(($bids[0]["price"]), 2, '.', ''));}
else {echo('<br>   Trade: None');}
?>

<!--div id="chart_div" style="width: 900px; height: 500px;"></div-->
<?php
if($tradesGroupChart != null)
{ ?>
<div id="chart_div" style="overflow:hidden;"></div>
<?php } ?>


<?php
if($tradesChart != null)
{ ?>
<div id="chart_div1" style="overflow:hidden;"></div>
<?php } ?>








    <table class="table" align="center"> <!--class="bstable"-->

        <!--/////////TRADES//////-->
        <tr>
            <td colspan="7"></td>
        </tr>
        <!--blank row breaker-->
        <tr>
            <th colspan="7" bgcolor="black" style="color:white" size="+1">
                <?php echo($symbol); ?> - TRADES
            </th>
        </tr>

        <tr>
            <td>Trade #</td>
            <td>Buyer/Seller/Type</td>
            <td>Date/Time (Y/M/D)</td>
            <td>Symbol</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total</td>
        </tr>

        <?php

        foreach ($trades as $trade) {
            @$tradeID = $trade["uid"];
            @$tradeType = $trade["type"];
            @$buyer = $trade["buyer"];
            @$seller = $trade["seller"];
            @$symbol = $trade["symbol"];
            @$quantity = $trade["quantity"];
            @$price = $trade["price"];
            @$total = $trade["total"];
            @$date = $trade["date"];
            echo("
                <tr>
                <td>" . number_format($tradeID, 0, ".", ",") . "</td>
                <td>" . $buyer . "/" . $seller . "/" . strtoupper($tradeType) . "</td>
                <td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($date))) . "</td>
                <td>" . htmlspecialchars("$symbol") . "</td>
                <td>" . number_format($quantity, 0, ".", ",") . "</td>
                <td>$" . number_format($price, 2, ".", ",") . "</td>
                <td>$" . number_format($total, 2, ".", ",") . "</td>
                </tr>");
        } //foreach

        ?>

        <tr>
            <td colspan="7">


            </td>
        </tr>
        <!--blank row breaker-->
    </table>












<table class="table" align="center" border="0" style="width: 100%; display: inline-table; text-align:center"> <!--class="bstable"-->

    <!--/////////TRADES//////-->
    <tr><td colspan="3"></td></tr> <!--blank row breaker-->
    <tr>
        <th colspan="3" bgcolor="black" style="color:white" size="+1" >
            <?php echo($symbol); ?> - ORDERBOOK
        </th>
    </tr>

    <td style="width:10%">


        <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center; float:left">

            <!--/////////ORDERS - COMBINED//////-->
            <tr>
                <td colspan="2" bgcolor="blue" style="color:white" size="+1" >
                    <b>BIDS</b>
                </td>
            </tr>
            <tr>
                <td ><b>Qty</b></td>
                <td ><b>$</b></td>
            </tr>

            <?php
            foreach ($bidsGroup as $order)
            {
                $quantity = $order["quantity"];
                $price = $order["price"];
                echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
            }
            ?>

            <tr>
                <td><b><?php echo($bidsTotal);?></b></td>
                <td><b>ALL</b></td>
            </tr>

        </table>




    </td>
    <td style="vertical-align: bottom;">
                            <div id="chart_div2"></div>
    </td>
    <td style="width:10%">
        <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center; float:right">
            <tr>
                <td colspan="2" bgcolor="red" style="color:white" size="+1" >
                    <b>ASKS</b>
                </td>
            </tr>
            <tr>
                <td ><b>$</b></td>
                <td ><b>Qty</b></td>
            </tr>



            <?php
            foreach ($asksGroup as $order)
            {
                $price = $order["price"];
                $quantity = $order["quantity"];
                echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
            }
            ?>

            <tr>
                <td><b>ALL</b></td>
                <td><b><?php echo($asksTotal);?></b></td>
            </tr>


        </table>



    </td>
    </tr></table>













<table class="table" align="center">
    <!--/////////ORDERS - BIDS//////-->
    <tr><td colspan="7"></td></tr> <!--blank row breaker-->
    <tr>
        <th colspan="7" bgcolor="blue" style="color:white" size="+1" >
            ORDERS - BIDS
        </th>
    </tr>

    <tr>
        <td>Order #</td>
        <td>Side</td>
        <!--th>Type</th-->
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>

    <?php
    foreach ($bids as $row)
    {
        //if ($row["side"]=="b"){$row["side"]="Bid";}
        //if ($row["side"]=="a"){$row["side"]="Ask";}
        echo("<tr>");
        echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
        if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
        echo("<td>" . htmlspecialchars($side) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
        echo("<td>" . htmlspecialchars($row["quantity"]) . "</td>");
        echo("<td>" . (number_format($row["price"],2,".",",")) . "</td>");
        echo("</tr>");
    }
    ?>
    <!--/////////ORDERS - ASKS//////-->
    <tr><td colspan="7"></td></tr> <!--blank row breaker-->
    <tr>
        <th colspan="7" bgcolor="red" style="color:white" size="+1" >
            ORDERS - ASKS
        </th>
    </tr>

    <tr>
        <td>Order #</td>
        <td>Side</td>
        <!--th>Type</th-->
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>

    <?php
    foreach ($asks as $row)
    {
        //if ($row["side"]=="b"){$row["side"]="Bid";}
        //if ($row["side"]=="a"){$row["side"]="Ask";}
        echo("<tr>");
        echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
        if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
        echo("<td>" . htmlspecialchars($side) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
        echo("<td>" . htmlspecialchars($row["quantity"]) . "</td>");
        echo("<td>" . (number_format($row["price"],2,".",",")) . "</td>");
        echo("</tr>");

    }
    ?>
</table>





