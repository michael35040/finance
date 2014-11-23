
<table class="table table-condensed  table-bordered" >
<thead>
    <tr   class="success" ><td colspan="12"  style="font-size:20px; text-align: center;"><?php echo(strtoupper($title)); ?> &nbsp;
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
        <td ><b>Trade #</b></td>
        <td ><b>Buyer</b></td>
        <td ><b>Bid Order#</b></td>
        <td ><b>Seller</b></td>
        <td ><b>Ask Order#</b></td>
        <td ><b>Date</b></td>
        <td ><b>Type</b></td>
        <td ><b>Symbol</b></td>
        <td ><b>Quantity</b></td>
        <td ><b>Price</b></td>
        <td ><b>Commission</b></td>
        <td ><b>Total</b></td>
    </tr>

</thead>
    <tbody>


    <?php
    $i=0;
    $sumcommission=0;
    $sumtotal=0;
    foreach ($trades as $trade)
    {$i++;
        $uid = $trade["uid"];
        $buyer = $trade["buyer"];
        $bidorderuid = $trade["bidorderuid"];
        $seller = $trade["seller"];
        $askorderuid = $trade["askorderuid"];
        $date = $trade["date"];
        $type = $trade["type"];
        $symbol = $trade["symbol"];
        $quantity = $trade["quantity"];
        $price = $trade["price"];
        $commission = $trade["commission"];
        if($seller!=$_SESSION["id"] || $type=='PO'){$commission=0;} //only seller pays commission
        $sumcommission = $sumcommission + $commission;
        $total = $trade["total"];
        $total = $total - $commission;
        $sumtotal = $sumtotal + $total;
        echo("

                <tr>
                    <td>" . number_format($uid,0,".",",") . "</td>
                    <td>" . number_format($buyer,0,".",",") . "</td>
                    <td>" . number_format($bidorderuid,0,".","") . "</td>
                    <td>" . number_format($seller,0,".",",") . "</td>
                    <td>" . number_format($askorderuid,0,".","") . "</td>
                    <td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($date))) . "</td>
                    <td>" . strtoupper(htmlspecialchars("$type")) . "</td>
                    <td>" . htmlspecialchars("$symbol") . "</td>
                    <td>" . number_format($quantity,0,".",",") . "</td>
                    <td>" . number_format($price,2,".",",") . "</td>
                    <td>" . number_format($commission,2,".",",") . "</td>
                    <td>" . number_format($total,2,".",",") . "</td>
                </tr>");
    }
    if($i==0){echo("<tr><td colspan='12'>No trades</td></tr>");}
    elseif($i>0)
    {
    ?>
    <tr >
        <td colspan="10"><strong>Sum of <?php echo($i) ?> listed transactions</strong></td>
        <?php
        /*
            //calculate gains/losses
            $acc = array_shift($trades);
            foreach ($trades as $val) {
                foreach ($val as $key => $val) {
                    $acc[$key] += $val;
                }
            }
        $sumtotal = $acc['total'];
        $sumcommission = $acc['commission'];
        */
        ?>
        <td>
            <strong> <?php echo($unitsymbol . htmlspecialchars(number_format($sumcommission,2,".",","))); ?>
        </td>
        <td>
            <strong> <?php echo($unitsymbol . htmlspecialchars(number_format($sumtotal,2,".",","))); ?>
        </td>
    </tr>
    <?php } //$i>0
?>

    </tbody>
</table>

 <br />  <br />

