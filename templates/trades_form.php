
<table class="table table-condensed  table-bordered" >
<thead>
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
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
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
        <span class="glyphicon glyphicon-minus-sign"></span> Show Last 10
    </button>
</span>
</form>
	');
                }
            }

            ?>
        </td></tr>
    <tr   class="active" >
        <td ><b>Buyer</b></td>
        <td ><b>Bid Order#</b></td>
        <td ><b>Seller</b></td>
        <td ><b>Ask Order#</b></td>
        <td ><b>Date</b></td>
        <td ><b>Type</b></td>
        <td ><b>Symbol</b></td>
        <td ><b>Quantity</b></td>
        <td ><b>Price</b></td>
        <td ><b>Total</b></td>
    </tr>

</thead>
    <tbody>


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

    </tbody>
</table>




 <br />  <br />

