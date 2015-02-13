<style>
    .nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
        .table, th
    {
    	text-align: center;
    }
</style>







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

                        <span class="input-group-btn" style="display:inline;">
    <form method="post" action="trades.php"><button type="submit" class="btn btn-success btn-xs" name="trades" value="all">
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
    </button></form>
</span>

	');
                }
                else
                {
                    echo('

                        <span class="input-group-btn" style="display:inline;">
    <form method="post" action="trades.php"><button type="submit" class="btn btn-success btn-xs" name="trades" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Show Last 10
    </button></form>
</span>

	');
                }
            }

            ?>
        </td></tr>
    <tr   class="active" >
        <th >Trade #</th>
        <th >Buyer</th>
        <th >Bid Order#</th>
        <th >Seller</th>
        <th >Ask Order#</th>
        <th >Date</th>
        <th >Type</th>
        <th >Symbol</th>
        <th >Quantity</th>
        <th >Price</th>
        <th >Commission</th>
        <th >Total</th>
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
        $price = getPrice($trade["price"]);
        $commission = getPrice($trade["commission"]);
        $total = getPrice($trade["total"]);

        if($seller!=$_SESSION["id"]){$commission=0;} // || ($type!='market' && $type!='limit')){$commission=0;} //only seller pays commission && do not include ipos.
        $sumcommission = $sumcommission + $commission;
        $total = $total - $commission;
        $sumtotal = $sumtotal + $total;


        $color="";
        if ($seller==$_SESSION["id"]){$color="style='background-color:#FFFCFB;'";}
        if ($buyer==$_SESSION["id"]){$color="style='background-color:#F5FFFF;'";}
        if ($buyer==$_SESSION["id"] && $seller==$_SESSION["id"]){$color="style='background-color:#F0F0F0;'";}


        ?>
        <tr>
                    <td <?php echo($color); ?>><?php echo(number_format($uid,0,".","")); ?></td>
                    <td <?php echo($color); ?>><?php  echo(number_format($buyer,0,".","")); ?></td>
                    <td <?php echo($color); ?>><?php  echo(number_format($bidorderuid,0,".","")); ?></td>
                    <td <?php echo($color); ?>><?php  echo(number_format($seller,0,".","")); ?></td>
                    <td <?php echo($color); ?>><?php  echo(number_format($askorderuid,0,".","")); ?></td>
                    <td <?php echo($color); ?>><?php  echo(htmlspecialchars(date('Y-m-d H:i:s',strtotime($date)))); ?></td>
                    <td <?php echo($color); ?>><?php  echo(strtoupper(htmlspecialchars("$type"))); ?></td>
                    <td <?php echo($color); ?>><form method='post' action='information.php'><span class='nobutton'><button type='submit' name='symbol' value='<?php echo($symbol); ?>'><?php echo($symbol); ?></button></span></form></td>
                    <td <?php echo($color); ?>><?php  echo(number_format($quantity,0,".",",")); ?></td>
                    <td <?php echo($color); ?>><?php  echo($unitsymbol . number_format($price,$decimalplaces,".",",")); ?></td>
                    <td <?php echo($color); ?>><?php  echo($unitsymbol . '-' . number_format($commission,$decimalplaces,".",",")); ?></td>
                    <td <?php echo($color); ?>><?php  echo($unitsymbol . number_format($total,$decimalplaces,".",",")); ?></td>
                </tr>
    <?php
    }
    if($i==0){echo("<tr><td colspan='12'>No trades</td></tr>");}
    elseif($i>0)
    {
    ?>
    </tbody>
    <tfoot>
    <tr >
        <td colspan="8"><strong>Sum of <?php echo($i) ?> listed transactions</strong></td>
        <td colspan="2">
            <strong> <?php 
            $subtotal=$sumcommission+$sumtotal;
            echo($unitsymbol . htmlspecialchars(number_format($subtotal,$decimalplaces,".",","))); ?>
        </td>        
        <td>
            <strong><?php echo($unitsymbol . '-' . htmlspecialchars(number_format($sumcommission,$decimalplaces,".",","))); ?></strong>
        </td>
        <td>
            <strong> <?php echo($unitsymbol . htmlspecialchars(number_format($sumtotal,$decimalplaces,".",","))); ?></strong>
        </td>
    </tr>
    <?php } //$i>0
?>

    </tfoot>
</table>

































<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#trades">SORT</button>


<!-- Modal -->
<div class="modal fade" id="trades" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">TRADES</h4>
            </div>
            <div class="modal-body">



                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript">
                    google.load("visualization", "1", {packages:["table"]});
                    google.setOnLoadCallback(drawTable);

                    function drawTable() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number', 'Trade');
                        data.addColumn('number', 'Buyer');
                        data.addColumn('number', 'Bid');
                        data.addColumn('number', 'Seller');
                        data.addColumn('number', 'Ask');
                        data.addColumn('string', 'Date'); /*datetime*/
                        data.addColumn('string', 'Type');
                        data.addColumn('string', 'Symbol');
                        data.addColumn('number', 'Quantity');
                        data.addColumn('number', 'Price');
                        data.addColumn('number', 'Commission');
                        data.addColumn('number', 'Total');
                        data.addRows([
                            <?php



                            foreach ($trades as $trade) {
                                $uid = $trade["uid"];
                                $buyer = $trade["buyer"];
                                $bidorderuid = $trade["bidorderuid"];
                                $seller = $trade["seller"];
                                $askorderuid = $trade["askorderuid"];
                                $date = $trade["date"]; //  $date = date("Y,n,j", $trade["date"]); //date('Y-m-d H:i:s', strtotime($row["date"]))
                                $type = strtoupper($trade["type"]);
                                $symbol = $trade["symbol"];
                                $quantity = $trade["quantity"];
                                $price = getPrice($trade["price"]);
                                $commission = getPrice($trade["commission"]);
                                $total = getPrice($trade["total"]);
                                 ?>
                            [
                                <?php echo("{v: " . $uid . ", f: '" . number_format($uid, 0, ".", "") . "'},"); ?>
                                <?php echo("{v: " . $buyer . ", f: '" . number_format($buyer, 0, ".", "") . "'},"); ?>
                                <?php echo("{v: " . $bidorderuid . ", f: '" . number_format($bidorderuid, 0, ".", "") . "'},"); ?>
                                <?php echo("{v: " . $seller . ", f: '" . number_format($seller, 0, ".", "") . "'},"); ?>
                                <?php echo("{v: " . $askorderuid . ", f: '" . number_format($askorderuid, 0, ".", "") . "'},"); ?>
                                <?php echo("'" . $date . "',"); //echo(" new Date(" . $date . "),"); ?>
                                <?php echo("'" . $type . "',"); ?>
                                <?php echo("'" . $symbol . "',"); ?>
                                <?php echo("{v: " . $quantity . ", f: '" .  number_format($quantity, 0, ".", ",") . "'},"); ?>
                                <?php echo("{v: " . $price . ", f: '" . $unitsymbol . number_format($price, $decimalplaces, ".", ",") . "'},"); ?>
                                <?php echo("{v: " . $commission . ", f: '" . $unitsymbol . number_format($commission, $decimalplaces, ".", ",") . "'},"); ?>
                                <?php echo("{v: " . $total . ", f: '" . $unitsymbol . number_format($total, $decimalplaces, ".", ",") . "'},"); ?>

                            ],
                            <?php
                            }?>

                        ]);

                        var table = new google.visualization.Table(document.getElementById('table_div'));

                        table.draw(data, {showRowNumber: false});
                    }
                </script>
                <div id="table_div"></div>







            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>







