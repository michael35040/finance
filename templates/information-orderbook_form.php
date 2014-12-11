
<style>
    .nobutton button
    {
        text-shadow: 1px 1px 2px #fff;

        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
</style>

<table align="center" class="table" style="text-align:center;">
    <tr>
        <td colspan="7" style="text-align:center;border:1px solid black;font-weight:bold;background-color:black;color:white;">BID</td>
        <td>
        <div style="text-align:center">
            <form method="post" action="information.php"><span class="nobutton"><button type="submit" name="symbol" value="<?php echo(htmlspecialchars(strtoupper($symbol))); ?>"><?php echo(htmlspecialchars(strtoupper($symbol))); ?></button></span></form><br>
        </div>
        </td>
        <td colspan="7" style="text-align:center;border:1px solid black;font-weight:bold;background-color:black;color:white;">ASK</td>
    </tr>

    <tr class="active">
        <td>ID</td>
        <td>Side</td>
        <td>Date/Time (Y/M/D)</td>
        <td>Type</td>
        <td>Total</td>
        <td>Quantity</td>
        <td>Order #</td>

        <td><b>Price</b></td>

        <td>Order #</td>
        <td>Quantity</td>
        <td>Total</td>
        <td>Type</td>
        <td>Date/Time (Y/M/D)</td>
        <td>Side</td>
        <td>ID</td>
    </tr>

    <?php
    foreach ($bids as $row)
    {
    if($row['id']==$id){$color=' style="background-color:red;"';}
    else{$color='';}
    ?>
    <tr>
        <?php
        if($row["side"]=='b'){$side='BID';}
        if($row["side"]=='a'){$side='ASK ';}
        echo('<td' . $color .'>' . (number_format(($row["id"]),0,".","")) . '</td>');
        echo('<td>' . htmlspecialchars($side) . '</td>');
        echo('<td>' . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . '</td>');
        echo('<td>' . htmlspecialchars(strtoupper($row["type"])) . '</td>');
        echo('<td>' . $unitsymbol . (number_format(getPrice($row["total"]),$decimalplaces,".",",")) . '</td>');
        echo('<td>' . number_format($row["quantity"],0,".",",") . '</td>');
        echo('<td>' . (number_format($row["uid"],0,".","")) . '</td>');
        echo('<td style="background-color:lightgray;">' . $unitsymbol . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . '</td>
        <td colspan="7"></td>');


        }
        ?>
    </tr>



    <?php
    foreach ($asks as $row)
    {
    if($row['id']==$id){$color=' style="background-color:red"';}
    else{$color='';}
    ?>
    <tr>
        <td colspan="7"></td>
        <?php
        if($row["side"]=='b'){$side='BID';}
        if($row["side"]=='a'){$side='ASK ';}

        echo('<td style="background-color:lightgray;">' . $unitsymbol . (number_format(getPrice($row["price"]),$decimalplaces,".",",")) . '</td>');
        echo('<td>' . (number_format($row["uid"],0,".","")) . '</td>');
        echo('<td>' . number_format($row["quantity"],0,".",",") . '</td>');
        echo('<td>' . $unitsymbol . (number_format(getPrice($row["total"]),$decimalplaces,".",",")) . '</td>');
        echo('<td>' . htmlspecialchars($row["type"]) . '</td>');
        echo('<td>' . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . '</td>');
        echo('<td>' . htmlspecialchars($side) . '</td>');
        echo('<td' . $color .'>' . (number_format(($row["id"]),0,".","")) . '</td>');
        }
        ?>
    </tr>


</table>
