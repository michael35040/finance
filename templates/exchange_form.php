<?php
if (!isset($commission)) //set in constants.php
{ $commission = 0; }
?>





<form action="exchange.php" name="exchange_form" method="post"
      oninput="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
          "
      onclick="
          priceAmount.value=price.value;
          quantityAmount.value=quantity.value;
          commissionAmount.value=parseFloat(parseInt(quantity.value)*parseInt(price.value)*<?php echo($commission) ?>).toFixed(2);
          subtotal.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)).toFixed(2);
          total.value=parseFloat(parseFloat(quantity.value)*parseFloat(price.value)+parseFloat(commissionAmount.value)).toFixed(2);
          "
    >

    <fieldset>


        <TABLE class="exchange_form"  BORDER="3" cellspacing="0" cellpadding="5" align="center"

            <TR>
                <TD ROWSPAN="2">Side</TD>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="b" required> Buy / Bid Order</TD>
            </TR>
            <TR>
                <TD><INPUT TYPE="radio" NAME="side" VALUE="a" required> Sell / Ask Order</TD>
            </TR>

            <TR>
                <TD ROWSPAN="1">Symbol</TD>
                <TD>
                    <input list="symbol" name="symbol" maxlength="8" class="input-small" required><!--<input list="symbol" class="input-small" name="symbol" id="symbol" placeholder="Symbol" type="text" maxlength="5" required-->
                    <datalist id="symbol"><!--select class="input-small" name="symbol" id="symbol" /-->
                        <?php
                        if (empty($stocks)) {
                            echo("<option value=' '>No Stocks Held</option>");
                        } else {
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $quantity = $stock["quantity"];
                                echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . ")</option>");
                            }
                        }
                        ?>
                    </datalist>
                </TD>
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
                               min="10" max="50" step=".25" style="width:100%;" required><br />
                        $<output name="priceAmount" for="price">0</output>
                    </div>



                </TD>
            </TR>


            <TR>
                <TD ROWSPAN="1">Quantity</TD>
                <TD>
                    <input class="input-small" type="range" id="quantity" placeholder="Quantity" name="quantity" value=1
                           min="1" max="100" step="1" style="width:100%;" required><br />
                    <output name="quantityAmount" for="quantity">1</output>
                </TD>
            </TR>


            </TR>
            <TR>
                <TD ROWSPAN="1">Subtotal</TD>
                <TD>
                    $
                    <output name="subtotal" for="price quantity">0</output>
                </TD>
            </TR>

            <TR>
                <TD ROWSPAN="1">Commission <br> (<?php echo(number_format(100 * $commission, 2, ".", ",")); ?>%)</TD>
                <TD>
                    <?php


                    if ($commission != 0) {
                        $commission *= 100;
                        echo('$<output name="commissionAmount" for="commission">0</output>');
                    } else {
                        echo("No Commission! $0 (0%)");
                    }
                    ?>
                </TD>
            </TR>
            <TR>
                <TD ROWSPAN="1">Total</TD>
                <TD>
                    $
                    <output name="total" for="price quantity commission">0</output>
                </TD>
            </TR>

        <tr><td colspan="2"> <button type="submit" class="btn btn-danger">SUBMIT</button> <br> <br></td></tr>
        </TABLE>
    </fieldset>
</form>






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
