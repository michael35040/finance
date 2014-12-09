<style>
    .nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
</style>

<table class="table table-condensed table-bordered">

    <thead>
    <tr class="success">
        <td colspan="9" style="font-size:20px; text-align: center;">ACTIVE ORDERS (<?php echo(strtoupper($tabletitle)); ?>) &nbsp;
            <?php
            //	Display link to all history as long as your not already there
                if (isset($tabletitle))
                {
                if ($tabletitle !== "All")
                {
                echo('
                
<span class="input-group-btn">
    <form  method="post" action="orders.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="all">
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
    </button></form>
</span>
                
                ');
                }
                else
                {
                echo('
                
<span class="input-group-btn">
    <form method="post" action="orders.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Show Last 10
    </button></form>
</span>
                
                ');
                }
                }
            ?>
        </td></tr>
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


        $color="";
        if($row["side"]=="b"){$row["side"]='bid';$color="style='background-color:#F0FFFF;'";}
    	if($row["side"]=="a"){$row["side"]='ask';$color="style='background-color:#FFF0FF;'";}
    	
        echo("<tr>");
        echo('<td ' . $color . '><form method="post" action="orders.php"><button type="submit" class="btn btn-danger btn-xs" name="cancel" value="' . $row["uid"] . '"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>');
        echo("<td " . $color . ">" . number_format($row["uid"], 0, ".", "") . "</td>");
        echo("<td " . $color . ">" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($row["date"]))) . "</td>");
         echo("<td " . $color . "><form method='post' action='information.php'><span class='nobutton'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . $row['symbol'] . "</button></span></form></td>");
        //echo("<td " . $color . ">" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        echo("<td " . $color . ">" . htmlspecialchars(strtoupper($row["side"])) . "</td>");
        echo("<td " . $color . ">" . htmlspecialchars(strtoupper($row["type"])) . "</td>");
        echo("<td " . $color . ">" . number_format($row["quantity"], 0, ".", ",") . "</td>");
        echo("<td " . $color . ">" . $unitsymbol . number_format($price, 2, ".", ",") . "</td>");
        echo("<td " . $color . ">" . $unitsymbol . number_format($total, 2, ".", ",") . "</td>");
        echo("</tr>");
        $OrderNumber++;

        $OrderQuantity=$OrderQuantity+$row["quantity"];
        /*
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
            <form method="post" action="orders.php"><button type="submit" class="btn btn-danger btn-xs" name="cancel" value="ALL"><span class="glyphicon glyphicon-remove-circle"></span></button></form></td>
        <td colspan='5'><?php echo(number_format($OrderNumber, 0, ".", ",")) ?> open orders</td>
            <td><?php echo(number_format($OrderQuantity, 0, ".", ",")) ?></td>
            <td></td>
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
                
<span class="input-group-btn">
    <form  method="post" action="orders.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="all">
        <span class="glyphicon glyphicon-plus-sign"></span> Show All
    </button></form>
</span>
                
                ');
                }
                else
                {
                echo('
                
<span class="input-group-btn">
    <form method="post" action="orders.php"><button type="submit" class="btn btn-success btn-xs" name="history" value="limit">
        <span class="glyphicon glyphicon-minus-sign"></span> Show Last 10
    </button></form>
</span>
                
                ');
                }
                }
                ?>
        </td></tr>
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
    {  $row["symbol"] = htmlspecialchars(strtoupper($row["symbol"]));
        echo("<tr>");
        echo("<td>" . htmlspecialchars($row["ouid"]) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        //echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        echo("<td><form method='post' action='information.php'><span class='nobutton'><button type='submit' name='symbol' value='" . $row['symbol'] . "'>" . $row['symbol'] . "</button></span></form></td>");

        if($row["transaction"]=='EXECUTED')
        {echo('<td><form method="post" action="trades.php"><span class="nobutton"><button type="submit" name="uid" value="' . htmlspecialchars($row["ouid"]) . '">EXECUTED</button></span></form></td>');}
        else //BID/ASK/CANCEL
        {echo("<td>" . htmlspecialchars($row["transaction"]) . "</td>");}
        echo("</tr>");
    }
    ?>
    </tbody>
</table>
