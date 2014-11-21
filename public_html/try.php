
<?php
require("../includes/config.php");
//apologize(var_dump(get_defined_vars())); //dump all variables if i hit error

$unitsymbol = "$";
$goldColor="#FCFF00;";
$silverColor="#CCC;";
$gold["buy"]=100;
$gold["sell"]=90;
$silver["buy"]=20;
$silver["silver"]=15;
$gold["premium"]=5;
$silver["premium"]=2;
$gold["ask"]=1200;
$gold["bid"]=1105;
$silver["ask"]=17;
$silver["bid"]=15;


$buyGold = [
        "type" => "BUY",
        "asset" => "GOLD",
        "var" => $gold["buy"],
        "color" => $goldColor,
        "name" => "buyGold",
        "premium" => $gold["premium"],
        "trans" => "Ask",
        "side" => $gold["ask"],
        "button" => "green",
    ];
$sellGold = [
        "type" => "SELL",
        "asset" => "GOLD",
        "var" => $gold["sell"],
        "color" => $goldColor,
        "name" => "sellGold",
        "premium" => $gold["premium"],
        "trans" => "Bid",
        "side" => $gold["bid"],
        "button" => "red",
];
$buySilver = [
        "type" => "BUY",
        "asset" => "SILVER",
        "var" => $silver["buy"],
        "color" => $silverColor,
        "name" => "buySilver",
        "premium" => $silver["premium"],
        "trans" => "Ask",
        "side" => $silver["ask"],
        "button" => "green",
];
$sellSilver = [
        "type" => "SELL",
        "asset" => "SILVER",
        "var" => $silver["silver"],
        "color" => $silverColor,
        "name" => "sellSilver",
        "premium" => $silver["premium"],
        "trans" => "Bid",
        "side" => $silver["bid"],
        "button" => "red",
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
       <form action="instatrade.php" method="post" name="<?php echo($type["name"]); ?>"
             oninput="
                    quantityAmount.value=quantity.value;
t                   otalAmount.value=parseFloat(parseFloat(quantity.value)*parseFloat(<?php echo($type["var"]); ?>)).toFixed(2);"
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
                       <?php echo($type["asset"] . " " . $type["trans"]); ?> Price<br /><div style="font-size:200%"><?php echo($unitsymbol . number_format($type["side"], 2, ".", ",")) ?></div>
                   </td>
                   <td style="border-bottom: 1px solid black;width:50%;background-color:<?php echo($type["color"]); ?>">
                       <b>Commission</b>: <?php echo($unitsymbol . number_format($type["premium"], 2, ".", ",")) ?><br />
                       <b>Price</b>: <?php echo(number_format($type["var"], 2, ".", ",")); ?>/ozt
                   </td>
               </tr>
               <tr>
                   <td style="background-color:<?php echo($type["color"]); ?>">
                       <div class="input-group"><input type="number" class="form-control" id="quantity" name="quantity" placeholder="# of ounces" value=1
                                                       min="1" step="1" ><span class="input-group-addon">ozt</span></div>
                       <button type="submit" name="metalTransaction" value="<?php echo($type["name"]); ?>" style="width:100%;background:<?php echo($type["button"]); ?>;color:white;"><?php echo($type["type"] . " " . $type["asset"]); ?></button>
                   </td>
                   <td style="background-color:<?php echo($type["color"]); ?>">
                       <?php echo($type["type"]); ?> <output name="quantityAmount" for="quantity" style="display:inline;">0</output> ozt for $<output name="totalAmount" for="price quantity" style="display:inline;">0</output>
                   </td>
               </tr>
               </tbody>
           </table>
       </form>
<?php  }
?>