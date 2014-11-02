
<table class="table" > <!--class="bstable"-->

    <tr bgcolor="#CCCCCC"><td colspan="7"><font color="black" size="+1">HISTORY</font></td></tr> <!--blank row breaker-->
    <tr >

            <th>Transaction #</th>
            <th>Transaction</th>
            <th>Date/Time (Y/M/D)</th>
            <th>Symbol/Asset</th>
            <th>Quantity/Counterparty ID</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

    <?php
	    foreach ($history as $row)
        {   
            echo("<tr>");
            echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
            echo("<td>" . htmlspecialchars($row["transaction"]) . "</td>");			
            echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
            echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
            echo("<td>" . htmlspecialchars($row["quantity"]) . "</td>");
            echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["price"],2,".",",")) . "</td>");
            echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["total"],2,".",",")) . "</td>");
            echo("</tr>");
        }
    ?>
        <tr >
            <td colspan="1"></td>
            <td colspan="2"><strong><i>*Figure does not include assets currently held.</i></strong></td>
            <td colspan="2"><strong>Sum of Listed Transactions</strong></td>
            <td><?php
                    //calculate gains/losses
                    $acc = array_shift($history);
                    foreach ($history as $val) {
                        foreach ($val as $key => $val) {
                        $acc[$key] += $val;
                        }
                    }
                    $gainlosses = $acc['price'];
                    echo("<strong>" . $unitsymbol . htmlspecialchars(number_format($gainlosses,2,".",",")) . "</strong>");
                ?></td>
        </tr>

    <!--/////////TRADES//////-->

    <tr bgcolor="#CCCCCC"><td colspan="7"><font color="black" size="+1">TRADES</font></td></tr> <!--blank row breaker-->
    <tr >
        <td ><b><u>Buyer</u></b></td>
        <td ><b><u>Seller</u></b></td>
        <td ><b><u>Symbol</u></b></td>
        <td ><b><u>Quantity</u></b></td>
        <td ><b><u>Price</u></b></td>
        <td ><b><u>Total</u></b></td>
        <td ><b><u>Date</u></b></td>
    </tr>
    <?php
    foreach ($trades as $trade)
    {

        $buyer = $trade["buyer"];
        $seller = $trade["seller"];
        $symbol = $trade["symbol"];
        $quantity = $trade["quantity"];
        $price = $trade["price"];
        $total = $trade["total"];
        $date = $trade["date"];
        echo("
                <tr>
                <td>" . number_format($buyer,0,".",",") . "</td>
                <td>" . number_format($seller,0,".",",") . "</td>
                <td>" . htmlspecialchars("$symbol") . "</td>
                <td>" . number_format($quantity,0,".",",") . "</td>
                <td>" . number_format($price,2,".",",") . "</td>
                <td>" . number_format($total,2,".",",") . "</td>
                <td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($date))) . "</td>
                </tr>");
    }
    ?>

</table>



<?php 
//	Display link to all history as long as your not already there
if (isset($title)) 
{
if ($title !== "History All")
{
	echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-primary" formmethod="post" formaction="history.php" name="history" value="all">
        <span class="glyphicon glyphicon-calendar"></span>
        &nbsp;  ALL HISTORY
    </button>
</span>
</form>
	');
}
else
{ 
	echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-primary" formmethod="post" formaction="history.php" name="history" value="limit">
        <span class="glyphicon glyphicon-calendar"></span>
        &nbsp; HISTORY
    </button>
</span>
</form>
	');
}
}
//var_dump(get_defined_vars());
//&middot; 
?>
 <br />  <br />

