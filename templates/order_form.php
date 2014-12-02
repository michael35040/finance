<?php
if (!isset($commission)) //set in constants.php
{ $commission = 0; }
?>

<style>
    .exchangeTable
    {   margin-top:5px;
    }
    .exchangeTable td, .exchangeTable th
    {   background-color:white;
    }
    .exchangeTable tr
    {   border:3px solid black;
    }
</style>
<script>
    function commify(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }
</script>
<div class="exchangeTable">
<form action="order.php" method="post"
      oninput="
                priceAmount.value=parseFloat(parseFloat(dollar.value)+parseFloat(cents.value/100)).toFixed(2);
          quantityAmount.value=quantity.value;
          if(document.getElementById('marketSub').checked==true){priceAmount.value=(parseFloat(priceAmount.value)*0).toFixed(2);}
          if(document.getElementById('sellOrder').checked==true)
          {
          commissionAmount.value=parseFloat(parseInt(quantityAmount.value)*parseFloat(priceAmount.value)*<?php echo($commission) ?>).toFixed(2);
          commissionAmount.value=(parseFloat(commissionAmount.value)*4).toFixed(2);
          commissionAmount.value=Math.floor(commissionAmount.value);
          commissionAmount.value=(parseFloat(commissionAmount.value)/4).toFixed(2);
          }
          if(document.getElementById('buyOrder').checked==true){commissionAmount.value=parseFloat(parseInt(quantityAmount.value)*parseFloat(priceAmount.value)*0).toFixed(2);}
          subtotal.value=parseFloat(parseFloat(quantityAmount.value)*parseFloat(priceAmount.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantityAmount.value)*parseFloat(priceAmount.value)-parseFloat(commissionAmount.value)).toFixed(2);
          priceAmount.value=commify(priceAmount.value);
          quantityAmount.value=commify(quantityAmount.value);
          commissionAmount.value=commify(commissionAmount.value);
          subtotal.value=commify(subtotal.value);
          total.value=commify(total.value);
          "
      onclick="
          priceAmount.value=parseFloat(parseFloat(dollar.value)+parseFloat(cents.value/100)).toFixed(2);
          quantityAmount.value=quantity.value;
          if(document.getElementById('marketSub').checked==true){priceAmount.value=(parseFloat(priceAmount.value)*0).toFixed(2);}
          if(document.getElementById('sellOrder').checked==true)
          {
          commissionAmount.value=parseFloat(parseInt(quantityAmount.value)*parseFloat(priceAmount.value)*<?php echo($commission) ?>).toFixed(2);
          commissionAmount.value=(parseFloat(commissionAmount.value)*4).toFixed(2);
          commissionAmount.value=Math.floor(commissionAmount.value);
          commissionAmount.value=(parseFloat(commissionAmount.value)/4).toFixed(2);
          }
          if(document.getElementById('buyOrder').checked==true){commissionAmount.value=parseFloat(parseInt(quantityAmount.value)*parseFloat(priceAmount.value)*0).toFixed(2);}
          subtotal.value=parseFloat(parseFloat(quantityAmount.value)*parseFloat(priceAmount.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantityAmount.value)*parseFloat(priceAmount.value)-parseFloat(commissionAmount.value)).toFixed(2);
          priceAmount.value=commify(priceAmount.value);
          quantityAmount.value=commify(quantityAmount.value);
          commissionAmount.value=commify(commissionAmount.value);
          subtotal.value=commify(subtotal.value);
          total.value=commify(total.value);
          ">

    <fieldset>

        <table class="table table-condensed  table-bordered" >
        <thead>
            <tr>
                <th style="font-size:120%;">EXCHANGE</th>
                <th style="font-size:120%;">ORDER FORM</th>
            </tr>
        </thead>
        <tbody>
        <TR>
            <TD ROWSPAN="1">Symbol</TD>
            <TD>
                <select name="symbol"><?php

                    if (empty($stocks)) {
                        echo("<option value=' '>No Stocks Held</option>");
                    } else {
                        echo ('<option class="select-dash" disabled="disabled">-Assets (Owned/Locked)-</option>');
                        foreach ($stocks as $stock) {
                            $symbol = $stock["symbol"];
                            $symbol = htmlspecialchars($symbol);
                            $quantity = $stock["quantity"];
                            $quantity = htmlspecialchars($quantity);
                            $lockedStock = $stock["locked"];
                            $lockedStock = htmlspecialchars($lockedStock);
                            echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                        }
                    }
                    if (empty($assets)) {
                        echo("<option value=' '>No Assets</option>");
                    } else {
                        echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                        foreach ($assets as $asset) {
                            $symbol = $asset["symbol"];
                            $symbol = htmlspecialchars($symbol);
                            echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                        }
                    }
                    ?></select>
            </TD>
        </TR>

            <TR>
                <TD >Side</TD>
                <TD >
                    <INPUT TYPE="radio" NAME="side" VALUE="b" id="buyOrder" required> Buy / Bid Order <br>
                    <INPUT TYPE="radio" NAME="side" VALUE="a" id="sellOrder" required> Sell / Ask Order
                </TD>
            </TR>




            <TR>
                <TD>Type</TD>

                <TD>
                    <INPUT TYPE="radio" NAME="type" VALUE="limit" id='limitSub' required>Limit<br>
                    <INPUT TYPE="radio" NAME="type" VALUE="market" id='marketSub' required> Market
                </TD>
            </TR>



            <TR>
                <TD ROWSPAN="1">Price</TD>
                <TD>
                    <div id="subMenuPriceText" style="opacity:1;color:red;">
                    </div>
                    <div id="subMenuPrice" style="opacity:1;">
                        <!--
                        <input type="range" id="price" placeholder="Price" name="price" value=0
                        min="0.25" max="100" step=".25" style="width:100%;" required>
                        -->

                        <?php echo($unitsymbol) ?> <input type="number" id="dollar" placeholder="dollar" name="dollar" value="0" min="0" max="999999" size="6"
                        required />
                        <select id="cents" name="cents">
                        <?php 
                        $i=0; 
                        while($i<100)
                        {   if($i<10){$b='0';}else{$b='';}
                            echo('<option value="' . $i . '">.' . $b . $i . '</option>');
                            $i = $i+($divisor*100);  //or $i++;   ; <option value="75">75</option>
                        }
                        ?>
                        </select>
                    </div>


                </TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Quantity</TD>
                <TD>
                    <!--<input type="range" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" max="10000" step="1" style="width:100%;" required> -->
                    <input type="number" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" required>

                </TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Subtotal</TD>
                <TD>
                    Price: <?php echo($unitsymbol) ?> <output name="priceAmount" for="price" style="display:inline">0</output><br>
                    Quantity: <output name="quantityAmount" for="quantity" style="display:inline">1</output><br>
                    Subtotal: <?php echo($unitsymbol) ?> <output name="subtotal" for="price quantity" style="display:inline">0</output><br>
                    <?php


                    if ($commission != 0) {
                        $commission *= 100;
                        echo('Commission: ' . $unitsymbol. ' -<output name="commissionAmount" for="commission" style="display:inline">0</output>');
                    } else {
                        echo("No Commission!" . $unitsymbol . "0 (0%)");
                    }
                    ?>
                    <div id="commissionText" style="opacity:1;color:red;">
                    </div>
                </TD>
            </TR>
            <TR>
                <TD ROWSPAN="1">Total</TD>
                <TD>
                    <?php echo($unitsymbol . ' <output name="total" for="price quantity commission"  style="display:inline">0</output>'); ?>
                </TD>
            </TR>

        <tr><td colspan="2"> <br>
               <center>
                   <button type="submit" class="btn btn-primary">SUBMIT</button>
               </center>

                <br></td></tr>

        </tbody>

</TABLE>




</fieldset>
</form>
</div>




<script>

    //SELL ORDER
    document.getElementById("sellOrder").addEventListener("click", function () {
        document.getElementById('commissionText').innerHTML = 'Commission subtracted from total.';
    }, false);
    //BUY ORDER
    document.getElementById("buyOrder").addEventListener("click", function () {
        document.getElementById('commissionText').innerHTML = 'No commission for Bids!';
    }, false);



    //TYPE MARKET
    document.getElementById("marketSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = 'Market Order';
        document.getElementById("subMenuPrice").style.opacity = 0;
        document.getElementById("price").disabled = true;
        document.getElementById('price').value='0';
    }, false);

    //TYPE LIMIT
    document.getElementById("limitSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = '';
        document.getElementById("subMenuPrice").style.opacity = 1;
        document.getElementById("price").disabled = false;
    }, false);
</script>
