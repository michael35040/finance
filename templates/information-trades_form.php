
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
        <?php echo("<td>" . (number_format($tradestotal[0]["totaltrades"],0,".",",")) . "</td>"); ?>
        <td></td>
        <?php echo("<td>" . (number_format($tradestotal[0]["totalquantity"],0,".",",")) . "</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["totaltotal"]),$decimalplaces,".",",")) . "</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["avgprice"]),$decimalplaces,".",",")) . "</td>"); ?>
        <?php echo("<td>" . $unitsymbol . (number_format(getPrice($tradestotal[0]["totalcommission"]),$decimalplaces,".",",")) . "</td>"); ?>
        <td colspan="5"></td>
    </tr>




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
if($row['buyer']==$id || $row['seller']==$id){$color=' style="background-color:red"';}
else{$color='';}
?> 
<tr <?php echo($color); ?> >
    <?php

    echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
    echo("<td>" . (number_format(($row["quantity"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["total"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . (number_format(getPrice($row["commission"]),$decimalplaces,".",",")) . "</td>");
    echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
    echo("<td>" . (number_format(($row["buyer"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["seller"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["askorderuid"]),0,".",",")) . "</td>");
    echo("<td>" . (number_format(($row["bidorderuid"]),0,".",",")) . "</td>");

    }
    ?>
</tr>









</table>
