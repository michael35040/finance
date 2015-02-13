<style>
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
        background-color: #f5f5f5; /*ffd700 gray #f5f5f5*/
    }

    .hiddenRow {
        padding: 0 !important;
    }

    .accordian-body td
    {
        background-color: #eeeeee;
    }

    .nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
    #middle
    {
        background-color:transparent;
        border:0;
    }
    .symbolForm {
        display: inline-block;
        text-align:center;
        width:25%;
    }
    .panel-success .panel-heading
    {
        /*color: #3c763d;*/
    }
    *
    {
        /*for sparkline box*/
        box-sizing: initial;
        /*box-sizing: content-box;*/

    }

</style>
<?php //need To ensure the vars sugh as bids group arefed. ?>
<head>

<!--FOR SPARKLINES-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/sparkline.js"></script>
<script type="text/javascript">
    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */
        $('.inlinesparkline').sparkline();
        $('.sparklines').sparkline('html', { enableTagOptions: true });
    });
</script>
<!--END SPARKLINES-->


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
    //TRADES GROUP PRICE
    ////////////////
    var data1 = google.visualization.arrayToDataTable([
        <?php

        echo("['Date', 'Price'],"); // ['Year', 'Sales', 'Expenses'],
        //SQL QUERY FOR ALL TRADES
        $tradesGroupR = array_reverse($tradesGroup); //so it will be in correct ASC order for chart
        foreach ($tradesGroupR as $trade)	// for each of user's stocks
        {
            $dbDate = $trade["date"];
            $date = strtotime($dbDate);
            $price = number_format(getPrice($trade["price"]), $decimalplaces, '.', '');
            //$volume = number_format(($trade["volume"]), $decimalplaces, '.', '')/1000;

            //echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $volume . "],");
            echo("['" . date("m/d", $date) . "', " . $price .  "],");
        }//ex: ['2013',  1000, 400],
        ?>
    ]);
    var options1 =
    {
        title: '<?php echo($symbol); ?> - PRICE',
        legend:'none',
        // hAxis: {title: '',  titleTextStyle: {color: '#333'}},
        // vAxis: {title: '', minValue: 0},
        //colors:['green','gray']
        colors:['green']
        //height: 500,

    };
    var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
    chart1.draw(data1, options1);
    //////////////
    //END CHART 1
    ////////////




    /////////////////
    //CHART 2
    //TRADES GROUP VOLUME
    ////////////////
    var data2 = google.visualization.arrayToDataTable([
        <?php

        echo("['Date', 'Volume'],"); // ['Year', 'Sales', 'Expenses'],
        //SQL QUERY FOR ALL TRADES
        $tradesGroupR = array_reverse($tradesGroup); //so it will be in correct ASC order for chart
        foreach ($tradesGroupR as $trade)	// for each of user's stocks
        {
            $dbDate = $trade["date"];
            $date = strtotime($dbDate);
            //$price = number_format(getPrice($trade["price"]), $decimalplaces, '.', '');
            $volume = number_format(($trade["volume"]), $decimalplaces, '.', '');

            //echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $volume . "],");
            echo("['" . date("m/d", $date) . "', " . $volume .  "],");
        }//ex: ['2013',  1000, 400],
        ?>
    ]);
    var options2 =
    {
        title: '<?php echo($symbol); ?> - VOLUME',
        legend:'none',
        // hAxis: {title: '',  titleTextStyle: {color: '#333'}},
        // vAxis: {title: '', minValue: 0},
        vAxis: {title: '', minValue: 0, isStacked: true},
        //colors:['green','gray']
        colors:['gray']
        //height: 500,

    };
    var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
    chart2.draw(data2, options2);
    //////////////
    //END CHART 2
    ////////////






    //////////
    //CHART 3 ALL PRICE & VOLUME
    //////////

    var data3 = google.visualization.arrayToDataTable([
        <?php

        echo("['Date', 'Price', 'Quantity'],"); // ['Year', 'Sales', 'Expenses'],
        //SQL QUERY FOR ALL TRADES
        $tradesChart = array_reverse($trades); //so it will be in correct ASC order for chart
        foreach ($tradesChart as $trade)	// for each of user's stocks
        {
            $dbDate = $trade["date"];
            $date = strtotime($dbDate);
            $price = number_format(getPrice($trade["price"]), $decimalplaces, '.', '');
            $quantity = number_format(($trade["quantity"]), 0, '.', '');

            echo("['" . date("m/d", $date) . "', " . $price . ", " . $quantity . "],");

        }//ex: ['2013',  1000, 400],

        ?>
    ]);
    var options3 =
    {
        title: '<?php  echo($symbol); ?> - LAST 100',
        hAxis: {title: '', textPosition: 'none',  titleTextStyle: {color: '#333'}},
        vAxis: {title: '', minValue: 0},
        colors:['green','gray'],
        legend: {position: 'none', textStyle: {color: 'blue', fontSize: 16}}
        //height: 500,

    };
    var chart3 = new google.visualization.AreaChart(document.getElementById('chart_div3'));
    chart3.draw(data3, options3);


    //////////
    //END CHART 3 ALL PRICE & VOLUME
    ////////////


    <?php }   //tradesgroup != null ?>






    <?php
    if($bidsGroup != null)
    {
     ?>
    //////////
    //CHART 5
    //ORDERBOOK
    //////////
    var data5 = google.visualization.arrayToDataTable([
        <?php

        echo("['Date', 'Bids', 'Asks'],"); // ['Year', 'Sales', 'Expenses'],
        //SQL QUERY FOR ALL TRADES

        $bidsGroupChart = array_reverse($bidsGroup); //so it will be in correct ASC order for chart
        foreach ($bidsGroupChart as $order)	// for each of user's stocks
        {
            $date = 0;
            $price = number_format(getPrice($order["price"]), $decimalplaces, '.', '');
            $quantity = number_format(($order["quantity"]), 0, '.', '');
            echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
        }

        foreach ($asksGroup as $order)	// for each of user's stocks
        {
            $date = 0;
            $price = number_format(getPrice($order["price"]), $decimalplaces, '.', '');
            $quantity = number_format(($order["quantity"]), 0, '.', '');
            echo("['" . $price . "', " . $date .  ", " . $quantity . "],");
        }




        ?>
    ]);
    var options5 =
    {
        title: '<?php echo($symbol); ?> - TOP OF ORDER BOOK',
        legend: {position: 'none', textStyle: {color: 'blue', fontSize: 16}},
        hAxis: {title: 'Price', titleTextStyle: {color: '#333'}},
        vAxis: {title: '', minValue: 0, isStacked: true}
        // height: 500,

    };
    var chart5 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div5'));

    chart5.draw(data5, options5);
    //////////
    //END CHART 5
    ////////////
    <?php }   //$bidsGroupChart != null ?>



    /////////////////
    //CHART PIE 6A
    //OWNERSHIP
    ////////////////

    var data6A = google.visualization.arrayToDataTable([
        ['User', 'Quantity'],
        <?php
        $owned=0;
        foreach ($ownership2 as $owner)
        {
            /*
            echo("<td>" . $owner['id'] . "</td>");
            echo("<td>" . $owner['orderbook'] . "</td>");
            echo("<td>" . $owner['portfolio'] . "</td>");
            echo("<td>" . $owner['total'] . "</td>");
            */
            if($owner['total']>0)
            {
             echo("['User: " . $owner['id'] . "', " . number_format($owner['total'], 0, '.', '') . "],");
            }
        }
      //   ['Work',     11],
      //   ['Sleep',    7]
         ?>
    ]);




    var options6A = {
        title: 'Ownership',
        //is3D: true,
        //legend: 'none',
        //pieSliceText: 'percentage' //'label', 'percentage', 'value', 'none'
        //width: 400,

        height: 500
        //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],

    };

    var chart6A = new google.visualization.PieChart(document.getElementById('chart_div6A'));

    chart6A.draw(data6A, options6A);



    /////////////////
    //END CHART PIE 6A
    ////////////////















    //////////
    //CHART 7
    //ORDERBOOK 7 MARKET DEPTH
    //////////
    var data7 = google.visualization.arrayToDataTable([
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
            $price = number_format(getPrice($order["price"]), $decimalplaces, '.', '');
            $quantity =  number_format(($order["quantity"]), 0, '.', '');
            echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
        }

        $aquantity=0;
        foreach ($asksGroupAll as $order)	// for each of user's stocks
        {
            $date = 0;
            $price = number_format(getPrice($order["price"]), $decimalplaces, '.', '');
            $aquantity2 = $order["quantity"];
            $aquantity = ($aquantity + $aquantity2);
            $aquantity =  number_format(($aquantity), 0, '.', '');
            echo("['" . $price . "', " . $date .  ", " . $aquantity . "],");
        }

        ?>
    ]);
    var options7 =
    {
        title: '<?php echo($symbol); ?> - MARKET DEPTH',
        legend: {position: 'none', textStyle: {color: 'blue', fontSize: 16}},

        hAxis: {
            title: '',
            textPosition: 'none',
            titleTextStyle: {color: '#333'}},
        vAxis: {
            title: '',
            minValue: 0,
            isStacked: true}
        // height: 500,

    };
    var chart7 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div7'));

    chart7.draw(data7, options7);
    //////////
    //END CHART 3A V2
    ////////////






















//echo(var_dump(get_defined_vars()));
}
</script>
</head>





    <!--<div class="panel panel-success">--> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <!--<div class="panel-heading" style="font-size:20px; text-align: center;padding:5px;color: black;">INFORMATION</div>-->
    <table class="table">
        <thead>
        <tr  class="success">
            <td colspan="3" style="font-size:20px; text-align: center;">INFORMATION</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3">
                <?php echo(htmlspecialchars($asset["name"])) ?> (<?php echo(htmlspecialchars($asset["symbol"])) ?>)<br>
                <?php echo(htmlspecialchars($asset["url"])) ?><br>
                Market Capitalization: <?php echo($unitsymbol . number_format($asset["marketcap"], $decimalplaces, ".", ",")) ?><br>

                <?php //NO htmlspecialchars IN ORDER TO DISPLAY CURRENCY SIGN ?>
                Description: <?php echo(ucfirst($asset["description"])) ?>
            </td>
        </tr>
        <tr >
            <td >
                <?php echo($unitsymbol . number_format($asset["price"], $decimalplaces, ".", ",")) ?> - Last<br>
                <?php echo($unitsymbol . number_format($bidsPrice, $decimalplaces, ".", ",")) ?> - Bid<br>
                <?php echo($unitsymbol . number_format($asksPrice, $decimalplaces, ".", ",")) ?> - Ask<br>
                <?php echo($unitsymbol . number_format($asset["avgprice"], $decimalplaces, ".", ",")) ?> - Avg. (<?php echo($timeframe);?>)
            </td>
            <td >
                <?php echo(number_format($asset["volume"], 0, ".", ",")) ?> - Volume (<?php echo($timeframe);?>)<br>
                <?php echo(number_format($asset["public"], 0, ".", ",")) ?> - Publicly Held<br>
                <?php echo(number_format($asset["issued"], 0, ".", ",")) ?> - Issued (<?php echo(number_format($asset["userid"], 0, ".", ",")) ?>)<br>
                <?php echo(htmlspecialchars($asset["date"])) ?> - Listed
            </td>
            <td >
                Type: <?php echo(htmlspecialchars(ucfirst($asset["type"]))) ?><br>
                <?php 
                if($asset["type"]=="stock"){echo('
                Rating: ' . htmlspecialchars($asset["rating"]) . ' <br>
                Dividend: ' . number_format($asset["dividend"], $decimalplaces, ".", ",")
                ); } 
                ?>
            </td>
        </tr>

        </tbody>
    </table>
    <!--</div>--><!--panel-primary-->


























<div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">YOUR ACCOUNT</div>
    <table class="table" style="text-align:center;">

        <thead>
        <tr class="active">
            <td>Available</td>
            <td>Orderbook</td>
            <td>Total</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo(number_format($asset["userportfolio"], 0, ".", ",")); ?></td>


            <td><span class='nobutton'><form method='post' action='orders.php'><button type='submit' name='symbol' value='<?php echo($asset['symbol']); ?>'><?php echo(number_format($asset["userlocked"], 0, ".", ",")); ?></button></form></span></td>
            <?php /* <td><?php echo(number_format($asset["userlocked"], 0, ".", ",")); ?></td> */ ?>


            <td><?php echo(number_format(($asset["userlocked"]+$asset["userportfolio"]), 0, ".", ",")); ?> (<?php echo(number_format($asset["control"], 4, ".","")); ?>%)</td>
        </tr>




        <tr class="active">
            <td>Purchase</td>
            <td>Loss/Gain</td>
            <td>Market Value</td>
        </tr>
        <tr>
            <td><?php echo($unitsymbol . number_format($asset["purchaseprice"], $decimalplaces, ".", ",")); ?></td>
            <td>

                <?php
                $marketValue = (($asset["userlocked"]+$asset["userportfolio"])*$asset["price"]);
                $pricechange = ($marketValue-$asset["purchaseprice"]);
                if ($asset["purchaseprice"] > 0) {
                    $percentchange = 100 * (($marketValue / $asset["purchaseprice"]) - 1); // total/purchase
                } else {
                    $percentchange = 0;
                }

                //ARROWS START
                if ($asset["purchaseprice"] < $marketValue) {
                    echo("<font color='#00FF00'>&#x25B2;</font>");
                } //money is up
                elseif ($asset["purchaseprice"] > $marketValue) {
                    echo("<font color='#FF0000'>&#x25BC;</font>");
                }  //money is down
                else {
                    echo("&#x25C4;");  //eft:[&#x25C4;]   right: [&#x25BA;]
                } //even left and right arrow
                //ARROWS END
                ?>

                <?php echo($unitsymbol . number_format($pricechange, $decimalplaces, ".", ",")); ?>
            </td>
            <td><?php echo($unitsymbol . number_format($marketValue, $decimalplaces, ".", ",")); ?></td>
        </tr>

        </tbody>
    </table>
</div><!--panel-primary your account-->








<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <form method="post" action="information-trades.php"><span class="nobutton"><button type="submit" name="symbol" value="<?php echo($asset["symbol"]); ?>">TRADES</button></span></form>
    </div>

    <table class="table">
        <tr>
            <td>
                <div class="panel panel-success"> <!--success info primary danger warning -->
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="text-align:center;">DAILY TRADES</div>



                    <?php
                    if(!empty($tradesGroup))
                    {
                        $tradesCount=count($tradesGroup);
                        ?>

                        <table class="table" style="text-align:center;">
                            <tr><td colspan="3"><div id="chart_div1" style="overflow:hidden;"></div></td></tr><!--TGP-->
                            <tr><td colspan="3"><div id="chart_div2" style="overflow:hidden;"></div></td></tr><!--TGV-->

                            <tr class="active">
                                <td>Date</td>
                                <td>Avg. Price
                                    <span class="sparklines" sparkType="line"><?php $t=0; foreach($tradesGroupR as $trade){echo(number_format(getPrice($trade["price"]), $decimalplaces, ".", "")); $t++; if($t<$tradesCount){echo(",");} } ?></span>
                                </td>
                                <td>Volume
                                    <span class="sparklines" sparkType="bar" sparkBarColor="blue"><?php  $t=0; foreach($tradesGroupR as $trade){echo(number_format(($trade["volume"]), 0, ".", "")); $t++; if($t<$tradesCount){echo(",");}}?></span>
                                </td>
                            </tr>

                            <?php
                            foreach($tradesGroup as $trade)
                            {
                                ?>
                            <tr>
                                <td><?php echo(date("m/d", strtotime($trade["date"]))); ?></td>
                                <td><?php echo($unitsymbol . number_format(getPrice($trade["price"]), $decimalplaces, ".", ",")); ?></td>
                                <td><?php echo(number_format(($trade["volume"]), 0, ".", ",")); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    <?php } /*tradesgroup*/?>



                </div> <!-- <div class="panel-heading">DAILY TRADES</div>-->
            </td>
        </tr>
        <tr>
            <td>
                <div class="panel panel-success"> <!--success info primary danger warning -->
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="text-align:center;">LAST TRADES</div>


                    <?php
                    if(empty($trades)){ ?>
                        <table class="table">
                            <tr><td>No Trades</td></tr>
                        </table>
                    <?php } /* trades==null */

                    if(!empty($trades))
                    { ?>
                        <table class="table" style="text-align:center;">

                            <tr><td colspan="4"><div id="chart_div3" style="overflow:hidden;"></div></td></tr>

                            <tr class='active'>
                                <td>Date</td>
                                <td>Buyer-Bid/Seller-Ask/Type</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <!-- <td>Trade #</td> -->
                                <!-- <td>Total</td> -->
                            </tr>
                            <?php
                            $i=0;
                            foreach ($trades as $trade) {
                                $i++;
                                //htmlspecialchars($trade["symbol"]);
                            ?>

                            <tr>
                            <td><?php echo(htmlspecialchars(date('m/d H:i', strtotime($trade["date"])))); ?></td>
                            <td><?php echo($trade["buyer"] . '-' . $trade["bidorderuid"] . '/' . $trade["seller"] . '-' . $trade["askorderuid"] . '/' . strtoupper($trade["type"])); ?></td>
                            <td><?php echo($unitsymbol . number_format(getPrice($trade["price"]), $decimalplaces, ".", ",")); ?></td>
                            <td><?php echo(number_format($trade["quantity"], 0, ".", ",")); ?></td>
                            <!-- <td><?php // echo($unitsymbol . number_format(getPrice($trade["total"]), $decimalplaces, ".", ",")); ?></td> -->
                            <!-- <td> <?php // echo(number_format($trade["uid"], 0, ".", "")); ?></td> -->
                            </tr>
                                        <?php
                                            if($i==5){break;}
                                        } //foreach
                                        ?>
                        </table>
                    <?php } /*trades != null*/
                    ?>

                </div> <!--<div class="panel-heading">LAST TRADES</div>-->
            </td>
        </tr>
    </table>

</div><!--panel-primary trades-->






















<div class="panel panel-primary">
<!-- Default panel contents -->
<div class="panel-heading">
    <form method="post" action="information-orderbook.php"><span class="nobutton"><button type="submit" name="symbol" value="<?php echo($asset["symbol"]); ?>">ORDER BOOK</button></span></form>
</div>
<table class="table">
<?php
if(!empty($asks) || !empty($bids)){
    ?>






    <tr>
        <td colspan="2">
                <div class="panel panel-success"> <!--success info primary danger warning -->
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="text-align:center;">MARKET DEPTH</div>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div id="chart_div7" style="overflow:hidden;"></div><!--MD OB-->
                                <div id="chart_div5"></div>  <!--OB-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!--panel-primary orderbook-->
        </td>
    </tr>



    <tr>
        <td style="width:50%">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading" style="text-align:center;">BIDS</div>
                <table class="table" style="display: inline-table;text-align:center;">
                    <tr class="active">
                        <td ><b>Quantity</b></td>
                        <td ><b>Price</b></td>
                    </tr>

                    <?php
                    foreach ($bidsGroup as $order)
                    {
                        $quantity = $order["quantity"];
                        $price = getPrice($order["price"]);
                        echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,$decimalplaces,".",",") . "</td></tr>");
                    }
                    ?>

                    <tr class="active">
                        <td><b><?php echo(number_format($asset["bidstotal"],0,".",","));?></b></td>
                        <td><b>ALL</b></td>
                    </tr>

                </table>
            </div><!--panel bids-->




        </td>

        <td style="width:50%">

            <div class="panel panel-danger">
                <!-- Default panel contents -->
                <div class="panel-heading" style="text-align:center;">ASKS</div>

                <table class="table" style="display: inline-table;text-align:center;">
                    <tr class="active">
                        <td ><b>Price</b></td>
                        <td ><b>Quantity</b></td>
                    </tr>



                    <?php
                    foreach ($asksGroup as $order)
                    {
                        $price = getPrice($order["price"]);
                        $quantity = $order["quantity"];
                        echo("<tr ><td >" . number_format($price,$decimalplaces,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
                    }
                    ?>

                    <tr class="active">
                        <td><b>ALL</b></td>
                        <td><b><?php echo(number_format($asset["askstotal"],0,".",","));?></b></td>
                    </tr>



                </table>
            </div><!--panel danger asks-->
        </td>
    </tr><!--orderbook chart row-->

    <tr><!--bids-->
        <td colspan="2">


            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading" style="text-align:center;">TOP BIDS</div>
                <table class="table" style="text-align:center;">
                    <tr class="active">
                        <td>Order #</td>
                        <!--td>Side</td-->
                        <td>Date</td>
                        <!--td>Symbol</td-->
                        <!--td>Type</td-->
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    <?php
                    foreach ($bids as $row)
                    {
                        //if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
                        echo("<tr>");
                        echo("<td>" . (number_format($row["uid"],0,".","")) . "</td>");
                        //echo("<td>" . htmlspecialchars($side) . "</td>");
                        echo("<td>" . htmlspecialchars(date('m/d H:i',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
                        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
                        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
                        echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
                        echo("</tr>");
                    }
                    ?>
                </table>
            </div><!--panel order bids-->


        </td>
    </tr><!--orderbook bids row-->
    <tr><!--orderbook asks row-->
        <td colspan="2">

            <div class="panel panel-danger">
                <!-- Default panel contents -->
                <div class="panel-heading" style="text-align:center;">TOP ASKS</div>
                <table class="table" style="text-align:center;">
                    <tr class="active">
                        <td>Order #</td>
                        <!--td>Side</td-->
                        <td>Date</td>
                        <!--td>Symbol</td-->
                        <!--td>Type</td-->
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    <?php
                    foreach ($asks as $row)
                    {
                        //if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
                        echo("<tr>");
                        echo("<td>" . (number_format($row["uid"],0,".","")) . "</td>");
                        //echo("<td>" . htmlspecialchars($side) . "</td>");
                        echo("<td>" . htmlspecialchars(date('m/d H:i',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
                        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
                        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
                        echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
                        echo("</tr>");
                    }
                    ?>
                </table>
            </div><!--panel order asks-->

        </td>
    </tr><!--orderbook asks row-->
    <tr><!--orderbook lastorders row-->
        <td colspan="2">

            <div class="panel panel-warning">
                <!-- Default panel contents -->
                <div class="panel-heading" style="text-align:center;">LAST ORDERS</div>
                <table class="table" style="text-align:center;">
                    <tr class="active">
                        <td>Order #</td>
                        <!--td>Side</td-->
                        <td>Date</td>
                        <!--td>Symbol</td-->
                        <!--td>Type</td-->
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    <?php
                    foreach ($lastorders  as $row)
                    {
                        if($row["side"]=='b'){$side='Bid';} elseif($row["side"]=='a'){$side='Ask ';} else{$side='';}
                        echo("<tr>");
                        echo("<td>" . (number_format($row["uid"],0,".","")) . " (" . htmlspecialchars($side) . ")</td>");
                        //echo("<td>" . htmlspecialchars($side) . "</td>");
                        echo("<td>" . htmlspecialchars(date('m/d H:i',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
                        //echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
                        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
                        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
                        echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
                        echo("</tr>");
                    }
                    ?>
                </table>
            </div><!--panel order last orders-->

        </td>
    </tr><!--orderbook last orders row-->



<?php } /* $lastorders != null */
//if(empty($asks) && empty($bids))
else{ ?>
    <tr><td>No orders</td></tr>
<?php }


?>
</table><!--orderbook table-->
</div><!--panel-primary orderbook-->
























<div class="panel panel-primary" style="text-align:center;">
    <!-- Default panel contents -->
    <div class="panel-heading">ACTIVITY</div>
    <table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:center;vertical-align:middle;">

        <tr class="active">
            <td>PERIOD</td><td>ORDERS</td><td>TRADES</td><td>VOLUME</td><td>VALUE</td>
        </tr>

        <tr>
            <td>00-24h</td>
            <td><?php echo(number_format($dash["ordersday1"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday1"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday1"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday1"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>24-48h</td>
            <td><?php echo(number_format($dash["ordersday2"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday2"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday2"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday2"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>48-72h</td>
            <td><?php echo(number_format($dash["ordersday3"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday3"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday3"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday3"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>72-96h</td>
            <td><?php echo(number_format($dash["ordersday4"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday4"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday4"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday4"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>96-120h</td>
            <td><?php echo(number_format($dash["ordersday5"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday5"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday5"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday5"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>120-144h</td>
            <td><?php echo(number_format($dash["ordersday6"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday6"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday6"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday6"]), $decimalplaces, '.', ',')); ?></td>
        </tr>
        <tr>
            <td>144-168h</td>
            <td><?php echo(number_format($dash["ordersday7"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesday7"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeday7"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueday7"]), $decimalplaces, '.', ',')); ?></td>
        </tr>

        <tr class="active">
            <td>Last 7d</td>
            <td><?php echo(number_format($dash["ordersweek"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesweek"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumeweek"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valueweek"]), $decimalplaces, '.', ',')); ?></td>

        </tr>
        <tr class="active">
            <td>Last 30d</td>
            <td><?php echo(number_format($dash["ordersmonth"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradesmonth"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumemonth"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valuemonth"]), $decimalplaces, '.', ',')); ?></td>

        </tr>
        <tr class="active">
            <td>Total</td>
            <td><?php echo(number_format($dash["orderstotal"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["tradestotal"], 0, '.', ',')); ?></td>
            <td><?php echo(number_format($dash["volumetotal"], 0, '.', ',')); ?></td>
            <td><?php echo($unitsymbol . number_format(($dash["valuetotal"]), $decimalplaces, '.', ',')); ?></td>

        </tr>
    </table>
</div><!--panel-primary ACTIVITY-->

























<div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">OWNERSHIP - MAJOR HOLDERS</div>
    <table class="table" style="text-align:center;">
        <thead>
        <tr class="active">
            <td><strong>User</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Control</strong></td>
        </tr>
        </thead>
        <tbody>


        <?php
        $i=0; $listedOwned=0;
        foreach ($ownership2 as $row)
        {   $i++;
            $percentage=($row["total"]/$asset["public"])*100;
            echo("<tr>");
            echo("<td>" . (number_format($row["id"],0,".",",")) . "</td>");
            echo("<td>" . (number_format($row["total"],0,".",",")) . "</td>");
            echo("<td>" . (number_format($percentage,2,".",",")) . "%</td>");
            echo("</tr>");
            $listedOwned = $listedOwned+$row["total"];
            if($i==5){break;}
        }
        
        $unlisted=$asset["public"]-$listedOwned;
        $percentage=($unlisted/$asset["public"])*100;
        echo("<tr><td>Remaining</td><td>");
        echo((number_format($unlisted,0,".",",")));
        echo("</td><td>" . (number_format($percentage,2,".",",")) . "%</td></tr>");

        
        $totallisted=$asset["public"]/$asset["public"];
        $percentage=($asset["public"]/$asset["public"])*100;
        echo("<tr class='active'><td><strong>Total</strong></td><td><strong>");
        echo((number_format($asset["public"],0,".",",")));
        echo("</strong></td><td><strong>" . (number_format($percentage,2,".",",")) . "%</strong></td></tr>");


        //if($asset["askstotal"]>0)
        //{
        $percentage=($asset["askstotal"]/$asset["public"])*100;
        echo("<tr class='active'><td>On Orderbook</td><td>");
        echo((number_format($asset["askstotal"],0,".",",")));
        echo("</td><td>" . (number_format($percentage,2,".",",")) . "%</td></tr>");
        //}
        ?>
        <tr>
            <td colspan="3">
                <table>
                <tr>
                        <div id="chart_div6A" style=""></div>
            </td>
        </tr>
        </tbody>


    </table>

</div><!--panel-primary orderbook-->











