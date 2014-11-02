<?php

require("../includes/config.php");  // configuration
//require("../includes/finance.php"); //global finance constants
//$id = $_SESSION["id"]; //get id from session

//var_dump(get_defined_vars()); //dump all variables if i hit error
if ($_SERVER["REQUEST_METHOD"] != "POST")// if form is submitted
{
    //////////
//TOTAL AMOUNT OF BIDS/ASKS IN ORDERBOOK
////////
//EXCHANGE ORDERS (COMBINED PRICE)
    $bidsGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='b' GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5");	  // query user's portfolio
    $asksGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='a' GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5");	  // query user's portfolio

    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE side='b'");	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE side='a'");	  // query user's portfolio

    @$bidsT = $bidsTotal[0]['bidtotal'];
    @$asksT = $asksTotal[0]['asktotal'];
    if ($bidsT == 0){$bidsT = "No Orders";}
    if ($asksT == 0){$asksT = "No Orders";}


    render("test_form.php", [
        "title" => "Test",
        "bidsGroup" => $bidsGroup,
        "asksGroup" => $asksGroup,
        "asksTotal" => $asksT,
        "bidsTotal" => $bidsT
        //otherPage => localPage variable
    ]); // render buy form
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{

    require("../templates/header.php");

    $symbol =  $_POST["symbol"]; //local or national
    $type = $_POST["type"];	//assign post variables to local variables, not really needed but makes coding easier
    $number = $_POST["quantity"]; //quantity/volume/amount to trade

    //CHECKS //FORMATS AND SCRUBS VARIABLES
    if (empty($symbol) || empty($number) ||  empty($type)) { apologize("Please fill all required fields (Symbol, Quantity, Type)."); } //check to see if empty

    if (preg_match("/^\d+$/", $number) == false) { apologize("The number must enter a whole, positive integer."); } // if quantity is invalid (not a whole positive integer)
    //if (!ctype_alnum($symbol)) { apologize(var_dump(get_defined_vars()));} //if symbol is alpha (alnum for alphanumeric)
    if (!ctype_alnum($symbol)) { apologize("Symbol must be alpha-numeric!");} //if symbol is alpha (alnum for alphanumeric)
    if (!ctype_alpha($type)) { apologize("Type must be alpha-numeric!");} //if symbol is alpha (alnum for alphanumeric)
    if (!ctype_digit($number)) { apologize("Number must be numeric!");} //if quantity is numeric
    $symbol = strtoupper($symbol); //cast to UpperCase




    /////////
    //ORDERBOOK --PRE ORDERS
    /////////
    //EXCHANGE ORDERS (COMBINED PRICE)
    $bidsGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='b' AND symbol=? GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $asksGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='a' AND symbol=? GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE side='b' AND symbol=? ", $symbol);	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE side='a' AND symbol=? ", $symbol);	  // query user's portfolio
    $bidsTotal = $bidsTotal[0]['bidtotal'];
    $asksTotal = $asksTotal[0]['asktotal'];

    ////////
    //TRADES
    //////////EXCHANGE TRADES (PROCESSED ORDERS)
    $trades =	query("SELECT * FROM trades WHERE symbol = ? ORDER BY date DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    ?>
    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <!--/////////ORDERS - COMBINED//////-->
        <tr>
            <td colspan="2" bgcolor="#CCCCCC" style="color:black" size="+1" >
                <b>BIDS</b>
            </td>
        </tr>
        <tr>
            <td ><b>Qty</b></td>
            <td ><b>$</b></td>
        </tr>
        <tr>
            <th><?php echo($bidsTotal);?></th>
            <th>ALL</th>
        </tr>
        <tbody>
        <?php
        foreach ($bidsGroup as $order)
        {
            $quantity = $order["SUM(`quantity`)"];
            $price = $order["price"];
            echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
        }
        ?>
        </tbody>
    </table>

    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <tr>
            <td colspan="2" bgcolor="#CCCCCC" style="color:black" size="+1" >
                <b>ASKS</b>
            </td>
        </tr>
        <tr>
            <td ><b>$</b></td>
            <td ><b>Qty</b></td>
        </tr>

        <tr>
            <th>ALL</th>
            <th><?php echo($asksTotal);?></th>
        </tr>
        <tbody>
        <?php
        foreach ($asksGroup as $order)
        {
            $price = $order["price"];
            $quantity = $order["SUM(`quantity`)"];
            echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
        }
        ?>
        </tbody>

    </table>
    <?php
    //PLACING ORDERS
    $randomOrders = randomOrders($symbol, $number, $type);
    //market   limit
    //////////////////////////////////////////////////////////////////////////

    /////////
    //ORDERBOOK - POST ORDERS
    /////////
    //EXCHANGE ORDERS (COMBINED PRICE)
    $bidsGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='b' AND symbol=? GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $asksGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='a' AND symbol=? GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE side='b' AND symbol=? ", $symbol);	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE side='a' AND symbol=? ", $symbol);	  // query user's portfolio
    $bidsTotal = $bidsTotal[0]['bidtotal'];
    $asksTotal = $asksTotal[0]['asktotal'];

    ////////
    //TRADES
    //////////EXCHANGE TRADES (PROCESSED ORDERS)
    $trades =	query("SELECT * FROM trades WHERE symbol = ? ORDER BY date DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    ?>
    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <!--/////////ORDERS - COMBINED//////-->
        <tr>
            <td colspan="2" bgcolor="red" style="color:black" size="+1" >
                <b>BIDS</b>
            </td>
        </tr>
        <tr>
            <td ><b>Qty</b></td>
            <td ><b>$</b></td>
        </tr>
        <tr>
            <th><?php echo($bidsTotal);?></th>
            <th>ALL</th>
        </tr>
        <tbody>
        <?php
        foreach ($bidsGroup as $order)
        {
            $quantity = $order["SUM(`quantity`)"];
            $price = $order["price"];
            echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
        }
        ?>
        </tbody>
    </table>

    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <tr>
            <td colspan="2" bgcolor="red" style="color:black" size="+1" >
                <b>ASKS</b>
            </td>
        </tr>
        <tr>
            <td ><b>$</b></td>
            <td ><b>Qty</b></td>
        </tr>

        <tr>
            <th>ALL</th>
            <th><?php echo($asksTotal);?></th>
        </tr>
        <tbody>
        <?php
        foreach ($asksGroup as $order)
        {
            $price = $order["price"];
            $quantity = $order["SUM(`quantity`)"];
            echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
        }
        ?>
        </tbody>

    </table>


    <?php
    //PROCESSING ORDERS FOR TRADES
    $orderbook = orderbook($symbol);

    //////////////////////////////////////////////////////////////////////////
    /////////
    //ORDERBOOK -POST TRADES
    /////////
    //EXCHANGE ORDERS (COMBINED PRICE)
    $bidsGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='b' AND symbol=? GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $asksGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='a' AND symbol=? GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE side='b' AND symbol=? ", $symbol);	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE side='a' AND symbol=? ", $symbol);	  // query user's portfolio
    $bidsTotal = $bidsTotal[0]['bidtotal'];
    $asksTotal = $asksTotal[0]['asktotal'];

    ////////
    //TRADES
    //////////EXCHANGE TRADES (PROCESSED ORDERS)
    $trades =	query("SELECT * FROM trades WHERE symbol = ? ORDER BY date DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    ?>
    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <!--/////////ORDERS - COMBINED//////-->
        <tr>
            <td colspan="2" bgcolor="green" style="color:black" size="+1" >
                <b>BIDS</b>
            </td>
        </tr>
        <tr>
            <td ><b>Qty</b></td>
            <td ><b>$</b></td>
        </tr>
        <tr>
            <th><?php echo($bidsTotal);?></th>
            <th>ALL</th>
        </tr>
        <tbody>
        <?php
        foreach ($bidsGroup as $order)
        {
            $quantity = $order["SUM(`quantity`)"];
            $price = $order["price"];
            echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
        }
        ?>
        </tbody>
    </table>

    <table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
        <tr>
            <td colspan="2" bgcolor="green" style="color:black" size="+1" >
                <b>ASKS</b>
            </td>
        </tr>
        <tr>
            <td ><b>$</b></td>
            <td ><b>Qty</b></td>
        </tr>

        <tr>
            <th>ALL</th>
            <th><?php echo($asksTotal);?></th>
        </tr>
        <tbody>
        <?php
        foreach ($asksGroup as $order)
        {
            $price = $order["price"];
            $quantity = $order["SUM(`quantity`)"];
            echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
        }
        ?>
        </tbody>

    </table>
    <hr>OTHER INFORMATION<br>

    <?php
    $topAskPrice = $orderbook['topAskPrice'];
    $topAskUID = $orderbook['topAskUID']; //order id; unique id
    $topAskSymbol = $orderbook['topAskSymbol']; //symbol of equity
    $topAskSide = $orderbook['topAskSide']; //bid or ask
    $topAskDate = $orderbook['topAskDate'];
    $topAskType = $orderbook['topAskType']; //limit or market
    $topAskSize = $orderbook['topAskSize'];  //size or quantity of trade
    $topAskUser = $orderbook['topAskUser']; //user id



    $topBidPrice = $orderbook['topBidPrice'];
    $topBidUID = $orderbook['topBidUID']; //order id; unique id
    $topBidSymbol = $orderbook['topBidSymbol'];
    $topBidSide = $orderbook['topBidSide']; //bid or ask
    $topBidDate = $orderbook['topBidDate'];
    $topBidType = $orderbook['topBidType']; //limit or market
    $topBidSize = $orderbook['topBidSize'];
    $topBidUser = $orderbook['topBidUser'];

    $orderProcessed = $orderbook['orderProcessed'];
    $tradePrice = $orderbook['tradePrice'];
    $tradeType = $orderbook['tradeType'];

    //var_dump(get_defined_vars()); //dump all variables if i hit error

    /////////////////////////
    //TESTING
    /////////////////////////

    echo("<br>Orders Generated: " . $randomOrders); //number of random orders generated
    echo("<br>Orders Processed: " . $orderProcessed);
    echo("<br><br><b>TOP OF ORDERBOOK:</b>");
    echo("<br>Trade Price: " . number_format($tradePrice,2,".",","));
    echo("<br>Trade Type: " . $tradeType);

    echo("<br><br>Ask Price: " . number_format($topAskPrice,2,".",","));
    echo("<br>Ask UID: " . $topAskUID);
    echo("<br>Ask Symbol: " . $topAskSymbol);
    echo("<br>Ask Side: " . $topAskSide);
    echo("<br>Ask Date: " . $topAskDate);
    echo("<br>Ask Type: " . $topAskType);
    echo("<br>Ask Size: " . $topAskSize);
    echo("<br>Ask User: " . $topAskUser);

    echo("<br><br>Bid Price: " . number_format($topBidPrice,2,".",","));
    echo("<br>Bid UID: " . $topBidUID);
    echo("<br>Bid Symbol: " . $topBidSymbol);
    echo("<br>Bid Side: " . $topBidSide);
    echo("<br>Bid Date: " . $topBidDate);
    echo("<br>Bid Type: " . $topBidType);
    echo("<br>Bid Size: " . $topBidSize);
    echo("<br>Bid User: " . $topBidUser);









    //EXCHANGE TRADES (PROCESSED ORDERS)
    //$trades =       query("SELECT (SUM(quantity)/1000) AS quantity, price, date FROM trades WHERE symbol=? GROUP BY DAY(date) ORDER BY date ASC ", $symbol);
    $trades =	    query("SELECT * FROM trades WHERE symbol = ? GROUP BY DAY(date) ORDER BY uid DESC ", $symbol);	  // query user's portfolio
    //if (count($trades) < 1){apologize("Incorrect symbol!");} //check to see if exists in db
    $tradesGroup =  query("SELECT quantity, price, date FROM trades WHERE symbol=? ORDER BY uid DESC ", $symbol);

    //EXCHANGE ORDERS
    $bids =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price DESC, date ASC LIMIT 0, 5", $symbol, 'b');
    $asks =	query("SELECT * FROM orderbook WHERE (symbol = ? AND side = ? AND type = 'limit') ORDER BY price ASC, date ASC LIMIT 0, 5", $symbol, 'a');
    //EXCHANGE ORDERS (COMBINED PRICE)
    $asksGroupChart =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='a') GROUP BY `price` ORDER BY `price` ASC", $symbol);	  // query user's portfolio
    $bidsGroupChart =	query("SELECT price, SUM(`quantity`) AS quantity, date FROM `orderbook` WHERE (symbol = ? AND side ='b') GROUP BY `price` ORDER BY `price` ASC", $symbol);	  // query user's portfolio
    $bidsGroup =	    query("SELECT price, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (symbol = ? AND side ='b') GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 19", $symbol);	  // query user's portfolio
    $asksGroup =	    query("SELECT price, SUM(`quantity`) AS quantity FROM `orderbook` WHERE (symbol = ? AND side ='a') GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 19", $symbol);	  // query user's portfolio

    //$asksGroup = query("select concat(1*floor(price/1), '-', 1*floor(price/1) + 1) as `price`,     sum(`quantity`) as `quantity` from orderbook WHERE (symbol = ? AND side ='a') group by 1 order by `price`", $symbol);

    //TOTAL AMOUNT OF BIDS/ASKS IN ORDERBOOK
    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE (symbol = ? AND side ='b')", $symbol);	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE (symbol = ? AND side ='a')", $symbol);	  // query user's portfolio
    @$bidsTotal = $bidsTotal[0]['bidtotal'];
    @$asksTotal = $asksTotal[0]['asktotal'];
    if ($bidsTotal == 0){$bidsTotal = "No Orders";}
    if ($asksTotal == 0){$asksTotal = "No Orders";}


?>









    <head>
        <script type="text/javascript" src="../public_html/js/jsapi"></script>
        <!--script type="text/javascript" src="https://www.google.com/jsapi"></script-->
        <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart()
            {
                /////////////////
                //CHART 1
                //TRADES
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
                        $quantity = number_format(($trade["quantity"]), 2, '.', '');
                        //$quantity = (int)$trade["quantity"];
                        //$quantity = ($quantity/1000);

                        echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                    }//ex: ['2013',  1000, 400],
                    ?>
]);
var options =
{
title: '<?php echo($symbol); ?> Trades (Grouped)',
hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
vAxis: {title: 'Price', minValue: 0}
};
var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
chart.draw(data, options);
//////////////
//END CHART 1
////////////


//////////
//CHART 2
//TRADES GROUP
//////////
var data1 = google.visualization.arrayToDataTable([
<?php

echo("['Date', 'Price', 'Volume'],"); // ['Year', 'Sales', 'Expenses'],
//SQL QUERY FOR ALL TRADES

foreach ($trades as $trade)	// for each of user's stocks
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
title: '<?php echo($symbol); ?> Trades',
hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
vAxis: {title: 'Price', minValue: 0}
};
var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
chart1.draw(data1, options1);
//////////
//END CHART 2
////////////

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
title: '<?php echo($symbol); ?> Orderbook',
hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
vAxis: {title: 'Quantity', minValue: 0}
};
var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div2'));
chart2.draw(data2, options2);
//////////
//END CHART 2
////////////

}
</script>
</head>

<body>
<?php
//var_dump(get_defined_vars());

$lastTrade = number_format(($trades[0]["price"]), 2, '.', '');
$spotAsk = number_format(($asks[0]["price"]), 2, '.', '');
$spotBid = number_format(($bids[0]["price"]), 2, '.', '');
echo(   "       Bid: " . $spotBid .
        "<br><b>   Trade: " . $lastTrade .
        "</b><br>   Ask: " . $spotAsk
    );
?>
<!--div id="chart_div" style="width: 900px; height: 500px;"></div-->

<div id="chart_div" style="overflow:hidden;"></div>


<div id="chart_div1" style="overflow:hidden;"></div>







</body>

<style>
    /*
     table, th, td {
     border: 1px solid black;
     }
     */
</style>

<table class="table" align="center"> <!--class="bstable"-->

<!--/////////TRADES//////-->
<tr><td colspan="7"></td></tr> <!--blank row breaker-->
<tr>
<th colspan="7" bgcolor="black" style="color:white" size="+1" >
<?php echo($symbol); ?> TRADES
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

<tbody>
<?php
foreach ($trades as $trade)
{
    $tradeID = $trade["uid"];
    $tradeType = $trade["type"];
    $buyer = $trade["buyer"];
    $seller = $trade["seller"];
    $symbol = $trade["symbol"];
    $quantity = $trade["quantity"];
    $price = $trade["price"];
    $total = $trade["total"];
    $date = $trade["date"];
    echo("
        <tr>
        <td>" . number_format($tradeID,0,".",",") . "</td>
        <td>" . $buyer . "/" . $seller . "/" . strtoupper($tradeType) . "</td>
        <td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($date))) . "</td>
        <td>" . htmlspecialchars("$symbol") . "</td>
        <td>" . number_format($quantity,0,".",",") . "</td>
        <td>$" . number_format($price,2,".",",") . "</td>
        <td>$" . number_format($total,2,".",",") . "</td>



        </tr>");
}
?>
</tbody>
<tr><td colspan="7" bgcolor="black"></td></tr> <!--blank row breaker-->
<tr><td colspan="7" ></td></tr> <!--blank row breaker-->
</table>














<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center"><tr>
<td>


<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">

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

<tbody>
<?php
foreach ($bidsGroup as $order)
{
    $quantity = $order["quantity"];
    $price = $order["price"];
    echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
}
?>

<tr>
<td><?php echo($bidsTotal);?></td>
<td>ALL</td>
</tr>

</tbody>
</table>




</td>
<td>

<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
<tr rowspan="6">
<td>
<!--div id="chart_div2" style="overflow:hidden;"></div-->
<div id="chart_div2" style="width: 900px; height: 500px;">
</td>
</tr>

</table>

</td>
<td>



<table class="bstable" cellspacing="0" cellpadding="0"  border="1" style="display: inline-table; text-align:center">
<tr>
<td colspan="2" bgcolor="red" style="color:white" size="+1" >
<b>ASKS</b>
</td>
</tr>
<tr>
<td ><b>$</b></td>
<td ><b>Qty</b></td>
</tr>


<tbody>
<?php
foreach ($asksGroup as $order)
{
    $price = $order["price"];
    $quantity = $order["quantity"];
    echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
}
?>

<tr>
<td>ALL</td>
<td><?php echo($asksTotal);?></td>
</tr>

</tbody>

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

<tbody>
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
</tbody>
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

<tbody>
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
</tbody>
</table>





<?php

    //render("test_form.php", ["title" => "Success", "transaction" => $transaction, "symbol" => $symbol, "value" => $tradeTotal, "quantity" => $quantity, "commissiontotal" => $commissionTotal]); // render success form


    // render footer
    require("../templates/footer.php");

} //if post
else{apologize("error unknown post");}
//var_dump(get_defined_vars()); //dump all variables if i hit error
?>