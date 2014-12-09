
<style>
.nobutton button
{
    /*text-shadow: 1px 1px 2px #000;*/
    padding:0;
    font-weight: 100;
    border:0;
    background:transparent;
}
</style>

<table align="center" class="table" style="border:3px solid black;">
    <tr class="primary">
        <td>
            <form method="post" action="information.php"><span class="nobutton"><button type="submit" name="symbol" value="<?php echo(htmlspecialchars(strtoupper($symbol))); ?>"><?php echo(htmlspecialchars(strtoupper($symbol))); ?></button></span></form><br>
        </td>
        <td><span style="font-weight:bold;">Trades:</span> <?php echo(number_format($tradestotal[0]["totaltrades"],0,".",",")); ?></td>
        <td><span style="font-weight:bold;">Quantity:</span> <?php echo(number_format($tradestotal[0]["totalquantity"],0,".",",")); ?></td>
        <td><span style="font-weight:bold;">Total:</span> <?php echo($unitsymbol . (number_format(getPrice($tradestotal[0]["totaltotal"]),$decimalplaces,".",","))); ?></td>
        <td><span style="font-weight:bold;">Avg. Price:</span> <?php echo($unitsymbol . (number_format(getPrice($tradestotal[0]["avgprice"]),$decimalplaces,".",","))); ?></td>
        <td><span style="font-weight:bold;">Commission:</span> <?php echo($unitsymbol . (number_format(getPrice($tradestotal[0]["totalcommission"]),$decimalplaces,".",","))); ?></td>
    </tr>
</table>

<table align="center" class="table">

    <tr class="active">
        <th>Trade #</th>
        <th>Date/Time (Y/M/D)</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Price</th>
        <th>Commission</th>
        <th>Type</th>
        <th>Buyer</th>
        <th>Seller</th>
        <th>Ask UID</th>
        <th>Bid UID</th>
    </tr>



<?php
foreach ($trades as $row)
{
if($row['buyer']==$id){$colorB='<td style="background-color:red">';} else{$colorB='<td>';}
if($row['seller']==$id){$colorS='<td style="background-color:red">';} else{$colorS='<td>';}
?>
    <tr>
    <?php

    echo("<td>" . (number_format($row["uid"],0,".","")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . (number_format(($row["quantity"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["commission"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo($colorB . (number_format(($row["buyer"]),0,".","")) . "</td>");
    echo($colorS . (number_format(($row["seller"]),0,".","")) . "</td>");
    echo("<td>" . (number_format(($row["askorderuid"]),0,".","")) . "</td>");
    echo("<td>" . (number_format(($row["bidorderuid"]),0,".","")) . "</td>");

    }
    ?>
</tr>









</table>
