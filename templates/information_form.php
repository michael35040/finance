<style>
    .symbolForm {
        display: inline-block;
        text-align:center;
        width:25%;
    }
    .panel-success .panel-heading
    {
        /*color: #3c763d;*/
        background-color: #dff0d8;
        border-color: #d6e9c6;
        font-size: 20px;
        color: black;
        padding: 5px 5px 5px 5px;
    }
</style>
<?php //need To ensure the vars sugh as bids group arefed. ?>
<head>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <!--  <script type="text/javascript" src="js/jsapi"></script> -->
     <!--script type="text/javascript" src="https://www.google.com/jsapi"></script-->
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart()
        {
        <?php
            if($tradesGroup != null)
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

                foreach ($tradesGroup as $trade)	// for each of user's stocks
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
                //height: 500,
                
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
                $tradesChart = array_reverse($trades); //so it will be in correct ASC order for chart
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
                //height: 500,

            };
            var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);
            //////////
            //END CHART 2
            ////////////


            <?php }   //tradesgroup != null ?>



            <?php
            if($bidsGroup != null)
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

                $bidsGroupChart = array_reverse($bidsGroup); //so it will be in correct ASC order for chart
                foreach ($bidsGroupChart as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($order["price"]), 2, '.', '');
                    $quantity = number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
                }

                foreach ($asksGroup as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($order["price"]), 2, '.', '');
                    $quantity = number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $date .  ", " . $quantity . "],");
                }




                ?>
            ]);
            var options2 =
            {
                title: '<?php echo($symbol); ?> - ORDERBOOK',
                hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true}
               // height: 500,

            };
            //var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div2'));
            var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));

            chart2.draw(data2, options2);
            //////////
            //END CHART
            ////////////
            <?php }   //$bidsGroupChart != null ?>



            /////////////////
            //CHART PIE
            //OWNERSHIP
            ////////////////

            var data3 = google.visualization.arrayToDataTable([
                ['User', 'Quantity'],
               <?php
               $owned=0;
               foreach ($ownership as $owners)	// for each of user's stocks
                {
                    $quantity = number_format(($owners["quantity"]), 0, '.', '');
                    $id = number_format(($owners["id"]), 0, '.', '');
                    echo("['User: " . $id . "', " . $quantity . "],");
                    $owned=$owned+$quantity;
                }

            $asset["askstotal"]=number_format(($asset["askstotal"]), 0, '.', '');
            $leftOver=($asset["public"]-$owned-$asset["askstotal"]); //takes the amount issued and subtracts the listed owned to figure out how many shares are left from top listed users for pie chart
            $leftOver=number_format(($leftOver), 0, '.', '');
            echo("['Other Users', " . $leftOver . "],");
            echo("['Orderbook', " . $asset["askstotal"] . "],");
            //if($leftOver>0){} //if($askQuantity>0){}
             //   ['Work',     11],
             //   ['Sleep',    7]
                ?>
            ]);




            var options3 = {
                //title: 'Ownership Control',
                //is3D: true,
                //legend: 'none',
                //pieSliceText: 'percentage' //'label', 'percentage', 'value', 'none'
                //width: 400,
                height: 500
                //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],

            };

            var chart3 = new google.visualization.PieChart(document.getElementById('piechart'));

            chart3.draw(data3, options3);



            /////////////////
            //END CHART
            ////////////////















            //////////
            //CHART 4
            //ORDERBOOK V2 BID ASK WALL
            //////////
            var data4 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Bids', 'Asks'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES
                $bquantity=0; $i=0;
                $bidsG2=[];
                foreach ($bidsGroupAll as $order)	// for each of user's stocks
                { $i++;
                    $date = 0;
                    $order["price"];
                    $bquantity = $bquantity+$order["quantity"];
                    $order["quantity"] = $bquantity;
                    $bidsG2[$i]=$order;
                }
                $bidsGroupChart = array_reverse($bidsG2); //so it will be in correct ASC order for chart
                foreach ($bidsGroupChart as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($order["price"]), 2, '.', '');
                    $quantity =  number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
                }

                $aquantity=0;
                foreach ($asksGroupAll as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(($order["price"]), 2, '.', '');
                    $aquantity2 = $order["quantity"];
                    $aquantity = ($aquantity + $aquantity2);
                    $aquantity =  number_format(($aquantity), 2, '.', '');
                    echo("['" . $price . "', " . $date .  ", " . $aquantity . "],");
                }

                ?>
            ]);
            var options4 =
            {
                title: '<?php echo($symbol); ?> - BID ASK WALL',
                hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true}
                // height: 500,

            };
            var chart4 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div4'));

            chart4.draw(data4, options4);
            //////////
            //END CHART 3A V2
            ////////////






















//echo(var_dump(get_defined_vars()));
        }
    </script>
</head>

<?php
if(isset($asks[0]["price"])) {$asksPrice=$asks[0]["price"];}else{$asksPrice=0;}
if(isset($bids[0]["price"])) {$bidsPrice=$bids[0]["price"];}else{$bidsPrice=0;}
if(isset($trades[0]["price"])) {$tradesPrice=$trades[0]["price"];}else{$tradesPrice=0;}
?>


    
    
    <div class="panel panel-success"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">INFORMATION</div>
<table class="table">
    <thead>
    </thead>
    <tbody>
    <tr >
        <td>
            Symbol: <?php echo(htmlspecialchars($asset["symbol"])) ?><br>
            Name: <?php echo(htmlspecialchars($asset["name"])) ?><br>
            URL: <?php echo(htmlspecialchars($asset["url"])) ?><br>
            Market Cap: <?php echo($unitsymbol . number_format($asset["marketcap"], 2, ".", ",")) ?>

        </td>
        <td >
            <?php echo($unitsymbol . number_format($tradesPrice, 2, ".", ",")) ?> - Price<br>
            <?php echo($unitsymbol . number_format($bidsPrice, 2, ".", ",")) ?> - Bid<br>
            <?php echo($unitsymbol . number_format($asksPrice, 2, ".", ",")) ?> - Ask<br>
            <?php echo($unitsymbol . number_format($asset["avgprice"], 2, ".", ",")) ?> - Avg. (30d)
        </td>
        <td >
            <?php echo(number_format($asset["volume"], 0, ".", ",")) ?> - Volume (30d)<br>
            <?php echo(number_format($asset["public"], 0, ".", ",")) ?> - Publicly Held<br>
            <?php echo(number_format($asset["issued"], 0, ".", ",")) ?> - Issued (<?php echo(number_format($asset["userid"], 0, ".", ",")) ?>)<br>
            <?php echo(htmlspecialchars($asset["date"])) ?> - Listed
        </td>
        <td >
            Dividend: <?php echo(number_format($asset["dividend"], 2, ".", ",")) ?><br>
            Rating: <?php echo(htmlspecialchars($asset["rating"])) ?><br>
            Type: <?php echo(htmlspecialchars(ucfirst($asset["type"]))) ?>
        </td>
    </tr>
    <tr>
        <td colspan="4">Description: <?php echo(htmlspecialchars(ucfirst($asset["description"]))) ?></td>
    </tr>
    </tbody>
</table>
    </div><!--panel-primary-->


























    <div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">YOUR ACCOUNT</div>
<table class="table">

        <thead>
    <tr class="active">            
        <th colspan="1">Portfolio</th>
        <th colspan="1">Orderbook</th>
        <th colspan="1">Total</th>
        <th colspan="1">Controlling Interest</th>
        <th colspan="1">Value</th>
    </tr>            
        </thead>
<tbody>
    <tr>
        <td colspan="1"><?php echo(number_format($asset["userportfolio"], 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format($asset["userlocked"], 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format(($asset["userlocked"]+$asset["userportfolio"]), 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format($asset["control"], 0, ".","")) ?>%</td>
        <td colspan="1"><?php echo($unitsymbol . number_format((($asset["userlocked"]+$asset["userportfolio"])*$asset["price"]), 0, ".", ",")) ?></td>
    </tr>
</tbody>
</table>
    </div><!--panel-primary your account-->















    <div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">TRADES</div>
<table class="table">
<?php
if($tradesGroup != null)
{ ?>
    <tr><td colspan="7"><div id="chart_div" style="overflow:hidden;"></div></td></tr>
<?php } ?>


<?php
if($trades != null)
{ ?>
    <tr><td colspan="7"><div id="chart_div1" style="overflow:hidden;"></div></td></tr>
<?php } ?>

    <tr class='active'>
        <td>Trade #</td>
        <td>Buyer-Bid/Seller-Ask/Type</td>
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Total</td>
    </tr>

    <?php
    $i=0;
    foreach ($trades as $trade) {
        @$tradeID = $trade["uid"];
        @$tradeType = $trade["type"];
        @$biduid = $trade["bidorderuid"];//$trade["buyer"];
        @$askuid = $trade["askorderuid"];
        @$buyer = $trade["buyer"];//$trade["buyer"];
        @$seller = $trade["seller"];
        @$symbol = $trade["symbol"];
        @$quantity = $trade["quantity"];
        @$price = $trade["price"];
        @$total = $trade["total"];
        @$date = $trade["date"];
        echo("
                <tr>
                <td>" . number_format($tradeID, 0, ".", ",") . "</td>
                <td>" . $buyer . "-" . $biduid . "/" . $seller . "-" . $askuid . "/" . strtoupper($tradeType) . "</td>
                <td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($date))) . "</td>
                <td>" . htmlspecialchars("$symbol") . "</td>
                <td>" . number_format($quantity, 0, ".", ",") . "</td>
                <td>$" . number_format($price, 2, ".", ",") . "</td>
                <td>$" . number_format($total, 2, ".", ",") . "</td>
                </tr>");
        $i++;
        if($i==5){break;}
    } //foreach

    ?>

</table>
    </div><!--panel-primary trades-->












<div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">ORDERBOOK (BID-ASK WALL)</div>
    <table class="table">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td>
                <div id="chart_div4" style="overflow:hidden;">
            </td>
        </tr>
        </tbody>


    </table>

</div><!--panel-primary orderbook-->












<div class="panel panel-primary">
<!-- Default panel contents -->
<div class="panel-heading">ORDERBOOK</div>
<table class="table">
<tr>
    <td style="width:10%">
    <div class="panel panel-info">
    <!-- Default panel contents -->
    <div class="panel-heading">BIDS</div>
        <table class="table" style="display: inline-table;text-align:center;">
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
                <td><b><?php echo(number_format($asset["bidstotal"],0,".",","));?></b></td>
                <td><b>ALL</b></td>
            </tr>

        </table>
    </div><!--panel bids-->

    </td>
    <td style="vertical-align: bottom;">
        <div id="chart_div2"></div>
    </td>
    <td style="width:10%">
    
    <div class="panel panel-danger">
    <!-- Default panel contents -->
    <div class="panel-heading">ASKS</div>

        <table class="table" style="display: inline-table;text-align:center;">
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
                <td><b><?php echo(number_format($asset["askstotal"],0,".",","));?></b></td>
            </tr>



        </table>
    </div><!--panel danger asks-->
    </td>
</tr><!--orderbook chart row-->
<tr><!--bids-->
<td colspan="3">


    <div class="panel panel-info">
    <!-- Default panel contents -->
    <div class="panel-heading">TOP BIDS</div>
    <table class="table" align="center">
    <tr class="active">
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
        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
        echo("<td>" . (number_format($row["price"],2,".",",")) . "</td>");
        echo("</tr>");
    }
    ?>
    </table>
    </div><!--panel order bids-->


</td>    
</tr><!--orderbook bids row-->
<tr><!--orderbook asks row-->
<td colspan="3">

    <div class="panel panel-danger">
    <!-- Default panel contents -->
    <div class="panel-heading">TOP ASKS</div>
    <table class="table" align="center">
    <tr class="active">
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
        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
        echo("<td>" . (number_format($row["price"],2,".",",")) . "</td>");
        echo("</tr>");

    }
    ?>

    </table>
    </div><!--panel order asks-->

</td>
</tr><!--orderbook asks row-->
</table><!--orderbook table-->
</div><!--panel-primary orderbook-->











    <div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">OWNERSHIP - MAJOR HOLDERS</div>
    <table class="table">
    <thead>
    <tr class="active">
        <th>Holder</th>
        <th>Quantity</th>
        <th>Percentage</th>
    </tr>
    </thead>
    <tbody>


    <?php
    foreach ($ownership as $row)
    { $percentage=($row["quantity"]/$asset["public"])*100;
        echo("<tr>");
        echo("<td>User: <b>" . (number_format($row["id"],0,".",",")) . "</b> (sans orderbook)</td>");
        echo("<td>" . (number_format($row["quantity"],0,".",",")) . "</td>");
        echo("<td>" . (number_format($percentage,2,".",",")) . "%</td>");
        echo("</tr>");
    }

   // if($leftOver>0)
   // {
        $percentage=($leftOver/$asset["public"])*100;
        echo("<tr><td>Other Users</td><td>" . number_format($leftOver, 0, '.', '') . "</td><td>" . (number_format($percentage,2,".",",")) . "%</td>");
   // }

    //if($asset["askstotal"]>0)
    //{
        $percentage=($asset["askstotal"]/$asset["public"])*100;
        echo("<tr><td>Orderbook</td><td>");
        echo((number_format($asset["askstotal"],0,".",",")));
        echo("</td><td>" . (number_format($percentage,2,".",",")) . "%</td></tr>");
    //}
    ?>
    <tr>
        <td colspan="3">
  <div id="piechart" style=""></div>
          
        </td>
    </tr>
    </tbody>


</table>

</div><!--panel-primary orderbook-->










