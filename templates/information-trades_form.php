
<style>
h3
{
    text-shadow: 1px 1px 2px #000;
    color:white;

}
</style>


<h3 style='text-align:center;'>
    <?php echo(htmlspecialchars(strtoupper($symbol))); ?><br>
    Trades<br>
    <?php echo(date('l jS \of F Y h:i:s A')); ?>
</h3>




<table align="center" class="table">
    <tr class="info" style="font-weight:bold;">
        <td>Total</td>
        <?php echo("<td>" . (number_format($tradestotal[0]["totaltrades"],0,".",",")) . " Trades</td>"); ?>
        <?php echo("<td>" . (number_format($tradestotal[0]["totalquantity"],0,".",",")) . " Quantity</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["totaltotal"]),$decimalplaces,".",",")) . " Total</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["avgprice"]),$decimalplaces,".",",")) . " Avg. Price</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["totalcommission"]),$decimalplaces,".",",")) . " Commission</td>"); ?>
        <td colspan="5"></td>
    </tr>
</table>

<br>


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

    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . (number_format(($row["quantity"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["commission"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo($colorB . (number_format(($row["buyer"]),0,".",",")) . "</td>");
    echo($colorS . (number_format(($row["seller"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["askorderuid"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["bidorderuid"]),0,".",",")) . "</td>");

    }
    ?>
</tr>









</table>
