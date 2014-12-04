<table class="table table-condensed table-bordered">

    <thead>
    <tr class="success">
        <td colspan="9" style="font-size:20px; text-align: center;">ACTIVE ORDERS</td>
    </tr>
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
    </thead>

    <tbody >

    <?php
    $OrderNumber=0;
    $OrderQuantity=0;
    $OrderPrice=0;
    $OrderTotal=0;

    foreach ($orders as $row)
    { 	$price = getPrice($row["price"]);
    	$total = getPrice($row["total"]);
    	if($row["side"]=="b"){$row["side"]='bid';}
    	if($row["side"]=="a"){$row["side"]='ask';}
    	
        echo("<tr>");
        echo('<td><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="orders.php" name="cancel" value="' . $row["uid"] . '"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>');
        echo("<td>" . number_format($row["uid"], 0, ".", "") . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row["date"]))) . "</td>");
         echo("<td><form><button type='submit' class='btn btn-primary btn-xs' formmethod='post' formaction='information.php' name='symbol' value='" . $row['symbol'] . "'><b>&nbsp;" . $row['symbol'] . "&nbsp;</b></button></form></td>");
        //echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["side"])) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["type"])) . "</td>");
        echo("<td>" . number_format($row["quantity"], 0, ".", ",") . "</td>");
        echo("<td>" . $unitsymbol . number_format($price, 2, ".", ",") . "</td>");
        echo("<td>" . $unitsymbol . number_format($total, 2, ".", ",") . "</td>");
        echo("</tr>");
        $OrderNumber++;
        /*
        $OrderQuantity=$OrderQuantity+$row["quantity"];
        $OrderPrice=$OrderPrice+$row["price"];
        $OrderTotal=$OrderTotal+$row["total"];
        */
    }
    if($OrderNumber==0)
    {
        echo("<tr><td colspan='9'>No active orders</td></tr>");
    }
    else
    { 
    $ordertotal = getPrice($ordertotal[0]["sumtotal"]);
    ?>
        <tr  class="danger" style="font-weight: bold;">
        <td>
            <form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="orders.php" name="cancel" value="ALL"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>
        <td colspan='7'><?php echo(number_format($OrderNumber, 0, ".", ",")) ?> open orders</td>
        <td><?php echo($unitsymbol . number_format($ordertotal, 2, ".", ",")) ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>

</table>








<table class="table table-condensed  table-bordered">
    <thead>

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
    <tr   class="active" >
        <th>Order #</th>
        <th>Date/Time (Y/M/D)</th>
        <th>Symbol</th>
        <th>Action</th>
    </tr>
</thead>
    <tbody>
    <?php
    foreach ($history as $row)
    {
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["ouid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        if($row["transaction"]=='EXECUTED')
        {echo('<td><form><button type="submit" class="btn btn-danger btn-xs" formmethod="post" formaction="trades.php" name="uid" value="' . htmlspecialchars($row["ouid"]) . '">EXECUTED</button></form></td>');}
        else //BID/ASK/CANCEL
        {echo("<td>" . htmlspecialchars($row["transaction"]) . "</td>");}
        echo("</tr>");
    }
    ?>
    <tr >

        <td colspan="3"><strong>Sum of Listed Transactions</strong></td>
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
    </tbody>
</table>
