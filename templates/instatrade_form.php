<style>
    .container
    {
        width:100%;
    }
    .container table {
        float:left;
        text-align:center;
        border-collapse:collapse;
        border:3px solid black;
    }
    .container td
    {
        padding:2px 2px 2px 2px;
    }

</style>

<?php 

    $id = $_SESSION["id"]; //get id from session
    
    $trades = query("SELECT * FROM trades WHERE ((symbol='SILVER' OR symbol='GOLD') AND (buyer=? OR seller=?)) ORDER BY uid DESC", $id, $id);

    $goldAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='GOLD' ORDER BY symbol ASC", $_SESSION["id"]);
    $goldAmount=$goldAmount[0]["quantity"];
    $silverAmount =	query("SELECT quantity FROM portfolio WHERE id = ? AND symbol='SILVER' ORDER BY symbol ASC", $_SESSION["id"]);
    $silverAmount=$silverAmount[0]["quantity"];


    $gold["ask"]=1291.40;
    $gold["premium"]=3;   
    $gold["buy"]=($gold["ask"]+$gold["premium"]);
    
    $gold["bid"]=1291.10;
    $gold["discount"]=2;
    $gold["sell"]=($gold["bid"]-$gold["discount"]);
    
    // apologize(var_dump(get_defined_vars())); //dump all variables if i hit error    
 //TO DO!
 //-Post: Price, Quantity, Side.

?> 

<table class="table table-condensed table-striped table-bordered" style="text-align:center;background-color:#FC0;">
    <thead>
    <tr>
        <td colspan="3"  style="font-weight:bold;font-size:20px;text-align:center;background-color:#606060;color:white;width:100%;" >AVAILABLE BALANCES</td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>
            <h3><span class="label label-warning">Au</span></h3>
            <b>GOLD</b><br /><?php echo(number_format($goldAmount, 0, ".", ",")) ?> ozt
        </td>
        <td>
            <h3><span class="label label-success"> &nbsp; $ &nbsp; </span></h3>
            <b><?php echo($unittype) ?></b><br /><?php echo($unitsymbol . number_format($units, 2, ".", ",")) ?>
        </td>
        <td>
            <h3><span class="label label-default">Ag</span></h3>
            <b>Silver</b><br /><?php echo(number_format($silverAmount, 0, ".", ",")) ?> ozt
        </td>
    </tr>
    </tbody>
    </table>







<div class="container">








<form action="instatrade.php" method="post"
oninput="
quantityAmount.value=quantity.value;
totalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($gold["buy"]) ?>)).toFixed(2);"
onclick="
quantityAmount.value=quantity.value;
totalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($gold["buy"]) ?>)).toFixed(2);"


>
<table>
        <thead>
        </thead>
        <tbody>
            <tr>
                <td style="width:50%;background-color:#FC0;">
                    Spot Price<br /><div style="font-size:200%"><?php echo($unitsymbol . number_format($gold["ask"], 2, ".", ",")) ?></div>
                </td>
                <td style="border-bottom: 1px solid black;width:50%;background-color:#FC0;">
                    <b>Premium</b>: <?php echo($unitsymbol . number_format($gold["premium"], 2, ".", ",")) ?><br />
                    <b>Price</b>: <?php echo(number_format($gold["buy"], 2, ".", ",")); ?>/ozt
                </td>
            </tr>
            <tr>
                <td style="background-color:#FC0;">
                    <div class="input-group"><input type="number" class="form-control" id="quantity" name="quantity" placeholder="# of ounces" value=0
min="1" step="1" ><span class="input-group-addon">ozt</span></div>
                    <button type="submit" name="metalTransaction" value="buyGold" style="width:100%;background:#404040;color:white;">BUY GOLD</button>
                </td>
                <td style="background-color:#FC0;">
                    Buy <output name="quantityAmount" for="quantity" style="display:inline;">0</output> ozt for $<output name="totalAmount" for="price quantity" style="display:inline;">0</output>
                </td>
            </tr>
        </tbody>
    </table>
</form>





<form action="instatrade.php" method="post"
oninput="
quantityAmount.value=quantity.value;
totalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($gold["sell"]) ?>)).toFixed(2);">
<table>
        <thead>
        </thead>
        <tbody>
            <tr>
                <td style="width:50%;background-color:#FC0;">
                    Spot Price<br /><div style="font-size:200%"><?php echo($unitsymbol . number_format($gold["bid"], 2, ".", ",")) ?></div>
                </td>
                <td style="border-bottom: 1px solid black;width:50%;background-color:#FC0;">
                    <b>Discount</b>: (<?php echo($unitsymbol . number_format($gold["discount"], 2, ".", ",")) ?>)<br />
                    <b>Price</b>: <?php echo(number_format($gold["sell"], 2, ".", ",")); ?>/ozt
                </td>
            </tr>
            <tr>
                <td style="background-color:#FC0;">
                    <div class="input-group"><input type="number" class="form-control" id="quantity" name="quantity" placeholder="# of ounces" value=0
min="1" step="1" ><span class="input-group-addon">ozt</span></div>
                    <button type="submit" name="metalTransaction" value="sellGold" style="width:100%;background:#404040;color:white;">SELL GOLD</button>
                </td>
                <td style="background-color:#FC0;">
                    Sell <output name="quantityAmount" for="quantity" style="display:inline;">0</output> ozt for $<output name="totalAmount" for="price quantity" style="display:inline;">0</output>
                </td>
            </tr>
        </tbody>
    </table>
</form>









</div>














<br>
<table style="text-align:center;border-collapse:collapse;width:100%;color:white;">
    <thead>
    <tr>
        <td colspan="5"  style="font-weight:bold;font-size:20px;text-align:center;background-color:#606060;color:white;width:100%;" >RECENT TRANSACTIONS</td>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($trades as $trade) {
    if($trade["buyer"]==$id)
    {   $color="06C";
        $trans="Buy";
    }
    else
    {    $color="0C9";
        $trans="Sell";        
    }
    ?>
    <tr>
        <td style="background-color:#<?php echo($color); ?>;"><?php echo($trans);?> <?php echo($trade["symbol"]); ?> Confirmation</td>
        <td style="background-color:#<?php echo($color); ?>;">Date: <?php echo(htmlspecialchars(date('Y-m-d H:i:s', strtotime($trade["date"])))); ?> </td>
        <td style="background-color:#<?php echo($color); ?>;">Unit Price: $<?php echo(number_format($trade["price"], 2, ".", ",")); ?></td>
        <td style="background-color:#<?php echo($color); ?>;">Total Weight: <?php echo(number_format($trade["quantity"], 0, ".", ",")); ?></td>
        <td style="background-color:#<?php echo($color); ?>;">Total Price: $<?php echo(number_format($trade["total"], 2, ".", ",")); ?></td>
    </tr>        
  <?php  
} ?>

    </tbody>
</table>




   
   
 
