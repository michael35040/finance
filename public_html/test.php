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
    //apologize(var_dump(get_defined_vars())); //dump all variables if i hit error

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

    //if (count($trades) < 1){apologize("Incorrect symbol!");} //check to see if exists in db



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
    ///////////
    //ORDERBOOK - POST ORDERS
    /////////
    //EXCHANGE ORDERS (COMBINED PRICE)
    $bidsGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='b' AND symbol=? GROUP BY `price` ORDER BY `price` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $asksGroup =	query("SELECT `price`, SUM(`quantity`) FROM `orderbook` WHERE side='a' AND symbol=? GROUP BY `price` ORDER BY `price` ASC LIMIT 0, 5", $symbol);	  // query user's portfolio
    $bidsTotal =	query("SELECT SUM(`quantity`) AS bidtotal FROM `orderbook` WHERE side='b' AND symbol=? ", $symbol);	  // query user's portfolio
    $asksTotal =	query("SELECT SUM(`quantity`) AS asktotal FROM `orderbook` WHERE side='a' AND symbol=? ", $symbol);	  // query user's portfolio
    $bidsTotal = $bidsTotal[0]['bidtotal'];
    $asksTotal = $asksTotal[0]['asktotal'];
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
    $trades =	    query("SELECT * FROM trades WHERE symbol = ? GROUP BY DAY(date) ORDER BY uid DESC ", $symbol);	  // query user's portfolio

?>
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



<?php
    require("../templates/footer.php");
} //if post
else{apologize("error unknown post");}
?>
