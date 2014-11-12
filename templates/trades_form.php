
<table class="table table-condensed  table-bordered" >

    <tr   class="success" ><td colspan="10"  style="font-size:20px; text-align: center;"><?php echo(strtoupper($title)); ?> &nbsp;
            <?php
            //	Display link to all history as long as your not already there
            if (isset($title))
            {
                if ($title !== "All Trades")
                {
                    echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="trades.php" name="trades" value="all">
        <span class="glyphicon glyphicon-calendar"></span> ALL
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
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="trades.php" name="trades" value="limit">
        <span class="glyphicon glyphicon-calendar"></span> LAST 10
    </button>
</span>
</form>
	');
                }
            }

            ?>



        </td></tr> <!--blank row breaker-->
    <tr   class="active" >
        <td ><b><u>Buyer</u></b></td>
        <td ><b><u>Bid Order#</u></b></td>
        <td ><b><u>Seller</u></b></td>
        <td ><b><u>Ask Order#</u></b></td>
        <td ><b><u>Date</u></b></td>
        <td ><b><u>Type</u></b></td>
        <td ><b><u>Symbol</u></b></td>
        <td ><b><u>Quantity</u></b></td>
        <td ><b><u>Price</u></b></td>
        <td ><b><u>Total</u></b></td>
    </tr>
    <?php
    foreach ($trades as $trade)
    {

        $buyer = $trade["buyer"];
        $bidorderuid = $trade["bidorderuid"];
        $seller = $trade["seller"];
        $askorderuid = $trade["askorderuid"];
        $date = $trade["date"];
        $type = $trade["type"];
        $symbol = $trade["symbol"];
        $quantity = $trade["quantity"];
        $price = $trade["price"];
        $total = $trade["total"];
        echo("

                <tr>
                <td>" . number_format($buyer,0,".",",") . "</td>
                <td>" . number_format($bidorderuid,0,".","") . "</td>
                <td>" . number_format($seller,0,".",",") . "</td>
                <td>" . number_format($askorderuid,0,".","") . "</td>
                <td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($date))) . "</td>
                <td>" . strtoupper(htmlspecialchars("$type")) . "</td>
                <td>" . htmlspecialchars("$symbol") . "</td>
                <td>" . number_format($quantity,0,".",",") . "</td>
                <td>" . number_format($price,2,".",",") . "</td>
                <td>" . number_format($total,2,".",",") . "</td>
                </tr>");
    }
    ?>
    <tr >
        <td colspan="9"><strong>Sum of Listed Transactions</strong></td>
        <td><?php
            //calculate gains/losses
            $acc = array_shift($trades);
            foreach ($trades as $val) {
                foreach ($val as $key => $val) {
                    $acc[$key] += $val;
                }
            }
            $gainlosses = $acc['total'];
            echo("<strong>" . $unitsymbol . htmlspecialchars(number_format($gainlosses,2,".",",")) . "</strong>");
            ?></td>
    </tr>
</table>




 <br />  <br />

