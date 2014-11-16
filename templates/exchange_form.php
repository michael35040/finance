<?php
if (!isset($commission)) //set in constants.php
{ $commission = 0; }
?>

<style>
    .exchangeTable td
    {
        /*width:75%;*/
        padding:10px;
    }
</style>
<script>
    function commify(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }
</script>
<hr>
<div class="exchangeTable">
<form action="exchange.php" method="post"
      oninput="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
          priceAmount.value=commify(priceAmount.value);
          quantityAmount.value=commify(quantityAmount.value);
          commissionAmount.value=commify(commissionAmount.value);
          subtotal.value=commify(subtotal.value);
          total.value=commify(total.value);
          "
      onclick="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
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
                <th style="width:25%">Title</th>
                <th style="width:75%">Value</th>
            </tr>
        </thead>
        <tbody>
        <TR>
            <TD ROWSPAN="1">Symbol</TD>
            <TD>
                <!--FOR BASIC INPUT FOR TESTING
                <input type="text" name="symbol"> -->

                <!-- FOR DATALIST IF I ALSO NEED INPUT
                <input list="symbol" placeholder="Symbol" name="symbol" maxlength="8" class="input-small" required>
                <datalist id="symbol">
                -->
                <select name="symbol">

                <?php

                    if (empty($stocks)) {
                        echo("<option value=' '>No Stocks Held</option>");
                    } else {
                        echo ('<option class="select-dash" disabled="disabled">-Assets (Owned/Locked)-</option>');
                        foreach ($stocks as $stock) {
                            $symbol = $stock["symbol"];
                            $quantity = $stock["quantity"];
                            $lockedStock = $stock["locked"];
                            echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                        }
                    }
                    if (empty($assets)) {
                        echo("<option value=' '>No Assets</option>");
                    } else {
                        echo ('    <option class="select-dash" disabled="disabled">-All Assets-</option>');
                        foreach ($assets as $asset) {
                            $symbol = $asset["symbol"];
                            echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                        }
                    }

                    ?>
                    </select>

                    <!--
                    </datalist>
                    -->
            </TD>
        </TR>

            <TR>
                <TD ROWSPAN="2">Side</TD>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="b" required> Buy / Bid Order</TD>
            </TR>
            <TR>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="a" required> Sell / Ask Order</TD>
            </TR>



            <TR>
                <TD ROWSPAN="2">Type</TD>

                <TD>

                    <div id="subMenuType" style="opacity:1; display:inline">
                        <INPUT TYPE="radio" NAME="type" VALUE="limit" id='limitSub' required>
                    </div>
                    <!--subMenuType-->
                    <div id="subMenuTypeText" style="display:inline">
                        Limit
                    </div>
                </TD>
            </TR>
            <TR>
                <TD><INPUT TYPE="radio" NAME="type" VALUE="market" id='marketSub' required> Market</TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Price</TD>
                <TD>
                    <!--subMenuPrice-->
                    <div id="subMenuPriceText" style="opacity:1;">
                    </div>
                    <!--subMenuPriceText-->
                    <div id="subMenuPrice" style="opacity:1;">

                        <input class="input-small" type="range" id="price" placeholder="Price" name="price" value=0
                               min="0.25" max="100" step=".25" style="width:100%;" required>
                        <output name="priceAmount" for="price">0</output>

<!--
                        <input class="input-small" type="number" id="price" placeholder="Price" name="price" value=0
                               min="1" max="10000" style="width:65%;" required>
                        .
                        <input class="input-small" type="number" id="cents" placeholder="00" name="cents" value=0
                               min="1" max="99" style="width:20%;" required>
-->
                    </div>


                </TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Quantity</TD>
                <TD>
                    <input class="input-small" type="range" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" max="100" step="1" style="width:100%;" required>
                    <output name="quantityAmount" for="quantity">1</output>
                </TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Subtotal</TD>
                <TD>
                    <output name="subtotal" for="price quantity">0</output>
                </TD>
            </TR>

            <TR>
                <TD ROWSPAN="1">Commission <br> (<?php echo(number_format(100 * $commission, 2, ".", ",")); ?>%)</TD>
                <TD>
                    <?php


                    if ($commission != 0) {
                        $commission *= 100;
                        echo('<output name="commissionAmount" for="commission">0</output>');
                    } else {
                        echo("No Commission! $0 (0%)");
                    }
                    ?>
                </TD>
            </TR>
            <TR>
                <TD ROWSPAN="1">Total</TD>
                <TD>
                    <output name="total" for="price quantity commission">0</output>
                </TD>
            </TR>

        <tr><td colspan="2"> <br>
                <button type="submit" class="btn btn-primary">SUBMIT</button><br>

                <br></td></tr>

        </tbody>

</TABLE>




</fieldset>
</form>
</div>




<script>
    //TYPE MARKET
    document.getElementById("marketSub").addEventListener("click", function () {
        document.getElementById('subMenuPriceText').innerHTML = '<font color=red>Market Order</font>';
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
