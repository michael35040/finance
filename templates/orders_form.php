
<table class="table table-condensed  table-bordered">
    <tr class="success">
        <td colspan="9" style="font-size:20px; text-align: center;">ACTIVE ORDERS ON ORDERBOOK</td>
    </tr>
    <!--blank row breaker-->
    <tr class="active">

        <th>Cancel</th>
        <th>Order #</th>
        <th>Date/Time (Y/M/D)</th>
        <th>Symbol</th>
        <th>Side</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </tr>

    <?php
    $OrderNumber=0;
    $OrderQuantity=0;
    $OrderPrice=0;
    $OrderTotal=0;

    foreach ($orders as $row)
    {
        echo("<tr>");
        echo('<td><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="orders.php" name="cancel" value="' . $row["uid"] . '"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>');
        echo("<td>" . htmlspecialchars($row["uid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["side"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["type"])) . "</td>");
        echo("<td>" . htmlspecialchars(number_format($row["quantity"], 0, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["price"], 2, ".", ",")) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["total"], 2, ".", ",")) . "</td>");
        echo("</tr>");
        $OrderNumber++;
        $OrderQuantity=$OrderQuantity+$row["quantity"];
        $OrderPrice=$OrderPrice+$row["price"];
        $OrderTotal=$OrderTotal+$row["total"];
    }
    if($OrderNumber==0)
    {
        echo("<tr><td colspan='9'>No active orders</td></tr>");
    }
    else
    {
        echo('<tr  class="danger" style="font-weight: bold;">'); //class="active"
        echo('<td><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="orders.php" name="cancel" value="ALL"><span class="glyphicon glyphicon-remove-circle"></span></button></form>&nbsp; ALL</td>');
        echo("<td colspan='8'>" . htmlspecialchars(number_format($OrderNumber, 0, ".", ",")) . " open orders</td>");
        //echo("<td>" . htmlspecialchars(number_format($OrderQuantity, 0, ".", ",")) . "</td>");
        //echo("<td>" . $unitsymbol . htmlspecialchars(number_format($OrderPrice, 2, ".", ",")) . "</td>");
        //echo("<td>" . $unitsymbol . htmlspecialchars(number_format($OrderTotal, 2, ".", ",")) . "</td>");
        echo('</tr>');
    }
    ?>






    <tr><td colspan="9"> </td></tr><!--blank line-->

        <tr   class="success" ><td colspan="9"  style="font-size:20px; text-align: center;">ORDER HISTORY (<?php echo(strtoupper($tabletitle)); ?>) &nbsp;
                <?php
                //	Display link to all history as long as your not already there
                if (isset($tabletitle))
                {
                    if ($tabletitle !== "All")
                    {
                        echo('
<form>
<span class="input-group-btn">
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="orders.php" name="history" value="all">
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
    <button type="submit" class="btn btn-success btn-xs" formmethod="post" formaction="orders.php" name="history" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Show Last 10
    </button>
</span>
</form>
	');
                    }
                }

                ?>


            </td></tr> <!--blank row breaker-->









    <tr   class="active" >
        <th></th>
        <th>Order #</th>
        <th>Date/Time (Y/M/D)</th>
        <th>Symbol</th>
        <th>Side</th>
        <th></th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>

    </tr>

    <?php
    foreach ($history as $row)
    {
        echo("<tr>");
        echo("<td> </td>");
        echo("<td>" . htmlspecialchars($row["ouid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        if($row["transaction"]=='EXECUTED')
        {echo('<td><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="trades.php" name="uid" value="' . htmlspecialchars($row["ouid"]) . '">EXECUTED</button></form></td>');}
        else //BID/ASK/CANCEL
        {echo("<td>" . htmlspecialchars($row["transaction"]) . "</td>");}
        echo("<td> </td>");
        echo("<td>" . htmlspecialchars($row["quantity"]) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["price"],2,".",",")) . "</td>");
        echo("<td>" . $unitsymbol . htmlspecialchars(number_format($row["total"],2,".",",")) . "</td>");
        echo("</tr>");
    }
    ?>
    <tr >
        <td colspan="1"></td>
        <td colspan="7"><strong>Sum of Listed Transactions</strong></td>
        <td><?php
            //calculate gains/losses
            $acc = array_shift($history);
            foreach ($history as $val) {
                foreach ($val as $key => $val) {
                    $acc[$key] += $val;
                }
            }
            $gainlosses = $acc['total'];
            echo("<strong>" . $unitsymbol . htmlspecialchars(number_format($gainlosses,2,".",",")) . "</strong>");
            ?></td>
    </tr>
</table>