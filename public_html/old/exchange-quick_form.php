<?php
$goldColor="#FFD700;";
$silverColor="#C0C0C0;";
$dollarColor="#85bb65;";


?>

<style>
    .container
    {
    }
    .container table {
        width:237px;
        display:inline-block;
        text-align:center;
        border-collapse:collapse;
        border:3px solid black;
    }
    .container td
    {
        background-color:transparent;
    }
    .fundstable
    {
        width:100%;
        text-align:center;
        color:white;
        text-shadow: 0px 0px 5px #000;
    }
    .fundstable table {
        display:inline-block;
        text-align:center;
        border-collapse:collapse;
        border:0px solid black;
    }
    .fundstable td
    {
        background-color:transparent;
        padding-left:20px;
        padding-right:20px;
        padding-bottom:20px;
    }

    #id td
    {
        background-color:transparent;
    }
    .label-default{text-shadow: 0px 0px 5px #000; background-color:<?php echo($silverColor); ?>}
    .label-warning{text-shadow: 0px 0px 5px #000; background-color:<?php echo($goldColor); ?>}
    .label-success{text-shadow: 0px 0px 5px #000; background-color:<?php echo($dollarColor); ?>}



</style>



<?php
//apologize(var_dump(get_defined_vars())); //dump all variables if i hit error
?>






<div class="fundstable">

    <table>
    <tr>
        <td style="background-color:transparent">
            <h3><span class="label label-warning">Au</span></h3>
            <b>GOLD</b><br /><?php echo(number_format($goldAmount, 0, ".", ",")) ?> g<br />
            <?php $goldOZT=($goldAmount*0.0321507466); echo(number_format($goldOZT, 2, ".", ",")) ?> ozt
            
        </td>
    </tr>
    </table>
    <table>
    <tr>
        <td style="background-color:transparent">
            <h3><span class="label label-success"> &nbsp; $ &nbsp; </span></h3>
            <b><?php echo($unitdescriptionshort) ?></b><br />
            <b><?php echo($unittype) ?></b><br />
            <?php echo($unitsymbol . number_format($units, 2, ".", ",")) ?><br />
        </td>
    </tr>
    </table>
<table>
    <tr>
    <td style="background-color:transparent">
            <h3><span class="label label-default">Ag</span></h3>
            <b>Silver</b><br /><?php echo(number_format($silverAmount, 0, ".", ",")) ?> g<br />
            <?php $silverOZT=($silverAmount*0.0321507466);  echo(number_format($silverOZT, 2, ".", ",")) ?> ozt
        </td>
    </tr>
    </table>

</div><!--fundsTable-->


<div class="container">


<?php
$unitofmeasure='ozt';
$buttoncolor = '#000000';
$buyGold = [
    "type" => "Buy",
    "asset" => "Gold",
    "var" => $gold["buy"],
    "color" => $goldColor,
    "name" => "buyGold",
    "premium" => $gold["premium"],
    "trans" => "Ask",
    "side" => $gold["ask"],
    "button" => $buttoncolor,
];
$sellGold = [
    "type" => "Sell",
    "asset" => "Gold",
    "var" => $gold["sell"],
    "color" => $goldColor,
    "name" => "sellGold",
    "premium" => $gold["discount"],
    "trans" => "Bid",
    "side" => $gold["bid"],
    "button" => $buttoncolor,
];
$buySilver = [
    "type" => "Buy",
    "asset" => "Silver",
    "var" => $silver["buy"],
    "color" => $silverColor,
    "name" => "buySilver",
    "premium" => $silver["premium"],
    "trans" => "Ask",
    "side" => $silver["ask"],
    "button" => $buttoncolor,
];
$sellSilver = [
    "type" => "Sell",
    "asset" => "Silver",
    "var" => $silver["sell"],
    "color" => $silverColor,
    "name" => "sellSilver",
    "premium" => $silver["discount"],
    "trans" => "Bid",
    "side" => $silver["bid"],
    "button" => $buttoncolor,
];
$types=[
    0=>$buyGold,
    1=>$sellGold,
    2=>$buySilver,
    3=>$sellSilver,
];
foreach ($types as $type) {
    //apologize(var_dump(get_defined_vars())); //dump all variables if i hit error

    ?>
    <form action="exchange-quick.php" method="post" name="<?php echo($type["name"]); ?>"
          oninput="
                    quantityAmount.value=quantity.value;
                    totalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($type["var"]); ?>)).toFixed(2);"
          onclick="
              quantityAmount.value=quantity.value;
              totalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($type["var"]); ?>)).toFixed(2);"
        >
        <table>
            <thead>
            </thead>
            <tbody>
            <tr>
                <td style="width:50%;background-color:<?php echo($type["color"]); ?>">
                    <?php echo($type["asset"] . " " . $type["type"]); ?> Price
                    <br />
                    <div style="font-size:200%">
                        <?php echo(number_format($type["var"], 2, ".", ",")); ?>
                        
                    </div>
                </td>
                <td style="border-bottom: 1px solid black;width:50%;background-color:<?php echo($type["color"]); ?>">
                    <b><?php echo($type["trans"]); ?></b>: <?php echo($unitsymbol . number_format($type["side"], 2, ".", ",")) ?>
                    <br>
                    <b>Fee</b>: -<?php echo($unitsymbol . number_format($type["premium"], 2, ".", ",")) ?>
                    <br />
                    <?php //echo($type["type"]); ?><output name="quantityAmount" for="quantity" style="display:inline;">0</output><?php echo($unitofmeasure); ?> for $<output name="totalAmount" for="price quantity" style="display:inline;">0</output>

                </td>
            </tr>
            <tr>
                <td style="background-color:<?php echo($type["color"]); ?>">
                    <div class="input-group"><input type="number" class="form-control" id="quantity" name="quantity" placeholder="# of <?php echo($unitofmeasure); ?>"
                                                    min="1" step="1" required><span class="input-group-addon"><?php echo($unitofmeasure); ?></span></div>
                </td>
                <td style="background-color:<?php echo($type["color"]); ?>">
                    <button type="submit" name="metalTransaction" value="<?php echo($type["name"]); ?>" style="height:30px;width:100%;background:<?php echo($type["button"]); ?>;color:white;"><?php echo(strtoupper($type["type"])); // . " " . $type["asset"]); ?></button>

                </td>
            </tr>
            </tbody>
        </table>
    </form>
<?php  }
?>









</div>














<br>
<table class="table table-condensed table-striped" style="text-align:center;background-color:#FC0;margin-bottom:0px;border-collapse:collapse;width:100%;color:white;">
    <thead>
    <tr>
        <td colspan="5"  style="font-weight:bold;font-size:20px;text-align:center;background-color:#222222;color:white;width:100%;" >RECENT TRADES</td>
    </tr>
    </thead>
    <tbody>
<?php
//    apologize(var_dump(get_defined_vars()));      apologize(var_dump($trade));
$id=$_SESSION["id"];
foreach ($trades as $trade) {
    $tradePrice = getPrice($trade["price"]);
    $tradeTotal = getPrice($trade["total"]);
    $tradeCommission = getPrice($trade["commission"]);
    if($trade["buyer"]==$id)
    {   $color="06C";
        $trans="Buy";
        //buying has no commission //$trade["total"]=$trade["total"]+$trade["commission"];

    }
    elseif($trade["seller"]==$id)
    {    $color="0C9";
        $trans="Sell";   
        $tradeTotal=$tradeTotal-$tradeCommission;
    }
    else{$color="000";
        $trans="UNK";}
    ?>
    <tr>
        <td style="background-color:#<?php echo($color); ?>;"><?php echo($trans);?> <?php echo($trade["symbol"]); ?> Confirmation</td>
        <td style="background-color:#<?php echo($color); ?>;">Date: <?php echo(htmlspecialchars(date('Y-m-d H:i:s', strtotime($trade["date"])))); ?> </td>
        <td style="background-color:#<?php echo($color); ?>;">Unit: $<?php echo(number_format($tradePrice, 2, ".", ",")); ?></td>
        <td style="background-color:#<?php echo($color); ?>;"><?php echo(number_format($trade["quantity"], 0, ".", ",")); ?> ozt</td>
        <td style="background-color:#<?php echo($color); ?>;">Total: $<?php echo(number_format($tradeTotal, 2, ".", ",")); ?></td>
    </tr>        
  <?php  
} ?>

    </tbody>
</table>


<div style="color:white;text-shadow: 1px 1px 5px #000;">
    Trades are instant and irrevocable. Prices subject to change.
</div>



   
   
 
